<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Record Room</title>
    <link rel="icon" type="image/sri lanka" href="{{ asset('images/sri lanka.png') }}">
    <!-- Include Bootstrap 5 CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        body {
            font-family: 'Arial', sans-serif;
            background-color: #f8f9fa;
        }
        .container {
            max-width: 800px;
            margin-top: 50px;
        }
        .card {
            border: none;
            box-shadow: 0 0 15px rgba(0,0,0,0.1);
        }
        .card-header {
            background-color: #343a40;
            color: white;
        }
    </style>
</head>
<body>
    <nav class="navbar navbar-light bg-light">
        <div class="container-fluid">
            <span class="navbar-brand mb-0 h1">Record Room</span>
        </div>
    </nav>

    <div class="container">
        <h1 class="mb-4">Record Room</h1>
        <p class="lead mb-5">
            This is a simple Library Management System which is used to maintain the record of the library. This Library
            Management System has been made by using PHP script, MySQL Database, Vanilla JavaScript and Bootstrap 5
            framework. This is a PHP Project on Online Library Management System.
        </p>

        <div class="row">
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">Admin Login</h5>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('login') }}" class="btn btn-outline-dark">Admin Login</a>
                    </div>
                </div>
            </div>
            <div class="col-md-6 mb-3">
                <div class="card">
                    <div class="card-header">
                        <h5 class="mb-0">User Login</h5>
                    </div>
                    <div class="card-body">
                        <a href="{{ route('login') }}" class="btn btn-outline-secondary me-2">User Login</a>
                        <a href="{{ route('register') }}" class="btn btn-primary">User Sign Up</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <footer class="mt-16 text-center">
                        <p>&copy; {{ date('Y') }} Record Room. All rights reserved.</p>
                    </footer>

    <!-- Include Bootstrap 5 JS and Popper.js -->
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
