<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 px-4">
        <!-- Main Card for Permissions -->
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-xl font-semibold text-gray-900 dark:text-white">Permissions Create</h1>
                <a href="{{ route('permissions.index') }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Back
                </a>
            </div>

            <form action="{{ route('permissions.store') }}" method="POST">
                @csrf

                <div class="mb-4">
                    <label for="permission-name" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Permission Name</label>
                    <input type="text" name="name" id="permission-name" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200" required>
                </div>
                
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Create
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
