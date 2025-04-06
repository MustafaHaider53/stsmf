<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Result;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;

class ResultController extends Controller
{
    public function store(Request $request)
    {
        try {
            // Log the incoming request data
            Log::info('Incoming Request Data:', $request->all());

            // Ensure the app_no matches the logged-in student's appNo
            if ($request->app_no !== Auth::guard('student')->user()->appNo) {
                return redirect()->route('submit')->with('error', 'Invalid application number.');
            }

            // Validate the request data
            $data = $request->validate([
                'app_no' => 'required|string|exists:students,appNo',
                'uniName' => 'required|string|max:255',
                'semester' => 'required|string|max:255',
                'gpa' => 'required|numeric|min:0|max:4',
                'cgpa' => 'required|numeric|min:0|max:4',
                'resultFile' => 'required|file|mimes:pdf,jpeg,jpg,png|max:2048',
                'feesFile' => 'required|file|mimes:pdf|max:2048',
            ]);

            // Check if a result for this semester already exists
            $existingResult = Result::where('app_no', $request->app_no)
                                    ->where('semester', $request->semester)
                                    ->first();

            if ($existingResult) {
                return redirect()->route('submit')->with('error', 'You have already submitted a result for this semester.');
            }

            // Log the validated data
            Log::info('Validated Data:', $data);

            // Handle file uploads
            if ($request->hasFile('resultFile')) {
                $path = $request->file('resultFile')->store('results', 'public');
                $data['resultFile'] = basename($path);
            }

            if ($request->hasFile('feesFile')) {
                $path = $request->file('feesFile')->store('Challan', 'public');
                $data['feesFile'] = basename($path);
            }

            // Log the final data being inserted
            Log::info('Final Data for Insertion:', $data);

            // Create the result
            $result = Result::create($data);

            return redirect()->route('home')->with('success', 'Result submitted successfully');
        } catch (\Illuminate\Validation\ValidationException $e) {
            // Handle validation errors
            Log::error('Validation error: ' . $e->getMessage());
            return redirect()->route('submit')
                              ->withErrors($e->validator) // Pass validation errors to the view
                              ->withInput(); // Retain old input values
        } catch (\Exception $e) {
            // Handle other exceptions
            Log::error('Error creating result: ' . $e->getMessage());
            return redirect()->route('submit')->with('error', 'Error creating result');
        }
    }
}