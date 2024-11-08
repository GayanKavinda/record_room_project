<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 px-4">
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            <h1 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Record Room Files</h1>

            @if(session('success'))
                <div class="bg-green-100 border-l-4 border-green-500 text-green-700 p-2 mb-4 rounded" role="alert">
                    <p class="font-bold">Success</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <div class="overflow-x-auto">
                <table class="min-w-full border-collapse border border-gray-300">
                    <thead class="bg-gray-200 dark:bg-gray-700">
                        <tr>
                            <th class="border px-3 py-2 text-left">File No</th>
                            <th class="border px-3 py-2 text-left">Responsible Officer</th>
                            <th class="border px-3 py-2 text-left">Rack Letter</th>
                            <th class="border px-3 py-2 text-left">Sub Rack</th>
                            <th class="border px-3 py-2 text-left">Cell Number</th>
                            <th class="border px-3 py-2 text-left">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($files as $file)
                            <tr>
                                <td class="border px-3 py-2">{{ $file->file_no }}</td>
                                <td class="border px-3 py-2">{{ $file->responsible_officer }}</td>
                                <form action="{{ route('files.assignRackLocation', $file->id) }}" method="POST">
                                    @csrf
                                    <td class="border px-3 py-2">
                                        <input type="text" name="rack_letter" class="border rounded w-full" required>
                                    </td>
                                    <td class="border px-3 py-2">
                                        <input type="number" name="sub_rack" class="border rounded w-full" required>
                                    </td>
                                    <td class="border px-3 py-2">
                                        <input type="number" name="cell_number" class="border rounded w-full" required>
                                    </td>
                                    <td class="border px-3 py-2">
                                        <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Assign</button>
                                    </td>
                                </form>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
