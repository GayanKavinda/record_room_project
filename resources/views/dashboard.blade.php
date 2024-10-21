<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <main class="container mx-auto mt-8 bg-gray-100 min-h-screen p-8">
        <h1 class="text-3xl font-bold mb-8 text-gray-800">Welcome to Record Room Management System</h1>
        
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
            <!-- Search Records Card -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4 text-gray-800">Search Records</h2>
                <form>
                    <input type="text" placeholder="Search by file number, title, or description" class="w-full p-2 border rounded mb-4">
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700 w-full">Search</button>
                </form>
            </div>

            <!-- Quick Actions Card -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4 text-gray-800">Quick Actions</h2>
                <ul class="space-y-2">
                    <li><a href="{{ route('files.index') }}" class="text-blue-600 hover:underline">View All Files</a></li>
                    <li><a href="{{ route('files.create') }}" class="text-blue-600 hover:underline">Add New File</a></li>
                    <li><a href="{{ route('departments.index') }}" class="text-blue-600 hover:underline">Manage Departments</a></li>
                    @include('role-permission.nav-links')
                </ul>
            </div>

            <!-- System Stats Card -->
            <div class="bg-white p-6 rounded-lg shadow-md">
                <h2 class="text-xl font-semibold mb-4 text-gray-800">System Statistics</h2>
                <ul class="space-y-2">
                    <li>Total Records: <span class="font-bold">1,234</span></li>
                    <li>Active Users: <span class="font-bold">42</span></li>
                    <li>Categories: <span class="font-bold">15</span></li>
                </ul>
            </div>
        </div>

        <!-- Recent Activity -->
        <div class="mt-8 bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold mb-4 text-gray-800">Recent Activity</h2>
            <table class="w-full">
                <thead>
                    <tr class="bg-gray-50">
                        <th class="p-2 text-left text-gray-700">Date</th>
                        <th class="p-2 text-left text-gray-700">User</th>
                        <th class="p-2 text-left text-gray-700">Action</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <td class="p-2 text-gray-600">2024-10-14 09:30</td>
                        <td class="p-2 text-gray-600">John Doe</td>
                        <td class="p-2 text-gray-600">Added new record: REC001</td>
                    </tr>
                    <tr class="bg-gray-50">
                        <td class="p-2 text-gray-600">2024-10-14 10:15</td>
                        <td class="p-2 text-gray-600">Jane Smith</td>
                        <td class="p-2 text-gray-600">Updated record: REC002</td>
                    </tr>
                    <tr>
                        <td class="p-2 text-gray-600">2024-10-14 11:00</td>
                        <td class="p-2 text-gray-600">Admin User</td>
                        <td class="p-2 text-gray-600">Created new category: Finance</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </main>

    <footer class="bg-gray-200 mt-12 py-6">
        <div class="container mx-auto text-center text-gray-600">
            &copy; 2024 Record Room Management System. All rights reserved.
        </div>
    </footer>

    <script>
        feather.replace();
    </script>
</body>
</html>
</x-app-layout>
