<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\ResultController;
use App\Http\Middleware\RedirectIfNotStudent;
use App\Http\Middleware\EnsureAdmin;
use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Mail;
use App\Models\Student;


Route::get('/', function () {
    return view('home');
})->name('home');

Route::get('/student/registerform', [StudentController::class, 'registerForm'])->name('registerForm');
Route::post('/student/register', [StudentController::class, 'register'])->name('student.register');
Route::get('/student/loginform', [StudentController::class, 'loginForm'])->name('loginForm');
Route::post('/student/login', [StudentController::class, 'login'])->name('student.login');
Route::post('/student/logout', [StudentController::class, 'logout'])->name('student.logout');

//result routes



// Admin Routes
Route::middleware(EnsureAdmin::class)->group(function () {
    Route::get('/admin', [AdminController::class, 'index'])->name('admin.index');
    Route::delete('/admin/students/{appNo}', [AdminController::class, 'destroy'])->name('admin.destroy');
    Route::post('/save-remarks/{resultId}', [AdminController::class, 'saveRemarks'])->name('save.remarks');
    Route::get('/search', [AdminController::class, 'search'])->name('student.search');
    Route::post('/admin/logout', [AdminController::class, 'logout'])->name('admin.logout');
});


Route::middleware(RedirectIfNotStudent::class)->group(function () {
    Route::get('/student/submit', [StudentController::class, 'submit'])->name('submit');
    Route::post('/student/submitResult', [ResultController::class, 'store'])->name('result.store');
    
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';



