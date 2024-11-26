<x-app-layout>
    <div class="min-h-screen bg-cover bg-center bg-no-repeat" style="background-image: url('{{ asset('images/anime-girl-color-wheel-5w-1920x1080.jpg') }}'); background-attachment: fixed;">
        <div class="min-h-screen bg-black bg-opacity-40">
            <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-12">
                <!-- Advanced Header with Contextual Information -->
                <div class="flex flex-col md:flex-row justify-between items-center mb-10 animate-fade-in-down">
                    <div>
                        <h2 class="text-4xl font-extrabold text-white">
                            {{ auth()->user()->name }}'s Dashboard
                        </h2>
                        <p class="text-gray-200 mt-2 animate-pulse-slow">
                            {{ now()->format('l, F j, Y') }} | 
                            Welcome to your comprehensive system overview
                        </p>
                    </div>
                    <div class="flex items-center space-x-4 mt-4 md:mt-0">
                        <div class="flex items-center text-sm text-white animate-slide-in-right">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6 mr-2 text-blue-300 animate-spin-slow" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span id="real-time-clock" class="font-semibold">{{ now()->timezone('Asia/Kolkata')->format('Y-m-d h:i:s A') }}</span>                        </div>
                    </div>
                </div>

            <!-- Enhanced Stats Grid with More Dynamic Layout -->
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6">
                <!-- Departments Card (Super Admin Only) -->
                @if(auth()->user()->hasRole('super-admin'))
                    <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border-l-4 border-blue-500 hover:scale-105 animate-fade-in-left">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="text-lg font-bold text-gray-700 mb-2">Departments</h3>
                                <p class="text-4xl font-bold text-blue-500">{{ $departmentCount }}</p>
                                <p class="text-sm text-gray-500 mt-1">Total Organizational Units</p>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-blue-300 animate-wiggle" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 4h1m-1 4h1m6-8h1m-1 4h1m-1 4h1m-1 4h1" />
                            </svg>
                        </div>
                    </div>
                @endif
                
                <!-- Files Card -->
                <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border-l-4 border-green-500 hover:scale-105 animate-fade-in-up">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-bold text-gray-700 mb-2">Total Files</h3>
                            <p class="text-4xl font-bold text-green-500">{{ $fileCount }}</p>
                            <p class="text-sm text-gray-500 mt-1">Active Documents</p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-green-300 animate-bounce-slow" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                </div>
                
                <!-- Pending Files Card -->
                <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border-l-4 border-yellow-500 hover:scale-105 animate-fade-in-right">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-bold text-gray-700 mb-2">Pending Files</h3>
                            <p class="text-4xl font-bold text-yellow-500">{{ $pendingFileCount }}</p>
                            <p class="text-sm text-gray-500 mt-1">Awaiting Processing</p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-yellow-300 animate-pulse-slow" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 8v4l3 3m6-3a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                    </div>
                </div>
            </div>

            <!-- Additional Stats Section with Enhanced Design -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mt-6">
                <!-- Stored Files Card -->
                <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border-l-4 border-purple-500 hover:scale-105 animate-fade-in-down">
                    <div class="flex justify-between items-center">
                        <div>
                            <h3 class="text-lg font-bold text-gray-700 mb-2">Stored Files</h3>
                            <p class="text-4xl font-bold text-purple-500">{{ $storedFileCount }}</p>
                            <p class="text-sm text-gray-500 mt-1">Archive Storage</p>
                        </div>
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-purple-300 animate-slide-in-left" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 19a2 2 0 01-2-2V7a2 2 0 012-2h4l2 2h4a2 2 0 012 2v1M5 19h14a2 2 0 002-2v-5a2 2 0 00-2-2H9a2 2 0 00-2 2v5a2 2 0 01-2 2z" />
                        </svg>
                    </div>
                </div>

                @if(auth()->user()->hasRole('super-admin'))
                    <!-- Total Users Card -->
                    <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border-l-4 border-indigo-500 hover:scale-105 animate-fade-in-up">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="text-lg font-bold text-gray-700 mb-2">Total Users</h3>
                                <p class="text-4xl font-bold text-indigo-500">{{ $userCount }}</p>
                                <p class="text-sm text-gray-500 mt-1">System Participants</p>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-indigo-300 animate-pulse-slow" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                            </svg>
                        </div>
                    </div>

                    <!-- Pending Users Card -->
                    <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border-l-4 border-orange-500 hover:scale-105 animate-fade-in-down">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="text-lg font-bold text-gray-700 mb-2">Pending Users</h3>
                                <p class="text-4xl font-bold text-orange-500">{{ $pendingUserCount }}</p>
                                <p class="text-sm text-gray-500 mt-1">Awaiting Approval</p>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-orange-300 animate-wiggle" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M18 9v3m0 0v3m0-3h3m-3 0h-3m-2-5a4 4 0 11-8 0 4 4 0 018 0zM3 20a6 6 0 0112 0v1H3v-1z" />
                            </svg>
                        </div>
                    </div>

                    <!-- Permissions Card -->
                    <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-2xl transition-all duration-300 transform hover:-translate-y-2 border-l-4 border-teal-500 hover:scale-105 animate-fade-in-left">
                        <div class="flex justify-between items-center">
                            <div>
                                <h3 class="text-lg font-bold text-gray-700 mb-2">Permissions</h3>
                                <p class="text-4xl font-bold text-teal-500">{{ $permissionCount }}</p>
                                <p class="text-sm text-gray-500 mt-1">Access Levels</p>
                            </div>
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-12 w-12 text-teal-300 animate-slide-in-left" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                            </svg>
                        </div>
                    </div>
                @endif
            </div>

            <!-- Advanced Quick Actions Section -->
            <div class="mt-8 bg-white bg-opacity-80 backdrop-blur-sm p-6 rounded-lg shadow-lg hover:shadow-xl transition-shadow duration-300">
                    <div class="flex justify-between items-center mb-4">
                        <h2 class="text-2xl font-semibold text-gray-800">Quick Actions</h2>
                        <span class="text-sm text-gray-600 animate-slide-in-right">Shortcuts to key system functions</span>
                    </div>
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                        <a href="{{ route('files.index') }}" 
                           class="bg-white p-5 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 flex items-center space-x-3 animate-fade-in-left">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-green-500 animate-wiggle" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12h6m-6 4h6m2 5H7a2 2 0 01-2-2V5a2 2 0 012-2h5.586a1 1 0 01.707.293l5.414 5.414a1 1 0 01.293.707V19a2 2 0 01-2 2z" />
                            </svg>
                            <span class="text-gray-700 font-medium">View All Files</span>
                        </a>
                        <a href="{{ route('files.create') }}" 
                           class="bg-white p-5 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 flex items-center space-x-3 animate-fade-in-left">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-blue-500 animate-wiggle" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 9v3m0 0v3m0-3h3m-3 0H9m12 0a9 9 0 11-18 0 9 9 0 0118 0z" />
                            </svg>
                            <span class="text-gray-700 font-medium">Add New File</span>
                        </a>
                        <a href="{{ route('departments.index') }}" 
                           class="bg-white p-5 rounded-lg shadow-md hover:shadow-lg transition-all duration-300 transform hover:-translate-y-1 flex items-center space-x-3 animate-fade-in-left">
                            <svg xmlns="http://www.w3.org/2000/svg" class="h-8 w-8 text-purple-500 animate-wiggle" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 21V5a2 2 0 00-2-2H7a2 2 0 00-2 2v16m14 0h2m-2 0h-5m-9 0H3m2 0h5M9 7h1m-1 4h1m4-4h1m-1 4h1m-5 4h1m-1 4h1m6-8h1m-1 4h1m-1 4h1m-1 4h1" />
                            </svg>
                            <span class="text-gray-700 font-medium">Manage Departments</span>
                        </a>

                        @if(auth()->user()->hasRole('super-admin'))
                            <div class="col-span-full flex space-x-4 mt-4">
                                <a href="{{ route('roles.index') }}" 
                                   class="bg-gray-200 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-300 transition-transform duration-300 transform hover:scale-105 flex items-center space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4M7.835 4.697a3.42 3.42 0 001.946-.806 3.42 3.42 0 014.438 0 3.42 3.42 0 001.946.806 3.42 3.42 0 013.138 3.138 3.42 3.42 0 00.806 1.946 3.42 3.42 0 010 4.438 3.42 3.42 0 00-.806 1.946 3.42 3.42 0 01-3.138 3.138 3.42 3.42 0 00-1.946.806 3.42 3.42 0 01-4.438 0 3.42 3.42 0 00-1.946-.806 3.42 3.42 0 01-3.138-3.138 3.42 3.42 0 00-.806-1.946 3.42 3.42 0 010-4.438 3.42 3.42 0 00.806-1.946 3.42 3.42 0 013.138-3.138z" />
                                    </svg>
                                    <span>Roles</span>
                                </a>
                                <a href="{{ route('permissions.index') }}" 
                                   class="bg-gray-200 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-300 transition-transform duration-300 transform hover:scale-105 flex items-center space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 15v2m-6 4h12a2 2 0 002-2v-6a2 2 0 00-2-2H6a2 2 0 00-2 2v6a2 2 0 002 2zm10-10V7a4 4 0 00-8 0v4h8z" />
                                    </svg>
                                    <span>Permissions</span>
                                </a>
                                <a href="{{ route('users.index') }}" 
                                   class="bg-gray-200 text-gray-800 px-4 py-2 rounded-lg hover:bg-gray-300 transition-transform duration-300 transform hover:scale-105 flex items-center space-x-2">
                                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-600" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                                    </svg>
                                    <span>Users</span>
                                </a>
                            </div>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('scripts')
    <script>
    function updateClock() {
        const clockElement = document.getElementById('real-time-clock');
        
        // Create a new Date object
        const now = new Date();
        
        // Options for formatting with AM/PM
        const options = {
            timeZone: 'Asia/Kolkata',
            year: 'numeric',
            month: '2-digit',
            day: '2-digit',
            hour: '2-digit',
            minute: '2-digit',
            second: '2-digit',
            hour12: true  // This enables AM/PM
        };
        
        // Format the time
        const formatter = new Intl.DateTimeFormat('en-US', options);
        const parts = formatter.formatToParts(now);
        
        // Find the parts we need
        const year = parts.find(p => p.type === 'year').value;
        const month = parts.find(p => p.type === 'month').value;
        const day = parts.find(p => p.type === 'day').value;
        const hour = parts.find(p => p.type === 'hour').value;
        const minute = parts.find(p => p.type === 'minute').value;
        const second = parts.find(p => p.type === 'second').value;
        const dayPeriod = parts.find(p => p.type === 'dayPeriod').value;
        
        // Construct the formatted date string with AM/PM
        const formattedTime = `${year}-${month}-${day} ${hour}:${minute}:${second} ${dayPeriod}`;
        
        clockElement.textContent = formattedTime;
    }
    
    // Initial call to display time immediately
    updateClock();
    
    // Update clock every second
    setInterval(updateClock, 1000);
</script>
    @endpush
</x-app-layout>