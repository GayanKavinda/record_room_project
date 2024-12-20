<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 px-4">
        <!-- Main Card for Creating a User -->
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-8">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Create User</h1>
                
                <!-- Back Button with Icon -->
                <a href="{{ url('users') }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg shadow-md inline-flex items-center space-x-2 transition-transform transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-blue-300 focus:ring-opacity-50">
                    <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7"></path>
                    </svg>
                    <span>Back</span>
                </a>
            </div>

            <form action="{{ url('users') }}" method="POST">
                @csrf

                <!-- First Section (Employee ID, Name, NIC, Email) -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Employee ID -->
                    <div>
                        <x-input-label for="employee_id" :value="__('Employee ID')" />
                        <x-text-input id="employee_id" class="block mt-1 w-full" type="text" name="employee_id" :value="old('employee_id')" required autofocus />
                        <x-input-error :messages="$errors->get('employee_id')" class="mt-2" />
                    </div>

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- NIC -->
                    <div>
                        <x-input-label for="nic" :value="__('National Identity Card No')" />
                        <x-text-input id="nic" class="block mt-1 w-full" type="text" name="nic" :value="old('nic')" required />
                        <x-input-error :messages="$errors->get('nic')" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                </div>

                <!-- Second Section (Department, Join/Transfer, Date, Password) -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <!-- Department Name -->
                    <div>
                        <x-input-label for="department_name" :value="__('Department Name')" />
                        <select name="department_name" id="department_name" class="block mt-1 w-full rounded-lg shadow-sm border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                            <option value="">Select Department</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->department_name }}">{{ $department->department_name }}</option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('department_name')" class="mt-2" />
                    </div>

                    <!-- Join or Transfer -->
                    <div>
                        <x-input-label for="join_or_transfer" :value="__('Join or Transfer')" />
                        <select id="join_or_transfer" name="join_or_transfer" class="block mt-1 w-full rounded-lg shadow-sm border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" required>
                            <option value="join">Join</option>
                            <option value="transfer">Transfer</option>
                        </select>
                        <x-input-error :messages="$errors->get('join_or_transfer')" class="mt-2" />
                    </div>

                    <!-- Date -->
                    <div>
                        <x-input-label for="date" :value="__('Join or Transfer Date')" />
                        <x-text-input id="date" class="block mt-1 w-full" type="date" name="date" :value="old('date')" required />
                        <x-input-error :messages="$errors->get('date')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>

                    <!-- Confirm Password -->
                    <div>
                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                        <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                    </div>
                </div>

                <!-- Roles Section -->
                <div class="mt-6">
                    <x-input-label for="roles" :value="__('Roles')" />
                    <select name="roles[]" id="roles" class="block mt-1 w-full rounded-lg shadow-sm border-gray-300 focus:border-blue-500 focus:ring focus:ring-blue-200 focus:ring-opacity-50" multiple>
                        <option value="">Select Role</option>
                        @foreach ($roles as $role)
                            <option value="{{ $role }}">{{ $role }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('roles')" class="mt-2" />
                </div>

                <!-- Submit Button with Icon -->
                <div class="mt-6 flex justify-end">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-lg shadow-sm text-white bg-green-600 hover:bg-green-700 transition-transform transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-green-300 focus:ring-opacity-50">
                        <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                        </svg>
                        <span>Create User</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
