<?php

namespace App\Http\Controllers;

use App\Models\Result;
use App\Models\Student;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use App\Mail\RemarksMail;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    /**
     * Display a listing of all students.
     */
    public function index()
    {
        $students = Student::with('results')->paginate(15); 
        return view('admin.index', compact('students'));
    }

     /**
     * Save remarks and send email to the student.
     */
    public function saveRemarks(Request $request, $resultId)
    {
        // Validate the input
        $request->validate([
            'remarks' => 'required|string|max:500',
        ]);

        // Find the result
        $result = Result::findOrFail($resultId);

        // Save the remarks
        $result->remarks = $request->input('remarks');
        $result->save();

        // Find the student associated with the result
        $student = $result->student;

        // Send email to the student
        Mail::to($student->email)->send(new RemarksMail($result));

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Remarks saved and email sent successfully!');
    }

    /**
     * Delete a student and their related results.
     */
    public function destroy($appNo)
    {
        $student = Student::findOrFail($appNo); // Find the student by appNo
        $student->results()->delete(); // Delete related results
        $student->delete(); // Delete the student

        return redirect()->route('admin.index')->with('success', 'Student deleted successfully.');
    }

    public function search(Request $request)
    {
        $query = $request->get('query');
        
        $students = Student::with('results')
            ->where('appNo', 'LIKE', '%' . $query . '%')
            ->orWhere('name', 'LIKE', '%' . $query . '%')
            ->paginate(15); 
        
        if ($request->ajax()) {
            return view('admin.search_result_rows', compact('students'))->render();
        }
        
        return view('admin.searchResult', compact('students'));
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