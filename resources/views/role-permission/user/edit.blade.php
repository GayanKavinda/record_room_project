<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 px-4">
        <!-- Main Card for Editing a User with Modern Design -->
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-2xl font-bold text-gray-900 dark:text-white">Edit User</h1>
                <a href="{{ url('users') }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded transition duration-200 flex items-center">
                    <i class="fas fa-arrow-left mr-2"></i> Back
                </a>
            </div>

            <form action="{{ url('users/'.$user->id) }}" method="POST">
                @csrf
                @method('PUT')

                <!-- First Section (Employee ID, Name, NIC, Email) -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                    <!-- Employee ID -->
                    <div>
                        <x-input-label for="employee_id" :value="__('Employee ID')" />
                        <x-text-input id="employee_id" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-300" type="text" name="employee_id" value="{{ $user->employee_id}}" required autofocus />
                        <x-input-error :messages="$errors->get('employee_id')" class="mt-2" />
                    </div>

                    <!-- Name -->
                    <div>
                        <x-input-label for="name" :value="__('Name')" />
                        <x-text-input id="name" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-300" type="text" name="name" value="{{ $user->name}}" required />
                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                    </div>

                    <!-- NIC -->
                    <div>
                        <x-input-label for="nic" :value="__('National Identity Card No')" />
                        <x-text-input id="nic" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-300" type="text" name="nic" value="{{ $user->nic}}" required />
                        <x-input-error :messages="$errors->get('nic')" class="mt-2" />
                    </div>

                    <!-- Email -->
                    <div>
                        <x-input-label for="email" :value="__('Email')" />
                        <x-text-input id="email" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-300" type="email" name="email" value="{{ $user->email}}" required />
                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                    </div>
                </div>

                <!-- Second Section (Department, Join/Transfer, Date, Password) -->
                <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6">
                    <!-- Department Name -->
                    <div>
                        <x-input-label for="department_name" :value="__('Department Name')" />
                        <select name="department_name" id="department_name" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-300" required>
                            <option value="">Select Department</option>
                            @foreach($departments as $department)
                                <option value="{{ $department->department_name }}" {{ $user->department_name == $department->department_name ? 'selected' : '' }}>
                                    {{ $department->department_name }}
                                </option>
                            @endforeach
                        </select>
                        <x-input-error :messages="$errors->get('department_name')" class="mt-2" />
                    </div>

                    <!-- Join or Transfer -->
                    <div>
                        <x-input-label for="join_or_transfer" :value="__('Join or Transfer')" />
                        <select id="join_or_transfer" name="join_or_transfer" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-300" required>
                            <option value="join" {{ $user->join_or_transfer == 'join' ? 'selected' : '' }}>Join</option>
                            <option value="transfer" {{ $user->join_or_transfer == 'transfer' ? 'selected' : '' }}>Transfer</option>
                        </select>
                        <x-input-error :messages="$errors->get('join_or_transfer')" class="mt-2" />
                    </div>

                    <!-- Date -->
                    <div>
                        <x-input-label for="date" :value="__('Join or Transfer Date')" />
                        <x-text-input id="date" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-300" 
                            type="date" 
                            name="date" 
                            value="{{ old('date', \Carbon\Carbon::parse($user->date)->format('Y-m-d')) }}" 
                            required />
                        <x-input-error :messages="$errors->get('date')" class="mt-2" />
                    </div>

                    <!-- Password -->
                    <div>
                        <x-input-label for="password" :value="__('Password')" />
                        <x-text-input id="password" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-300" type="password" name="password" />
                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                    </div>
                </div>

                <!-- Roles Section -->
                <div class="mt-6">
                    <x-input-label for="roles" :value="__('Roles')" />
                    <select name="roles[]" id="roles" class="block mt-1 w-full border-gray-300 rounded-lg shadow-sm focus:border-blue-500 focus:ring focus:ring-blue-200 transition duration-300" multiple>
                        <option value="">Select Role</option>
                        @foreach ($roles as $role)
                            <option 
                                value="{{ $role }}" 
                                {{ in_array($role, $userRoles) ? 'selected' : '' }}>
                                {{ $role }}
                            </option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('roles')" class="mt-2" />
                </div>

                <!-- Submit Button -->
                <div class="mt-6">
                    <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-md text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500 transition duration-200">
                        <i class="fas fa-save mr-2"></i> Update User
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>
