<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight mb-4">
                {{ __('Dashboard') }}
            </h2>
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                    <h1 class="text-3xl font-bold text-indigo-800 mb-8">Welcome to Record Room Management System</h1>
                    
                    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                        <!-- Search Records Card -->
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <h2 class="text-xl font-semibold mb-4">Search Records</h2>
                            <form>
                                <input type="text" placeholder="Search by file number, title, or description" class="w-full p-2 border border-gray-300 rounded mb-4">
                                <button type="submit" class="w-full bg-indigo-600 text-white px-4 py-2 rounded hover:bg-indigo-700">Search</button>
                            </form>
                        </div>

                        <!-- Quick Actions Card -->
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <h2 class="text-xl font-semibold mb-4">Quick Actions</h2>
                            <ul class="space-y-2">
                                <li><a href="{{ route('files.index') }}" class="text-indigo-600 hover:underline">View All Files</a></li>
                                <li><a href="{{ route('files.create') }}" class="text-indigo-600 hover:underline">Add New File</a></li>
                                <li><a href="{{ route('departments.index') }}" class="text-indigo-600 hover:underline">Manage Departments</a></li>
                                <div class="flex space-x-2 mt-2">
                                    <a href="{{ route('roles.index') }}" class="bg-gray-200 text-gray-700 px-3 py-1 rounded hover:bg-gray-300">Roles</a>
                                    <a href="{{ route('permissions.index') }}" class="bg-gray-200 text-gray-700 px-3 py-1 rounded hover:bg-gray-300">Permissions</a>
                                    <a href="{{ route('users.index') }}" class="bg-gray-200 text-gray-700 px-3 py-1 rounded hover:bg-gray-300">Users</a>
                                </div>
                            </ul>
                        </div>

                        <!-- System Stats Card -->
                        <div class="bg-white p-6 rounded-lg shadow-md">
                            <h2 class="text-xl font-semibold mb-4">System Statistics</h2>
                            <ul class="space-y-2">
                                <li>Total Records: <span class="font-bold">1,234</span></li>
                                <li>Active Users: <span class="font-bold">42</span></li>
                                <li>Categories: <span class="font-bold">15</span></li>
                            </ul>
                        </div>
                    </div>

                    <!-- Recent Activity -->
                    <div class="mt-8">
                        <h2 class="text-2xl font-semibold mb-4">Recent Activity</h2>
                        <div class="bg-white rounded-lg shadow-md overflow-hidden">
                            <table class="w-full">
                                <thead class="bg-gray-100">
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
                                        <td class="px-4 py-2">Added new record: <span class="text-indigo-600">REC001</span></td>
                                    </tr>
                                    <tr class="border-t">
                                        <td class="px-4 py-2">2024-10-14 10:15</td>
                                        <td class="px-4 py-2">Jane Smith</td>
                                        <td class="px-4 py-2">Updated record: <span class="text-indigo-600">REC002</span></td>
                                    </tr>
                                    <tr class="border-t">
                                        <td class="px-4 py-2">2024-10-14 11:00</td>
                                        <td class="px-4 py-2">Admin User</td>
                                        <td class="px-4 py-2">Created new category: <span class="text-indigo-600">Finance</span></td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
