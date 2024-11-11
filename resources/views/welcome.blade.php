<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Record Room Management</title>
    <link rel="icon" type="image/png" href="{{ asset('images/sri lanka.png') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">


    <!-- Tailwind CSS -->
    <script src="https://cdn.tailwindcss.com"></script>

    <style>
        body {
            font-family: Arial, sans-serif;
        }
        .parallax-bg {
            background-image: url("{{ asset('images/magenta-nature.jpg') }}");
            background-attachment: fixed;
            background-size: cover;
            background-position: center;
        }
        .text-shadow {
            text-shadow: 0px 0px 10px rgba(0,0,0,0.5);
        }

        /* Footer Background with Gradient Color */
        footer {
            background-size: cover;
            background-position: center;
            background-repeat: no-repeat;
            background-attachment: fixed;
            padding: 50px 0;
        }

        /* Logo Outline Shine */
        .logo-shine {
            position: relative;
            display: inline-block;
        }

        .logo-shine::after {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: linear-gradient(45deg, rgba(255, 255, 255, 0.8), rgba(255, 255, 255, 0));
            animation: shine 2s infinite;
            pointer-events: none;
        }

        /* Shine Effect on Company Name Near Cursor */
        .company-name {
            position: relative;
            display: inline-block;
            transition: text-shadow 0.3s;
        }
        .company-name:hover {
            text-shadow: 0 0 10px rgba(255, 255, 255, 0.8);
        }

        /* Keyframes for Logo Shine */
        @keyframes shine {
            0% {
                left: -100%;
            }
            50% {
                left: 100%;
            }
            100% {
                left: -100%;
            }
        }
    </style>
</head>
<body class="bg-gray-50 scroll-smooth">

    <!-- Hero Section with Parallax and Animation -->
    <section class="parallax-bg h-screen flex items-center justify-center text-white text-shadow">
        <div class="text-center transform transition duration-700 ease-in-out hover:scale-105">
            <h1 class="text-4xl md:text-5xl font-bold mb-4 animate__animated animate__fadeInDown">Welcome to Record Room</h1>
            <p class="text-lg md:text-xl mb-8 animate__animated animate__fadeInUp animate__delay-1s">Your efficient library management solution</p>
            <div class="flex justify-center space-x-4">
                <a href="{{ route('login') }}" 
                   class="bg-indigo-500 px-6 py-3 rounded-lg text-white hover:bg-indigo-600 transform hover:scale-105 transition duration-300 ease-in-out">
                   Get Started
                </a>
                <a href="{{ route('register') }}" 
                   class="bg-yellow-500 px-6 py-3 rounded-lg text-white hover:bg-yellow-600 transform hover:scale-105 transition duration-300 ease-in-out">
                   Signup
                </a>
            </div>
        </div>
    </section>

    <!-- Features Section with Hover Effects and Transitions -->
    <section class="container mx-auto p-12 text-center">
        <h2 class="text-3xl font-bold text-gray-700 mb-8">Our Features</h2>
        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
            <!-- Feature 1 -->
            <div class="p-6 bg-white shadow-lg rounded-lg transform transition duration-300 hover:scale-105 hover:shadow-2xl hover:bg-indigo-50">
                <h3 class="text-xl font-semibold mb-2 text-gray-800">Secure Admin Access</h3>
                <p class="text-gray-600">Only admins can access crucial features and settings.</p>
            </div>
            <!-- Feature 2 -->
            <div class="p-6 bg-white shadow-lg rounded-lg transform transition duration-300 hover:scale-105 hover:shadow-2xl hover:bg-indigo-50">
                <h3 class="text-xl font-semibold mb-2 text-gray-800">Records Organization</h3>
                <p class="text-gray-600">Keep your library records organized and easily accessible.</p>
            </div>
            <!-- Feature 3 -->
            <div class="p-6 bg-white shadow-lg rounded-lg transform transition duration-300 hover:scale-105 hover:shadow-2xl hover:bg-indigo-50">
                <h3 class="text-xl font-semibold mb-2 text-gray-800">Statistics and Reports</h3>
                <p class="text-gray-600">Get detailed insights into library usage and records.</p>
            </div>
        </div>
    </section>

</body>

<!-- Footer Section -->
<footer class="bg-gradient-to-r from-gray-700 to-gray-900 text-white py-6">
    <div class="container mx-auto px-4 flex justify-between items-center">
        <!-- Left Section: Logo and Company Name Centered -->
        <div class="flex flex-col items-center space-y-2">
            <a href="https://moha.gov.lk" target="_blank" class="logo-shine">
                <img src="{{ asset('images/gov_logo.png') }}" alt="Company Logo" class="w-12 transform transition duration-300 hover:scale-110">
            </a>
            <p class="text-sm company-name whitespace-nowrap">Ministry of Home Affairs in Sri Lanka.</p>
        </div>

        <!-- Center Content: Developed by -->
        <div class="text-center w-full space-y-1">
            <p class="text-sm opacity-75 hover:opacity-100 transition duration-300 ease-in-out">
                &copy; {{ date('Y') }} Record Room Management. All rights reserved.
            </p>
            <p class="text-sm opacity-75 hover:opacity-100 transition duration-300 ease-in-out">
                Built with <span class="text-red-500">♥</span> using Laravel and Tailwind CSS
            </p>
            <p class="text-sm font-semibold">Developed by:</p>
            <p class="text-sm">
                <a href="https://github.com/gayan" class="text-yellow-400 hover:text-white transition duration-300">Gayan</a> |
                <a href="https://github.com/didula" class="text-yellow-400 hover:text-white transition duration-300">Didula</a> |
                <a href="https://github.com/nipuna" class="text-yellow-400 hover:text-white transition duration-300">Nipuna</a>
            </p>
        </div>

        <!-- Right Section: Footer Links with Icons -->
        <div class="flex space-x-6 footer-links">
            <a href="{{ route('dashboard') }}" class="flex items-center space-x-1 text-yellow-400 hover:text-white transition duration-300 ease-in-out transform hover:scale-105">
                <i class="fas fa-home"></i>
                <span>Home</span>
            </a>
            <a href="{{ route('about') }}" class="flex items-center space-x-1 text-yellow-400 hover:text-white transition duration-300 ease-in-out transform hover:scale-105">
                <i class="fas fa-info-circle"></i>
                <span>About</span>
            </a>
            <a href="{{ route('contact') }}" class="flex items-center space-x-1 text-yellow-400 hover:text-white transition duration-300 ease-in-out transform hover:scale-105">
                <i class="fas fa-phone-alt"></i>
                <span>Contact</span>
            </a>
        </div>
    </div>
</footer>

<!-- Add FontAwesome for Icons -->
<script src="https://kit.fontawesome.com/a076d05399.js"></script>
</html>
