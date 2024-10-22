<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 px-4">
        <!-- Main Card for Creating a User -->
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-xl font-semibold text-gray-900 dark:text-white">Create User</h1>
                <a href="{{ url('users') }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Back
                </a>
            </div>

            <form action="{{ url('users') }}" method="POST">
                @csrf

                <!-- Employee ID -->
                <div>
                    <x-input-label for="employee_id" :value="__('Employee ID')" />
                    <x-text-input id="employee_id" class="block mt-1 w-full" type="text" name="employee_id" :value="old('employee_id')" required autofocus />
                    <x-input-error :messages="$errors->get('employee_id')" class="mt-2" />
                </div>

                <!-- Name -->
                <div class="mt-4">
                    <x-input-label for="name" :value="__('Name')" />
                    <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required />
                    <x-input-error :messages="$errors->get('name')" class="mt-2" />
                </div>

                <!-- Email -->
                <div class="mt-4">
                    <x-input-label for="email" :value="__('Email')" />
                    <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
                    <x-input-error :messages="$errors->get('email')" class="mt-2" />
                </div>

                <!-- Department Name -->
                <div class="mt-4">
                    <x-input-label for="department_name" :value="__('Department Name')" />
                    <select name="department_name" id="department_name" class="block mt-1 w-full rounded-lg" required>
                        <option value="">Select Department</option>
                        @foreach($departments as $department)
                            <option value="{{ $department->department_name }}">{{ $department->department_name }}</option>
                        @endforeach
                    </select>
                    <x-input-error :messages="$errors->get('department_name')" class="mt-2" />
                </div>

                <!-- Join or Transfer -->
                <div class="mt-4">
                    <x-input-label for="join_or_transfer" :value="__('Join or Transfer')" />
                    <select id="join_or_transfer" name="join_or_transfer" class="block mt-1 w-full rounded-lg" required>
                        <option value="join">Join</option>
                        <option value="transfer">Transfer</option>
                    </select>
                    <x-input-error :messages="$errors->get('join_or_transfer')" class="mt-2" />
                </div>

                <!-- Date -->
                <div class="mt-4">
                    <x-input-label for="date" :value="__('Date')" />
                    <x-text-input id="date" class="block mt-1 w-full" type="date" name="date" :value="old('date')" required />
                    <x-input-error :messages="$errors->get('date')" class="mt-2" />
                </div>

                <!-- Password -->
                <div class="mt-4">
                    <x-input-label for="password" :value="__('Password')" />
                    <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required />
                    <x-input-error :messages="$errors->get('password')" class="mt-2" />
                </div>

                <!-- Confirm Password -->
                <div class="mt-4">
                    <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                    <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required />
                    <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                </div>

                <!-- Roles -->
                <div class="mb-3">
                    <label for="">Roles</label>
                    <select name="roles[]" class="form-control" id="" multiple>
                        <option value="">Select Role</option>
                        @foreach ($roles as $role)
                        <option value="{{ $role }}">{{ $role}}</option>
                        @endforeach
                    </select>

                </div> 
                <br>
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Create User
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
