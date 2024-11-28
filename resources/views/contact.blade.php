<x-app-layout>
    <div class="container mx-auto px-4 py-8 bg-cover bg-center" style="background-image: url('images/2.jpg');">
        <h1 class="text-3xl font-bold text-white text-center mb-8 bg-opacity-60 bg-black p-4 rounded-md">Meet Our Development Team</h1>
        
        @php
            $developers = [
                [
                    'name' => 'G.R Gayan Kavinda',
                    'mobile' => '+94 70 213 1350',
                    'email' => 'gayankavinda98v.lk@gmail.com',
                    'linkedin' => 'https://www.linkedin.com/in/gayan-gamlath-k98/',
                    'portfolio' => 'https://gayan-kavinda-portfolio.com',
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
        
        <div class="grid md:grid-cols-3 gap-8">
            @foreach($developers as $developer)
            <div class="bg-white shadow-lg rounded-lg overflow-hidden transform transition duration-300 hover:scale-105 hover:bg-gray-100">
                <div class="relative group">
                    <img src="{{ asset($developer['image']) }}" alt="{{ $developer['name'] }}" class="w-full h-64 object-cover transition-transform duration-500 group-hover:scale-110">
                    <div class="absolute bottom-0 left-0 right-0 bg-black bg-opacity-50 text-white p-4 transition-all duration-300 group-hover:bg-opacity-75">
                        <h2 class="text-xl font-semibold">{{ $developer['name'] }}</h2>
                        <p class="text-sm">{{ $developer['role'] }}</p>
                    </div>
                </div>
                
                <div class="p-6">
                    <div class="mb-4">
                        <p class="text-gray-700 flex items-center mb-2">
                            <i class="fas fa-university mr-2 text-blue-500"></i>
                            {{ $developer['university'] }}
                        </p>
                        <p class="text-gray-700 flex items-center mb-2">
                            <i class="fas fa-phone mr-2 text-green-500"></i>
                            {{ $developer['mobile'] }}
                        </p>
                        <p class="text-gray-700 flex items-center mb-4">
                            <i class="fas fa-envelope mr-2 text-red-500"></i>
                            {{ $developer['email'] }}
                        </p>
                    </div>
                    
                    <div class="flex justify-center space-x-4">
                        @isset($developer['linkedin'])
                            <a href="{{ $developer['linkedin'] }}" target="_blank" class="text-blue-600 hover:text-blue-800 transition duration-300 transform hover:scale-125">
                                <i class="fab fa-linkedin text-3xl"></i>
                            </a>
                        @endisset
                        
                        @isset($developer['portfolio'])
                            <a href="{{ $developer['portfolio'] }}" target="_blank" class="text-blue-600 hover:text-blue-800 transition duration-300 transform hover:scale-125">
                                <i class="fas fa-briefcase text-3xl"></i>
                            </a>
                        @endisset
                    </div>
                </div>
            </div>
            @endforeach
        </div>
    </div>
</x-app-layout>

{{-- 
    Checking for LinkedIn URL:
    I've wrapped the LinkedIn <a> tag inside an @isset directive. 
    This will ensure that the link is only shown if the linkedin key is set for the developer.

    Same for Portfolio:
    I've done the same for the portfolio key. If the portfolio key is set, 
    the portfolio link will be shown; otherwise, it will be skipped.

    Why this works:

    @isset ensures that no error is thrown when trying to access a key that doesn’t 
    exist in the array. It only renders the section of the code if the key exists.

    This avoids the "Undefined array key" error that occurs when trying to access a key in the array 
    that doesn't exist for a given developer.

    Now, the error should be resolved, and the layout will display properly for developers with or 
    without LinkedIn and portfolio links. 
--}}
