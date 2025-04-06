@extends('layouts.master')

@section('title', 'Register')

@section('content')
<div class="container py-4">
    <div class="row justify-content-center">
        <div class="col-md-10 col-lg-8">
            <div class="form-container p-4">
                <h2 class="text-center mb-4">Register</h2>
                
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul class="mb-0">
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                <form action="{{ route('student.register') }}" method="POST">
                    @csrf
                    <div class="row">
                        <!-- Column 1 -->
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="appNo" class="form-label">Student Application Number</label>
                                <input type="text" class="form-control" id="appNo" name="appNo" required>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="name" class="form-label">Name</label>
                                <input type="text" class="form-control" id="name" name="name" required>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="email" class="form-label">Email</label>
                                <input type="email" class="form-control" id="email" name="email" required>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" class="form-control" id="password" name="password" required>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" id="password_confirmation" name="password_confirmation" required>
                            </div>
                        </div>
                        
                        <!-- Column 2 -->
                        <div class="col-md-6">
                            <div class="form-group mb-3">
                                <label for="phone" class="form-label">Phone</label>
                                <input type="text" class="form-control" id="phone" name="phone" required>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="address" class="form-label">Address</label>
                                <input type="text" class="form-control" id="address" name="address" required>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="its" class="form-label">ITS</label>
                                <input type="text" class="form-control" id="its" name="its" required>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="mohallah" class="form-label">Mohallah</label>
                                <input type="text" class="form-control" id="mohallah" name="mohallah" required>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="dob" class="form-label">Date of Birth</label>
                                <input type="date" class="form-control" id="dob" name="dob" required>
                            </div>
                            
                            <div class="form-group mb-3">
                                <label for="program" class="form-label">Program</label>
                                <input type="text" class="form-control" id="program" name="program" required>
                            </div>
                        </div>
                    </div>
                    
                    <div class="d-grid mt-4">
                        <button type="submit" class="btn btn-primary py-2">Register</button>
                    </div>
                </form>
                
                <p class="text-center mt-3 mb-0">Already have an account? 
                    <a href="{{ route('loginForm') }}" class="text-decoration-none">Login here</a>
                </p>
            </div>
        </div>
    </div>
</div>
@endsection