<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Submit Result</title>
    @vite('resources/css/app.css')
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Roboto:wght@400;700&display=swap"
        rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Lato:wght@400;700&display=swap"
        rel="stylesheet">
    <style>
        /* Custom CSS with responsive improvements */
        body {
            font-family: 'Lato', sans-serif;
            background-color: #D4AF37;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding: 20px;
            background-color: #f8f9fa;
            border-bottom: 1px solid #e9ecef;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
        }

        .welcome-message {
            text-align: center;
            flex: 1;
            font-family: 'Playfair Display', serif;
            font-size: 2rem;
            color: #343a40;
            margin: 0;
        }

        .btn-danger {
            background-color: #dc3545;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 1rem;
        }

        .btn-danger:hover {
            background-color: #c82333;
        }

        .form-container {
            max-width: 600px;
            margin: 0 auto;
            padding: 30px;
            background-color: #ffffff;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
        }

        .form-container h2 {
            font-family: 'Playfair Display', serif;
            font-size: 1.75rem;
            color: #343a40;
            margin-bottom: 20px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
            color: #495057;
        }

        .form-control {
            width: 100%;
            padding: 10px;
            border: 1px solid #ced4da;
            border-radius: 5px;
            font-size: 1rem;
            color: #495057;
        }

        .form-control:focus {
            border-color: #80bdff;
            outline: 0;
            box-shadow: 0 0 0 0.2rem rgba(0, 123, 255, 0.25);
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 1rem;
            width: 100%;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            background-color: #0056b3;
            transform: scale(1.02);
        }

        .container {
            padding-top: 40px;
            padding-bottom: 40px;
        }

        /* Custom file input styling */
        .form-control[type="file"] {
            padding: 8px;
            border: 1px dashed #ced4da;
        }

        .form-control[type="file"]:focus {
            border-color: #80bdff;
            border-style: solid;
        }

        /* Responsive adjustments */
        @media (max-width: 768px) {
            .form-container {
                padding: 20px;
                margin: 0 15px;
            }

            .header-container {
                flex-direction: column;
                text-align: center;
            }

            .welcome-message {
                font-size: 1.5rem;
                margin-bottom: 15px;
            }
        }

        @media (max-width: 576px) {
            .form-container {
                padding: 15px;
            }

            .form-container h2 {
                font-size: 1.5rem;
            }

            .form-control {
                padding: 8px;
            }

            .btn-danger,
            .btn-primary {
                padding: 8px 16px;
                font-size: 0.9rem;
            }
        }
    </style>
</head>

<body>
    <div class="container ">
        <!-- Responsive Header Container -->
        <div class="header-container d-flex flex-column flex-md-row align-items-center justify-content-between p-3">
            <h1 class="welcome-message text-center text-md-start mb-3 mb-md-0">
                Welcome, {{ Auth::guard('student')->user()->name }}!
            </h1>
            <form action="{{ route('student.logout') }}" method="POST">
                @csrf
                <button type="submit" class="btn btn-danger">Logout</button>
            </form>
        </div>

        <!-- Submit Result Form -->
        <div class="d-flex justify-content-center">
        <div class="form-container mx-2 mx-sm-0">
            <h2>Submit Your Result</h2>
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul class="mb-0">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            @if (session('error'))
                <div class="alert alert-danger">
                    {{ session('error') }}
                </div>
            @endif

            <form action="{{ route('result.store') }}" method="POST" enctype="multipart/form-data">
                @csrf

                <!-- Student ID/Registration Number -->
                <div class="form-group">
                    <label for="app_no">Student Application Number</label>
                    <input type="text" id="app_no" name="app_no" class="form-control"
                        value="{{ Auth::guard('student')->user()->appNo }}" readonly>
                </div>

                <!-- University Name -->
                <div class="form-group">
                    <label for="uniName">University Name</label>
                    <input type="text" id="uniName" name="uniName" class="form-control" required>
                </div>

                <!-- Semester -->
                <div class="form-group">
                    <label for="semester">Semester</label>
                    <select id="semester" name="semester" class="form-control" required>
                        <option value="">Select Semester</option>
                        @foreach ([1, 2, 3, 4, 5, 6, 7, 8] as $semester)
                            <option value="{{ $semester }}" @if (in_array($semester, $submittedSemesters)) disabled @endif>
                                Semester {{ $semester }}
                            </option>
                        @endforeach
                    </select>
                </div>

                <!-- GPA and CGPA in responsive grid -->
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="gpa">GPA</label>
                            <input type="number" id="gpa" name="gpa" step="0.01" min="0"
                                class="form-control" required>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="cgpa">CGPA</label>
                            <input type="number" id="cgpa" name="cgpa" step="0.01" min="0"
                                class="form-control" required>
                        </div>
                    </div>
                </div>

                <!-- Fees Challan File Upload -->
                <div class="form-group">
                    <label for="feesFile">Upload Fees Challan (PDF)</label>
                    <input type="file" id="feesFile" name="feesFile" class="form-control" accept=".pdf" required>
                </div>

                <!-- Result File Upload -->
                <div class="form-group">
                    <label for="resultFile">Upload Result (PDF or Image)</label>
                    <input type="file" id="resultFile" name="resultFile" class="form-control"
                        accept=".pdf,.jpg,.jpeg,.png" required>
                </div>

                <!-- Submit Button -->
                <div class="form-group">
                    <button type="submit" class="btn btn-primary pulse-btn">Submit Result</button>
                </div>
            </form>
        </div>
    </div>
</div>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>

</html>
