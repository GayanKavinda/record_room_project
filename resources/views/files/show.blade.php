<x-app-layout>
    <div class="max-w-4xl mx-auto py-6 px-4">
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-6 transition-transform transform hover:scale-105">
            <!-- File Responsible Officer -->
            <h1 class="text-xl font-semibold text-gray-900 dark:text-white mb-4 flex items-center">
                <i class="fas fa-user-tie mr-2 text-blue-500"></i>
                {{ $file->responsible_officer }}
            </h1>

            <!-- File Details Section -->
            <div class="space-y-4 text-sm">
                <!-- File No -->
                <div class="flex items-center space-x-2">
                    <i class="fas fa-file-alt text-gray-500"></i>
                    <p class="text-gray-700 dark:text-gray-300">File No: <span class="font-semibold">{{ $file->file_no }}</span></p>
                </div>

                <!-- Open Date -->
                <div class="flex items-center space-x-2">
                    <i class="fas fa-calendar-day text-gray-500"></i>
                    <p class="text-gray-700 dark:text-gray-300">Open Date: <span class="font-semibold">{{ $file->open_date }}</span></p>
                </div>

                <!-- Close Date -->
                <div class="flex items-center space-x-2">
                    <i class="fas fa-calendar-times text-gray-500"></i>
                    <p class="text-gray-700 dark:text-gray-300">Close Date: <span class="font-semibold">{{ $file->close_date ?? 'N/A' }}</span></p>
                </div>

                <!-- Given Date -->
                <div class="flex items-center space-x-2">
                    <i class="fas fa-calendar-alt text-gray-500"></i>
                    <p class="text-gray-700 dark:text-gray-300">Given Date: <span class="font-semibold">{{ $file->given_date ?? 'N/A' }}</span></p>
                </div>

                <!-- Expire Date -->
                <div class="flex items-center space-x-2">
                    <i class="fas fa-calendar-xmark text-gray-500"></i>
                    <p class="text-gray-700 dark:text-gray-300">Expire Date: <span class="font-semibold">{{ $file->expire_date ?? 'N/A' }}</span></p>
                </div>

                <!-- Page Capacity -->
                <div class="flex items-center space-x-2">
                    <i class="fas fa-file-pdf text-gray-500"></i>
                    <p class="text-gray-700 dark:text-gray-300">Page Capacity: <span class="font-semibold">{{ $file->page_capacity ?? 'N/A' }}</span></p>
                </div>

                <!-- Note -->
                <div class="flex items-center space-x-2">
                    <i class="fas fa-sticky-note text-gray-500"></i>
                    <p class="text-gray-700 dark:text-gray-300">Note: <span class="font-semibold">{{ $file->note ?? 'No Notes' }}</span></p>
                </div>

                <!-- Status -->
                <div class="flex items-center space-x-2">
                    <i class="fas fa-tasks text-gray-500"></i>
                    <p class="text-gray-700 dark:text-gray-300">Status: <span class="font-semibold">{{ $file->status ?? 'N/A' }}</span></p>
                </div>

                <!-- Assigned Rack Location -->
                <div class="flex items-center space-x-2">
                    <i class="fas fa-cogs text-gray-500"></i>
                    <p class="text-gray-700 dark:text-gray-300">Assigned Rack: <span class="font-semibold">{{ $file->rack_location ?? 'Not Assigned' }}</span></p>
                </div>

                <!-- Responsible Officer -->
                <div class="flex items-center space-x-2">
                    <i class="fas fa-user text-gray-500"></i>
                    <p class="text-gray-700 dark:text-gray-300">Responsible Officer: <span class="font-semibold">{{ $file->responsible_officer }}</span></p>
                </div>
            </div>

            <!-- Back Button with Hover Effect -->
            <div class="mt-6">
                <a href="{{ route('files.index') }}" 
                   class="inline-block bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded-lg transition duration-300 ease-in-out transform hover:scale-105">
                    <i class="fas fa-arrow-left mr-2"></i> Back to Files
                </a>
            </div>
        </div>
    </div>
</x-app-layout>
