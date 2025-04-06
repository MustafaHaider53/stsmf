<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Student;
use App\Models\Result;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Mail\StudentRegistered;
use Illuminate\Support\Facades\Mail;

class StudentController extends Controller
{

    public function registerForm()
    {
        return view('registerStudent');
    }

    /**
     * Store a newly created resource in storage.
     */

    public function register(Request $request)
    {
    try {
        $data = $request->validate([
            'appNo' => 'required|string|unique:students,appNo|max:5',
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:students,email|max:255',
            'password' => 'required|string|confirmed',
            'phone' => 'required|string|unique:students,phone',
            'address' => 'required|string|max:500',
            'its' => 'required|string|unique:students,its|size:8',
            'mohallah' => 'required|string|max:255',
            'dob' => 'required|date|before:today',
            'program' => 'required|string|max:255',
        ]);

        // Hash the password
        $data['password'] = Hash::make($data['password']);

        Log::info("Attempting to create a new student with the following data: " . json_encode($data));
        $student = Student::create($data);


        // Log in the student after registration
        Auth::guard('student')->login($student);

        return redirect()->route('submit');
    } catch (\Illuminate\Validation\ValidationException $e) {
        // Handle validation errors
        Log::error('Validation error: ' . $e->getMessage());
        return redirect()->route('registerForm')
                          ->withErrors($e->validator) // Pass validation errors to the view
                          ->withInput(); // Retain old input values
    } catch (\Exception $e) {
        Log::error('Error creating student: ' . $e->getMessage());
        return redirect()->route('registerForm')->with('error', 'Error creating student');
    }
}

    public function loginForm()
    {
        return view('loginStudent');
    }

    public function login(Request $request)
{
    try {
        // Validate the request data
        $data = $request->validate([
            'email' => 'required|email',
            'password' => 'required|string',
        ]);

        Log::info("Attempting to log in student with the following data: " . json_encode($data));

        // Attempt to log in the student
        if (Auth::guard('student')->attempt($data)) {
            $user = Auth::guard('student')->user();

            // Check the user's role
            if ($user->role === 'admin') {
                return redirect()->route('admin.index'); // Redirect to admin dashboard
            } else {
                return redirect()->route('submit'); // Redirect to student dashboard
            }
        } else {
            // If login fails, return with an error message
            return redirect()->route('loginForm')
                             ->with('error', 'Invalid email or password')
                             ->withInput(); // Retain old input values
        }
    } catch (\Illuminate\Validation\ValidationException $e) {
        // Handle validation errors
        Log::error('Validation error: ' . $e->getMessage());
        return redirect()->route('loginForm')
                          ->withErrors($e->validator) // Pass validation errors to the view
                          ->withInput(); // Retain old input values
    } catch (\Exception $e) {
        // Handle other exceptions
        Log::error('Error logging in student: ' . $e->getMessage());
        return redirect()->route('loginForm')->with('error', 'Error logging in student');
    }
}

public function submit()
{
    // Check if the student is logged in
    if (Auth::guard('student')->check()) {
        // Fetch the logged-in student's application number
        $appNo = Auth::guard('student')->user()->appNo;

        // Fetch the list of semesters for which the student has already submitted results
        $submittedSemesters = Result::where('app_no', $appNo)
                                    ->pluck('semester')
                                    ->toArray();

        // Pass the submitted semesters to the view
        return view('submitResult', compact('submittedSemesters'));
    } else {
        // Redirect to the login page if the student is not logged in
        return redirect()->route('loginForm');
    }
}

    public function logout(Request $request)
{
    // Log out the student using the 'student' guard
    Auth::guard('student')->logout();

    // Invalidate the session and regenerate the CSRF token
    $request->session()->invalidate();
    $request->session()->regenerateToken();

    // Redirect to the home page or login page
    return redirect()->route('home')->with('success', 'You have been logged out successfully.');
}
    
}
