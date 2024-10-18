<x-app-layout>
    <div class="max-w-full mx-auto py-8 px-6">
        @include('role-permission.nav-links')
        <br>

        <!-- Main Card for Users -->
        <div class="bg-white dark:bg-gray-800 shadow-lg rounded-lg p-8">
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-3xl font-bold text-gray-900 dark:text-white">User Management</h1>

                <!-- Create New User Button -->
                <a href="{{ url('users/create') }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-6 rounded-lg shadow-lg inline-flex items-center space-x-2 transition-transform transform hover:scale-105 focus:outline-none focus:ring-4 focus:ring-blue-300 focus:ring-opacity-50">
                    <svg class="w-5 h-5 animate-pulse" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4v16m8-8H4"></path>
                    </svg>
                    <span>Create User</span>
                </a>
            </div>

            <!-- Success Message -->
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
                    class="bg-green-100 border-l-4 border-green-500 text-green-700 p-4 mb-4 rounded-lg shadow-md max-w-md mx-auto"
                    role="alert"
                >
                    <p class="font-bold">Success</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <!-- Table Container -->
            <div class="overflow-x-auto rounded-lg shadow-lg">
                <table class="min-w-full border-collapse bg-white dark:bg-gray-800">
                    <thead class="bg-gray-200 dark:bg-gray-700">
                        <tr>
                            <th class="border px-4 py-3 text-left text-gray-900 dark:text-gray-100 font-bold text-sm">ID</th>
                            <th class="border px-4 py-3 text-left text-gray-900 dark:text-gray-100 font-bold text-sm">Employee ID</th>
                            <th class="border px-4 py-3 text-left text-gray-900 dark:text-gray-100 font-bold text-sm">NIC</th>
                            <th class="border px-4 py-3 text-left text-gray-900 dark:text-gray-100 font-bold text-sm">Name</th>
                            <th class="border px-4 py-3 text-left text-gray-900 dark:text-gray-100 font-bold text-sm">Email</th>
                            <th class="border px-4 py-3 text-left text-gray-900 dark:text-gray-100 font-bold text-sm">Department</th>
                            <th class="border px-4 py-3 text-left text-gray-900 dark:text-gray-100 font-bold text-sm">Join/Transfer</th>
                            <th class="border px-4 py-3 text-left text-gray-900 dark:text-gray-100 font-bold text-sm">Date</th>
                            <th class="border px-4 py-3 text-left text-gray-900 dark:text-gray-100 font-bold text-sm">Roles</th>
                            <th class="border px-4 py-3 text-center text-gray-900 dark:text-gray-100 font-bold text-sm">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800 divide-y divide-gray-100 dark:divide-gray-700">
                        @foreach ($users as $user)
                            <tr class="hover:bg-gray-50 dark:hover:bg-gray-700 transition-colors duration-200">
                                <td class="border px-4 py-3 text-gray-900 dark:text-gray-200 text-sm">{{ $user->id }}</td>
                                <td class="border px-4 py-3 text-gray-900 dark:text-gray-200 text-sm">{{ $user->employee_id }}</td>
                                <td class="border px-4 py-3 text-gray-900 dark:text-gray-200 text-sm">{{ $user->nic }}</td>
                                <td class="border px-4 py-3 text-gray-900 dark:text-gray-200 text-sm">{{ $user->name }}</td>
                                <td class="border px-4 py-3 text-gray-900 dark:text-gray-200 text-sm">{{ $user->email }}</td>
                                <td class="border px-4 py-3 text-gray-900 dark:text-gray-200 text-sm">{{ $user->department_name }}</td>
                                <td class="border px-4 py-3 text-gray-900 dark:text-gray-200 text-sm">{{ $user->join_or_transfer }}</td>
                                <td class="border px-4 py-3 text-gray-900 dark:text-gray-200 text-sm">{{ $user->date }}</td>
                                <td class="border px-4 py-3 text-gray-900 dark:text-gray-200 text-sm">
                                    <div class="flex space-x-2">
                                        @foreach ($user->getRoleNames() as $rolename)
                                            <span class="bg-indigo-600 text-white text-xs font-semibold px-2 py-1 rounded-full">{{ $rolename }}</span>
                                        @endforeach
                                    </div>
                                </td>

                                <!-- Action Buttons -->
                                <td class="border px-4 py-3 text-center text-gray-900 dark:text-gray-200 text-sm">
                                    <div class="flex justify-center space-x-2">
                                        <!-- Edit Button -->
                                        <a href="{{ url('users/'.$user->id.'/edit') }}" 
                                           class="bg-yellow-500 hover:bg-yellow-600 text-white font-bold py-2 px-4 rounded-lg shadow-lg inline-flex items-center space-x-2 transition-transform transform hover:scale-105">
                                            <svg class="w-5 h-5 animate-spin" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12H9m0 0H4m5 0V7m0 5v5m0-5h6"></path>
                                            </svg>
                                            <span>Edit</span>
                                        </a>

                                        <!-- Delete Button -->
                                        <button 
                                           class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded-lg shadow-lg inline-flex items-center space-x-2 transition-transform transform hover:scale-105" 
                                           onclick="confirmDelete({{ $user->id }})">
                                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                                            </svg>
                                            <span>Delete</span>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Delete Confirmation Modal -->
            <div id="deleteModal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
                <div class="bg-gradient-to-r from-blue-500 to-purple-500 rounded-lg shadow-lg p-6 max-w-sm w-full">
                    <div class="flex items-center mb-4">
                        <svg class="w-6 h-6 text-white mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"></path>
                        </svg>
                        <h2 class="text-lg font-bold text-white">Confirm Delete</h2>
                    </div>
                    <p class="mb-4 text-white">Are you sure you want to delete this user? This action cannot be undone.</p>
                    <div class="flex justify-end">
                        <button id="cancelBtn" class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-bold py-2 px-4 rounded mr-2 transition ease-in-out duration-150">Cancel</button>
                        <button id="confirmDeleteBtn" class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded transition ease-in-out duration-150">Delete</button>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script>
        let userIdToDelete;

        function confirmDelete(userId) {
            userIdToDelete = userId;
            document.getElementById('deleteModal').classList.remove('hidden');
        }

        document.getElementById('cancelBtn').addEventListener('click', function() {
            document.getElementById('deleteModal').classList.add('hidden');
        });

        document.getElementById('confirmDeleteBtn').addEventListener('click', function() {
            window.location.href = `{{ url('users') }}/${userIdToDelete}/delete`;
        });
    </script>
</x-app-layout>
