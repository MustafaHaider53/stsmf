<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Panel</title>
    @vite('resources/css/app.css')
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ asset('css/styles.css') }}">
    <link href="https://fonts.googleapis.com/css2?family=Pacifico&family=Roboto:wght@400;700&display=swap"
        rel="stylesheet">
    <link
        href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@700&family=Lato:wght@400;700&display=swap"
        rel="stylesheet">
    <style>
        body {
            font-family: 'Lato', sans-serif;
            background-color: #D4AF37;
            color: #343a40;
        }

        .header-container {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding: 20px;
            background-color: #ffffff;
            border-bottom: 1px solid #e9ecef;
            box-shadow: 0 2px 4px rgba(0, 0, 0, 0.1);
            animation: fadeInDown 1s ease-in-out;
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

        .table-container {
            background-color: #ffffff;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            animation: fadeInUp 1s ease-in-out;
            overflow-x: auto;
        }

        .table thead th {
            background-color: #e2ba38;
            color: white;
            font-family: 'Playfair Display', serif;
        }

        .table tbody td {
            font-family: 'Lato', sans-serif;
        }

        .table tbody tr {
            animation: fadeIn 0.5s ease-in-out;
        }

        .btn-primary {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            font-size: 1rem;
        }

        .btn-primary:hover {
            background-color: #0056b3;
        }

        .container {
            padding-top: 40px;
            padding-bottom: 40px;
        }

        @keyframes fadeInDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeInUp {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }

        .table {
            font-size: 14px;
        }

        .btn-sm {
            padding: 5px 10px;
            font-size: 12px;
        }

        .remarks-textarea {
            font-size: 12px;
            padding: 5px;
            resize: vertical;
        }

        .table td,
        .table th {
            padding: 8px;
        }

        .table thead th {
            font-size: 14px;
        }

        .table-container {
            padding: 10px;
        }

        @media (max-width: 768px) {
            .welcome-message {
                font-size: 1.5rem;
            }

            .table {
                font-size: 12px;
            }

            .btn-sm {
                padding: 3px 6px;
                font-size: 10px;
            }

            .remarks-textarea {
                font-size: 10px;
                padding: 3px;
            }

            .table td,
            .table th {
                padding: 5px;
            }

            .table thead th {
                font-size: 12px;
            }

            .table-container {
                padding: 10px;
            }
        }
    </style>
</head>

<body>
    <div class="container">
        <div class="header-container">
            <h1 class="welcome-message">Admin Panel</h1>
            <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                @csrf
                <button type="submit" class="btn btn-danger btn-sm">Logout</button>
            </form>
        </div>

        <div class="d-flex flex-row-reverse p-2">
            <input type="text" class="form-control" id="student-search"
                placeholder="Search by name or application number">
        </div>

        <div class="table-container">
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif
            <div class="table-responsive">
                <table class="table table-striped table-hover">
                    <thead>
                        <tr>
                            <th>Application No</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>ITS</th>
                            <th>Semester</th>
                            <th>GPA</th>
                            <th>CGPA</th>
                            <th>Result</th>
                            <th>Fees Challan</th>
                            <th>Remarks</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody id="students-table-body">
                        @include('admin.search_result_rows')
                    </tbody>
                </table>
            </div>
            <div class="d-flex justify-content-center mt-3">
                {{ $students->withQueryString()->links('pagination::bootstrap-5') }}
            </div>
        </div>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.js"
        integrity="sha512-+k1pnlgt4F1H8L7t3z95o3/KO+o78INEcXTbnoJQ/F2VqDVhWoaiVml/OEHv9HsVgxUaVW+IbiZPUJQfF/YxZw=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script>
        $(document).ready(function() {
            $('#student-search').on('keyup', function() {
                let query = $(this).val();
                $.ajax({
                    url: '{{ route('student.search') }}',
                    method: 'GET',
                    data: {
                        query: query
                    },
                    success: function(response) {
                        $('#students-table-body').html(response);
                    },
                    error: function(xhr, status, error) {
                        console.error('Error:', error);
                    }
                });
            });
        });
    </script>
    </script>
</body>

</html>
