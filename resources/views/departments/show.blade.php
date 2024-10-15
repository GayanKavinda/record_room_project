<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 px-4">
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-semibold mb-4 text-gray-900 dark:text-white">{{ $department->department_name }}</h1>
            <p class="text-gray-700 dark:text-gray-300">Department No: {{ $department->department_no }}</p>
            <a href="{{ route('departments.index') }}" 
               class="mt-4 inline-block bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                Back to Departments
            </a>
        </div>
    </div>
</x-app-layout>
