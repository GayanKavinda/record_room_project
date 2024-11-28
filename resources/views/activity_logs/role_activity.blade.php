<x-app-layout>
    <div class="container mx-auto px-4 py-8">
        <div class="bg-white shadow-xl rounded-lg overflow-hidden">
            <div class="px-6 py-4 bg-gray-50 border-b border-gray-200 flex items-center justify-between">
                <h1 class="text-2xl font-bold text-gray-800 flex items-center">
                    <i class="fas fa-list-alt text-blue-500 mr-3"></i> <!-- Font Awesome icon -->
                    Role Activity Logs
                </h1>
            </div>

            <!-- Filters -->
            <form method="GET" action="{{ route('role-activity-logs.index') }}" class="px-6 py-4">
                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-4">
                    <!-- Role Filter -->
                    <div>
                        <label for="role_id" class="block text-sm font-medium text-gray-700">Role</label>
                        <select name="role_id" id="role_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
                            <option value="">All Roles</option>
                            @foreach($roles as $role)
                                <option value="{{ $role->id }}" {{ request('role_id') == $role->id ? 'selected' : '' }}>{{ $role->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- User Filter -->
                    <div>
                        <label for="user_id" class="block text-sm font-medium text-gray-700">User</label>
                        <select name="user_id" id="user_id" class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
                            <option value="">All Users</option>
                            @foreach($users as $user)
                                <option value="{{ $user->id }}" {{ request('user_id') == $user->id ? 'selected' : '' }}>{{ $user->name }}</option>
                            @endforeach
                        </select>
                    </div>

                    <!-- Date Filter -->
                    <div>
                        <label for="filter_date" class="block text-sm font-medium text-gray-700">Filter by Updated Date</label>
                        <input type="date" name="filter_date" id="filter_date" value="{{ request('filter_date') }}"
                            class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md">
                    </div>
                </div>

                <div class="flex justify-end mt-4 space-x-4">
                    <!-- Filter Button -->
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md hover:bg-blue-600">
                        <i class="fas fa-filter mr-2"></i> <!-- Filter icon -->
                        Filter
                    </button>

                    <!-- Reset Button -->
                    <a href="{{ route('role-activity-logs.index') }}" class="px-4 py-2 bg-gray-300 text-gray-800 rounded-md hover:bg-gray-400">
                        <i class="fas fa-sync-alt mr-2"></i> <!-- Reset icon -->
                        Reset
                    </a>
                </div>
            </form>

            <!-- Table -->
            <div class="overflow-x-auto">
                <table class="w-full table-auto">
                    <thead class="bg-gray-100 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"><i class="fas fa-info-circle mr-2"></i>Details</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"><i class="fas fa-user-tag mr-2"></i>Role</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"><i class="fas fa-user mr-2"></i>User</th>
                            <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase"><i class="fas fa-clock mr-2"></i>Timestamp</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white divide-y divide-gray-200 text-sm">
                        @foreach($logs as $log)
                            <tr>
                                <td class="px-6 py-4">{{ $log->details }}</td>
                                <td class="px-6 py-4">{{ $log->role ? $log->role->name : 'N/A' }}</td>
                                <td class="px-6 py-4">{{ $log->user->name }}</td>
                                <td class="px-6 py-4">{{ $log->created_at }}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                <div class="px-6 py-4">
                    {{ $logs->links() }} <!-- Pagination links -->
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
