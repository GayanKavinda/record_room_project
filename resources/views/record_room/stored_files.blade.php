<x-app-layout>
    <div class="container mx-auto py-6 px-4 sm:px-6 lg:px-8">

        <!-- Add Filter Form -->
        <form method="GET" action="{{ route('record-room.storedFiles') }}" class="mb-4 bg-white shadow-md rounded px-8 pt-6 pb-8 mb-4">
            <h2 class="text-lg font-semibold mb-4">Filter Stored Files</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-4 gap-4">
                <div>
                    <label for="status" class="block text-sm font-medium text-gray-700">Status</label>
                    <select name="status" id="status" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">All Statuses</option>
                        <option value="Pending">Pending</option>
                        <option value="Stored">Stored</option>
                    </select>
                </div>

                <div>
                    <label for="department" class="block text-sm font-medium text-gray-700">Department</label>
                    <select name="department" id="department" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500">
                        <option value="">All Departments</option>
                        @foreach ($departments as $department)
                            <option value="{{ $department->department_name }}">{{ $department->department_name }}</option>
                        @endforeach
                    </select>
                </div>

                <div>
                    <label for="file_no" class="block text-sm font-medium text-gray-700">File Number</label>
                    <input type="text" name="file_no" id="file_no" placeholder="File Number" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                </div>

                <div>
                    <label for="responsible_officer" class="block text-sm font-medium text-gray-700">Responsible Officer</label>
                    <input type="text" name="responsible_officer" id="responsible_officer" placeholder="Responsible Officer" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" />
                </div>
            </div>

            <div class="mt-4">
                <button type="submit" class="bg-indigo-500 text-white rounded-md p-2 hover:bg-indigo-600">Filter</button>
            </div>
<br>
            
            <h2 class="text-xl font-semibold text-gray-800 dark:text-gray-200 mb-4 flex items-center">
                <x-heroicon-o-document class="w-6 h-6 mr-2 text-indigo-500" />
                Stored Files
            </h2>
            
            @if ($storedFiles->isEmpty())
                <p class="text-gray-600 dark:text-gray-400 text-sm">No stored files found.</p>
            @else
                <div class="overflow-x-auto shadow-lg rounded-lg bg-white dark:bg-gray-800">
                    <table class="min-w-full table-auto border-collapse">
                        <thead class="bg-gradient-to-r from-indigo-500 via-purple-500 to-pink-500 text-white">
                            <tr>
                                <th class="px-4 py-3 text-xs font-medium text-left uppercase">File Number</th>
                                <th class="px-4 py-3 text-xs font-medium text-left uppercase">Responsible Officer</th>
                                <th class="px-4 py-3 text-xs font-medium text-left uppercase">Status</th>
                                <th class="px-4 py-3 text-xs font-medium text-left uppercase">Rack Letter</th>
                                <th class="px-4 py-3 text-xs font-medium text-left uppercase">Sub Rack</th>
                                <th class="px-4 py-3 text-xs font-medium text-left uppercase">Cell Number</th>
                                <th class="px-4 py-3 text-xs font-medium text-left uppercase">Department</th>
                                <th class="px-4 py-3 text-xs font-medium text-left uppercase">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="text-sm text-gray-700 dark:text-gray-200">
                            @foreach ($storedFiles as $file)
                                <tr class="hover:bg-indigo-100 dark:hover:bg-gray-700 transition-all duration-300">
                                    <td class="px-4 py-3 border-b border-gray-300 dark:border-gray-600">{{ $file->file_no }}</td>
                                    <td class="px-4 py-3 border-b border-gray-300 dark:border-gray-600">{{ $file->responsible_officer }}</td>
                                    <td class="px-4 py-3 border-b border-gray-300 dark:border-gray-600">{{ $file->status }}</td>
                                    <td class="px-4 py-3 border-b border-gray-300 dark:border-gray-600">{{ $file->rack_letter }}</td>
                                    <td class="px-4 py-3 border-b border-gray-300 dark:border-gray-600">{{ $file->sub_rack }}</td>
                                    <td class="px-4 py-3 border-b border-gray-300 dark:border-gray-600">{{ $file->cell_number }}</td>
                                    <td class="px-4 py-3 border-b border-gray-300 dark:border-gray-600">{{ $file->department->department_name ?? 'N/A' }}</td>
                                    <td class="px-4 py-3 border-b border-gray-300 dark:border-gray-600 flex space-x-2">
                                        <!-- Edit Button with Icon -->
                                        <a href="{{ route('files.edit', $file->id) }}" class="text-blue-500 hover:text-blue-700 flex items-center space-x-1">
                                            <x-heroicon-o-pencil class="w-5 h-5" />
                                            <span>Edit</span>
                                        </a>
                                        
                                        <!-- Delete Button with Icon -->
                                        <form action="{{ route('files.destroy', $file->id) }}" method="POST" onsubmit="return confirm('Are you sure you want to delete this file?')" class="inline-block">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-red-500 hover:text-red-700 flex items-center space-x-1">
                                                <x-heroicon-o-trash class="w-5 h-5" />
                                                <span>Delete</span>
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endif
        </form>
        
    </div>
</x-app-layout>
