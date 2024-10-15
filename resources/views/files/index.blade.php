<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 px-4">
        <!-- Main Card for All Files -->
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            <h1 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Files</h1>
            
            <!-- Create New File Button -->
            <a href="{{ route('files.create') }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
                Create New File
            </a>

            @if(session('success'))
                <div 
                    x-data="{ show: true }"
                    x-init="setTimeout(() => show = false, 3000)"
                    x-show="show"
                    x-transition:enter="transition ease-out duration-500"
                    x-transition:enter-start="opacity-0 transform scale-90"
                    x-transition:enter-end="opacity-100 transform scale-100"
                    x-transition:leave="transition ease-in duration-500"
                    x-transition:leave-start="opacity-100 transform scale-100"
                    x-transition:leave-end="opacity-0 transform scale-90"
                    class="bg-green-100 border-l-4 border-green-500 text-green-700 p-2 mb-4 max-w-md mx-auto rounded"
                    role="alert"
                >
                    <p class="font-bold">Success</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif


            <!-- Table Container -->
            <div class="overflow-x-auto">
                <table class="min-w-full border-collapse border border-gray-300">
                    <thead class="bg-gray-200 dark:bg-gray-700">
                        <tr>
                            <th class="border px-3 py-2 text-left text-gray-900 dark:text-gray-100 text-sm">File No</th>
                            <th class="border px-3 py-2 text-left text-gray-900 dark:text-gray-100 text-sm">Responsible Officer</th>
                            <th class="border px-3 py-2 text-left text-gray-900 dark:text-gray-100 text-sm">Open Date</th>
                            <th class="border px-3 py-2 text-left text-gray-900 dark:text-gray-100 text-sm">Close Date</th>
                            <th class="border px-3 py-2 text-left text-gray-900 dark:text-gray-100 text-sm">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800">
                        @foreach ($files as $file)
                            <tr class="bg-gray-100 dark:bg-gray-700">
                                <td class="border px-3 py-2 text-gray-900 dark:text-gray-200 text-sm">{{ $file->file_no }}</td>
                                <td class="border px-3 py-2 text-gray-900 dark:text-gray-200 text-sm">{{ $file->responsible_officer }}</td>
                                <td class="border px-3 py-2 text-gray-900 dark:text-gray-200 text-sm">{{ $file->open_date }}</td>
                                <td class="border px-3 py-2 text-gray-900 dark:text-gray-200 text-sm">{{ $file->close_date ?? 'N/A' }}</td>
                                <td class="border px-3 py-2">
                                    <!-- Show Button -->
                                    <a href="{{ route('files.show', $file->id) }}" 
                                       class="bg-green-500 hover:bg-green-600 text-white font-semibold py-1 px-2 rounded mr-2 text-sm">
                                        Show
                                    </a>
                                    <!-- Edit Button -->
                                    <a href="{{ route('files.edit', $file->id) }}" 
                                       class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-1 px-2 rounded mr-2 text-sm">
                                        Edit
                                    </a>
                                    <!-- Delete Button -->
                                    <form action="{{ route('files.destroy', $file->id) }}" 
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
