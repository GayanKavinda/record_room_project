<x-app-layout>
    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                {{ __('Dashboard') }}
            </h2>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-3xl font-bold text-gray-800 mb-8">Welcome to Record Room Management System</h1>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Search Records Card -->
                        <div class="bg-blue-100 p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                            <h2 class="text-xl font-semibold mb-4">Search Records</h2>
                            <form>
                                <input type="text" placeholder="Search by file number, title, or description" class="w-full p-2 border border-gray-300 rounded mb-4">
                                <button type="submit" class="w-full bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 transition-transform duration-300 transform hover:scale-105">Search</button>
                            </form>
                        </div>

                        <!-- Quick Actions Card -->
                        <div class="bg-green-100 p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                            <h2 class="text-xl font-semibold mb-4">Quick Actions</h2>
                            <ul class="space-y-2">
                                <li><a href="{{ route('files.index') }}" class="text-green-600 hover:underline">View All Files</a></li>
                                <li><a href="{{ route('files.create') }}" class="text-green-600 hover:underline">Add New File</a></li>
                                <li><a href="{{ route('departments.index') }}" class="text-green-600 hover:underline">Manage Departments</a></li>
                                <div class="flex space-x-2 mt-2">
                                    <a href="{{ route('roles.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400 transition-transform duration-300 transform hover:scale-105">Roles</a>
                                    <a href="{{ route('permissions.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400 transition-transform duration-300 transform hover:scale-105">Permissions</a>
                                    <a href="{{ route('users.index') }}" class="bg-gray-300 text-gray-800 px-4 py-2 rounded hover:bg-gray-400 transition-transform duration-300 transform hover:scale-105">Users</a>
                                </div>
                            </ul>
                        </div>

                        <!-- System Stats Card -->
                        <div class="bg-yellow-100 p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                            <h2 class="text-xl font-semibold mb-4">System Statistics</h2>
                            <ul class="space-y-2">
                                <li>Total Records: <span class="font-bold">1,234</span></li>
                                <li>Active Users: <span class="font-bold">42</span></li>
                                <li>Categories: <span class="font-bold">15</span></li>
                            </ul>
                        </div>

                        <!-- Messages Section -->
                        <div class="bg-purple-100 p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                            <h2 class="text-xl font-semibold mb-4">Messages</h2>
                            <div id="messages">
                                <div class="message-card cursor-pointer mb-4 p-4 border rounded hover:shadow-lg transition-transform duration-300 transform hover:scale-105" onclick="showMessage('Message Title 1', 'This is the full content of message 1.')">
                                    <h3 class="font-bold">Message Title 1</h3>
                                    <p class="text-gray-600">Short description of message 1...</p>
                                </div>
                                <div class="message-card cursor-pointer mb-4 p-4 border rounded hover:shadow-lg transition-transform duration-300 transform hover:scale-105" onclick="showMessage('Message Title 2', 'This is the full content of message 2.')">
                                    <h3 class="font-bold">Message Title 2</h3>
                                    <p class="text-gray-600">Short description of message 2...</p>
                                </div>
                            </div>
                        </div>

                        <!-- Recent Activity Section -->
                        <div class="bg-red-100 p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                            <h2 class="text-xl font-semibold mb-4">Recent Activity</h2>
                            <div class="bg-white rounded-lg shadow-md overflow-hidden">
                                <table class="w-full">
                                    <thead class="bg-gray-200">
                                        <tr>
                                            <th class="px-4 py-2 text-left text-gray-600">Date</th>
                                            <th class="px-4 py-2 text-left text-gray-600">User</th>
                                            <th class="px-4 py-2 text-left text-gray-600">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="border-t">
                                            <td class="px-4 py-2">2024-10-14 09:30</td>
                                            <td class="px-4 py-2">John Doe</td>
                                            <td class="px-4 py-2">Added new record: <span class="text-blue-600">REC001</span></td>
                                        </tr>
                                        <tr class="border-t">
                                            <td class="px-4 py-2">2024-10-14 10:15</td>
                                            <td class="px-4 py-2">Jane Smith</td>
                                            <td class="px-4 py-2">Updated record: <span class="text-blue-600">REC002</span></td>
                                        </tr>
                                        <tr class="border-t">
                                            <td class="px-4 py-2">2024-10-14 11:00</td>
                                            <td class="px-4 py-2">Admin User</td>
                                            <td class="px-4 py-2">Created new category: <span class="text-blue-600">Finance</span></td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!-- Create Admin Account Card -->
                        <div class="bg-orange-100 p-6 rounded-lg shadow-md hover:shadow-lg transition-shadow duration-300">
                            <h2 class="text-xl font-semibold mb-4">Create Admin Account</h2>
                            <button onclick="showAdminForm()" class="w-full bg-orange-600 text-white px-4 py-2 rounded hover:bg-orange-700 transition-transform duration-300 transform hover:scale-105">Create Admin Account</button>
                        </div>

                        <!-- Popup Modal for Message Content -->
                        <div id="messageModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                            <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
                                <h2 id="modalTitle" class="text-xl font-bold mb-2"></h2>
                                <p id="modalContent" class="text-gray-700 mb-4"></p>
                                <div class="flex justify-between">
                                    <button class="bg-green-400 text-white px-4 py-1.5 rounded transition-transform duration-300 transform hover:scale-105">Accept</button>
                                    <button class="bg-red-400 text-white px-4 py-0 rounded transition-transform duration-300 transform hover:scale-105">Reject</button>
                                    <button onclick="closeMessage()" class="bg-gray-300 text-gray-800 px-4 py-2 rounded transition-transform duration-300 transform hover:scale-105">Cancel</button>
                                </div>
                            </div>
                        </div>

                        <!-- Popup Modal for Admin Account Creation -->
                        <div id="adminModal" class="fixed inset-0 flex items-center justify-center bg-black bg-opacity-50 hidden">
                            <div class="bg-white p-6 rounded-lg shadow-lg max-w-md w-full">
                                <h2 class="text-xl font-bold mb-2">Create Admin Account</h2>
                                <form id="adminForm">
                                    <div class="mb-4">
                                        <label for="admin_name" class="block text-sm font-medium text-gray-700">Admin Name</label>
                                        <input type="text" id="admin_name" name="admin_name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                                        <input type="password" id="password" name="password" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                                        <input type="email" id="email" name="email" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="user_type_id" class="block text-sm font-medium text-gray-700">User Type ID</label>
                                        <input type="text" id="user_type_id" name="user_type_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="employee_id" class="block text-sm font-medium text-gray-700">Employee ID</label>
                                        <input type="text" id="employee_id" name="employee_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                    </div>
                                    <div class="mb-4">
                                        <label for="department_id" class="block text-sm font-medium text-gray-700">Department ID</label>
                                        <input type="text" id="department_id" name="department_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500" required>
                                    </div>
                                    <div class="flex justify-between">
                                        <button type="button" onclick="clearForm()" class="bg-gray-300 text-gray-800 px-4 py-2 rounded transition-transform duration-300 transform hover:scale-105">Clear</button>
                                        <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded transition-transform duration-300 transform hover:scale-105">Submit</button>
                                        <button onclick="closeAdminForm()" class="bg-red-600 text-white px-4 py-2 rounded transition-transform duration-300 transform hover:scale-105">Cancel</button>
                                    </div>
                                </form>
                            </div>
                        </div>

                        <script>
                            function showMessage(title, content) {
                                document.getElementById('modalTitle').innerText = title;
                                document.getElementById('modalContent').innerText = content;
                                document.getElementById('messageModal').classList.remove('hidden');
                            }

                            function closeMessage() {
                                document.getElementById('messageModal').classList.add('hidden');
                            }

                            function showAdminForm() {
                                document.getElementById('adminModal').classList.remove('hidden');
                            }


                            function closeAdminForm() {
                                document.getElementById('adminModal').classList.add('hidden');
                            }

                            function clearForm() {
                                document.getElementById('adminForm').reset();
                            }
                        </script>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <?php
date_default_timezone_set('Asia/Colombo');
echo date("Y-m-d H:i:s");
?>
</x-app-layout>
