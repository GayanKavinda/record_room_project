<x-app-layout>
    <div class="container py-6">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-semibold mb-4">{{ $department->department_name }}</h1>
            <p class="text-gray-700">Department No: {{ $department->department_no }}</p>
            <a href="{{ route('departments.index') }}" 
               class="mt-4 btn btn-primary">
                Back to Departments
            </a>
        </div>
    </div>
</x-app-layout>
