<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 px-4">
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-semibold mb-4 text-gray-900 dark:text-white">{{ isset($department) ? 'Edit Department' : 'Create New Department' }}</h1>

            <form action="{{ isset($department) ? route('departments.update', $department->id) : route('departments.store') }}" method="POST">
                @csrf
                @if (isset($department))
                    @method('PUT')
                @endif

                <div class="mb-4">
                    <label for="department_name" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Department Name</label>
                    <input type="text" id="department_name" name="department_name" value="{{ old('department_name', isset($department) ? $department->department_name : '') }}" 
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600" required>
                </div>
                
                <div class="mb-4">
                    <label for="department_no" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Department No</label>
                    <input type="number" id="department_no" name="department_no" value="{{ old('department_no', isset($department) ? $department->department_no : '') }}" 
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600" required min="0">
                </div>

                <button type="submit"
                        class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded dark:bg-blue-600 dark:hover:bg-blue-700">
                    {{ isset($department) ? 'Update' : 'Create' }} Department
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
