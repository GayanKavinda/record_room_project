<!-- resources/views/about.blade.php -->
<x-app-layout>
    <div class="h-screen mx-auto py-12 bg-cover bg-center bg-fixed" style="background-image: url('{{ asset('images/f5-1920x1080.jpg') }}');">
        <div class="max-w-6xl mx-auto pb-2">
            {{-- Hero Section --}}
            <div class="text-center mb-12 transition-all duration-500 ease-in-out hover:translate-y-4">
                <h1 class="text-4xl font-extrabold text-white mb-4 tracking-wide transition-colors duration-300 hover:text-blue-500">
                    Record Room Management System
                </h1>
                <p class="text-xl text-yellow-600 max-w-3xl mx-auto">
                    A cutting-edge solution for the Ministry of Home Affairs, Sri Lanka, revolutionizing 
                    document management through innovative technology and intelligent design.
                </p>
            </div>

            {{-- Main Content Grid --}}
            <div class="grid md:grid-cols-3 gap-8">
                {{-- Project Overview Column --}}
                <div class="md:col-span-2 bg-white shadow-2xl rounded-xl p-8 transform transition-all duration-500 ease-in-out hover:translate-y-4">
                    <div class="mb-8">
                        <h2 class="text-2xl font-bold text-gray-800 mb-4 border-b-2 border-blue-500 pb-2">
                            Project Overview
                        </h2>
                        <p class="text-gray-600 leading-relaxed">
                            Developed by innovative graduates, our system addresses the complex 
                            document management challenges faced by government institutions, 
                            providing a secure, efficient, and user-friendly solution.
                        </p>
                    </div>

                    {{-- Key Features --}}
                    <div class="grid md:grid-cols-2 gap-4">
                        <div class="bg-blue-50 p-4 rounded-lg shadow-lg transform transition duration-300 ease-in-out hover:scale-105">
                            <h3 class="font-bold text-blue-800 mb-2">Mission</h3>
                            <p class="text-gray-700">
                                Empower government record management with advanced technological solutions.
                            </p>
                        </div>
                        <div class="bg-green-50 p-4 rounded-lg shadow-lg transform transition duration-300 ease-in-out hover:scale-105">
                            <h3 class="font-bold text-green-800 mb-2">Vision</h3>
                            <p class="text-gray-700">
                                Transform administrative processes through intelligent document tracking.
                            </p>
                        </div>
                    </div>
                </div>

                {{-- Organizational Details Column --}}
                <div class="bg-gray-100 rounded-lg p-8 text-center shadow-lg transform transition duration-300 ease-in-out hover:scale-105">
                    <img 
                        src="{{ asset('images/gov_logo.png') }}" 
                        alt="Ministry of Home Affairs Logo" 
                        class="w-32 h-32 mx-auto mb-4 object-contain"
                    >
                    <h3 class="text-xl font-bold text-gray-800">Ministry of Home Affairs</h3>
                    <p class="text-gray-600 mb-4">Record Management Solutions Division</p>
                    
                    <div class="space-y-2 text-sm text-gray-700">
                        <p>"Nila Madura", Elvitigala Mawatha, Narahenpita, Colombo 05, Sri Lanka</p>
                        <p>+94 11 205 0450</p>
                        <p>info@moha.gov.lk</p>
                    </div>
                </div>
            </div>

            {{-- Developer Profiles Section --}}
            <div class="mt-12 mb-16"> <!-- Added bottom margin here -->
                <h2 class="text-2xl font-bold text-center text-yellow-500 mb-8">
                    Meet Our Development Team
                </h2>
                <div class="grid md:grid-cols-3 gap-6">
                    @php
                    $developers = [
                        [
                            'name' => 'G.R Gayan Kavinda',
                            'mobile' => '+94 70 213 1350',
                            'email' => 'gayankavinda98v.lk@gmail.com',
                            'role' => 'Trainee Software Engineer (Fullstack Dev)',
                            'university' => 'Sri Lanka Institute of Information Technology',
                            'image' => 'images/DSC04951.jpg'
                        ],
                        [
                            'name' => 'Didula Senevirathna',
                            'mobile' => '+94 70 213 1350',
                            'email' => 'gayankavinda98v.lk@gmail.com',
                            'role' => 'Trainee Software Engineer',
                            'university' => 'IIT',
                            'image' => 'images/Didula.jpg'
                        ],
                        [
                            'name' => 'Nipuna Gamage',
                            'mobile' => '+94 70 213 1350',
                            'email' => 'gayankavinda98v.lk@gmail.com',
                            'role' => 'Trainee Software Engineer',
                            'university' => 'IIT',
                            'image' => 'images/Nipuna.jpg'
                        ]
                    ];
                    @endphp

                    @foreach($developers as $developer)
                        <div class="bg-white shadow-md rounded-lg p-6 text-center transform transition hover:scale-105">
                            <img 
                                src="{{ asset($developer['image']) }}" 
                                alt="{{ $developer['name'] }}" 
                                class="w-24 h-24 rounded-full mx-auto mb-4 object-cover transform transition duration-300 ease-in-out hover:scale-110"
                            >
                            <h3 class="font-bold text-gray-800">{{ $developer['name'] }}</h3>
                            <h3 class="text-gray-800">{{ $developer['mobile'] }}</h3>
                            <h3 class="text-gray-800">{{ $developer['email'] }}</h3>
                            <p class="text-gray-600">{{ $developer['role'] }}</p>
                            <p class="text-sm text-gray-500">{{ $developer['university'] }}</p>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
