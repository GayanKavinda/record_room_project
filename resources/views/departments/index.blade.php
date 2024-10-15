<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 px-4" x-data="{ open: false }" x-init="if ('{{ session('success') }}') { open = true; setTimeout(() => { open = false }, 10000); }">
        <!-- Success Message -->
        <div x-show="open" 
             x-transition:enter="transition ease-out duration-300" 
             x-transition:enter-start="opacity-0 transform -translate-y-4" 
             x-transition:enter-end="opacity-100 transform translate-y-0" 
             x-transition:leave="transition ease-in duration-300" 
             x-transition:leave-start="opacity-100" 
             x-transition:leave-end="opacity-0" 
             class="bg-gradient-to-r from-purple-500 to-red-500 text-white font-bold px-4 py-2 rounded mb-4 max-w-md"
             @click="open = false">
            <div class="flex justify-between items-center">
                <span>{{ session('success') }}</span>
                <button @click="open = false" class="ml-2 focus:outline-none">
                    <!-- Close Icon (SVG) -->
                    <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12" />
                    </svg>
                </button>
            </div>
        </div>

        <!-- Main Card for All Departments -->
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            <h1 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Departments</h1>
            
            <!-- Create New Department Button -->
            <a href="{{ route('departments.create') }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
                Create New Department
            </a>

            <!-- Table Container -->
            <div class="overflow-x-auto">
                <table class="min-w-full border-collapse border border-gray-300">
                    <thead class="bg-gray-200 dark:bg-gray-700">
                        <tr>
                            <th class="border px-3 py-2 text-left text-gray-900 dark:text-gray-100 text-sm">Department Name</th>
                            <th class="border px-3 py-2 text-left text-gray-900 dark:text-gray-100 text-sm">Department No</th>
                            <th class="border px-3 py-2 text-left text-gray-900 dark:text-gray-100 text-sm">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800">
                        @foreach ($departments as $department)
                            <tr class="bg-gray-100 dark:bg-gray-700">
                                <td class="border px-3 py-2 text-gray-900 dark:text-gray-200 text-sm">{{ $department->department_name }}</td>
                                <td class="border px-3 py-2 text-gray-900 dark:text-gray-200 text-sm">{{ $department->department_no }}</td>
                                <td class="border px-3 py-2">
                                    <!-- Show Button -->
                                    <a href="{{ route('departments.show', $department->id) }}" 
                                       class="bg-green-500 hover:bg-green-600 text-white font-semibold py-1 px-2 rounded mr-2 text-sm">
                                        Show
                                    </a>
                                    <!-- Edit Button -->
                                    <a href="{{ route('departments.edit', $department->id) }}" 
                                       class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-1 px-2 rounded mr-2 text-sm">
                                        Edit
                                    </a>
                                    <!-- Delete Button -->
                                    <form action="{{ route('departments.destroy', $department->id) }}" 
                                          method="POST" 
                                          class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-2 rounded text-sm">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
