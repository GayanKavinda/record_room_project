<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 px-4">
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-semibold mb-4 text-gray-900 dark:text-white">Edit File</h1>

            <form action="{{ route('files.update', $file->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="file_no" class="block text-sm font-medium text-gray-700 dark:text-gray-300">File No</label>
                    <input type="text" id="file_no" name="file_no" value="{{ old('file_no', $file->file_no) }}" required
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600">
                </div>
                <div class="mb-4">
                    <label for="responsible_officer" class="block text-sm font-medium text-gray-700 dark:text-gray-300">File Responsible Officer</label>
                    <input type="text" id="responsible_officer" name="responsible_officer" value="{{ old('responsible_officer', $file->responsible_officer) }}" required
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600">
                </div>
                <div class="mb-4">
                    <label for="open_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Open Date</label>
                    <input type="date" id="open_date" name="open_date" value="{{ old('open_date', $file->open_date) }}" required
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600">
                </div>
                <div class="mb-4">
                    <label for="close_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Close Date</label>
                    <input type="date" id="close_date" name="close_date" value="{{ old('close_date', $file->close_date) }}"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600">
                </div>
                <button type="submit"
                        class="w-full bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded dark:bg-blue-600 dark:hover:bg-blue-700">
                    Update File
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
