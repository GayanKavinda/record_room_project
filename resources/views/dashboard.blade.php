<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100">
                    {{ __("You're logged in!") }}
                </div>

                <div class="p-6 text-gray-900 dark:text-gray-100">
                <a href="{{ route('departments.index') }}" 
                class="bg-blue-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
                    All Departments
                </a>

                <a href="{{ route('files.index') }}" 
                class="bg-green-600 hover:bg-yellow-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
                    Files
                </a>

                @include('role-permission.nav-links')
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
