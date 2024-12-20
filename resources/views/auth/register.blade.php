<x-guest-layout>
    <form method="POST" action="{{ route('register') }}">
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

        <!-- NIC (National Identity Card No) -->
        <div class="mt-4">
            <x-input-label for="nic" :value="__('National Identity Card No')" />
            <x-text-input id="nic" class="block mt-1 w-full" type="text" name="nic" :value="old('nic')" required />
            <x-input-error :messages="$errors->get('nic')" class="mt-2" />
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

        <!-- Email Address -->
        <div class="mt-4">
            <x-input-label for="email" :value="__('Email')" />
            <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
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

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                {{ __('Already registered?') }}
            </a>

            <x-primary-button class="ms-4">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
