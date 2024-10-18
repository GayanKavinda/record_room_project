<x-app-layout>
    <div class="max-w-full mx-auto py-6 px-4"> <!-- Set container to full width -->

    @include('role-permission.nav-links')
    <br>
    
        <!-- Main Card for Permissions -->
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            <h1 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Users</h1>
            
            <!-- Create New Permission Button -->
            <a href="{{ url('users/create') }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
                Create User
            </a>

            <br>
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
            <div class="overflow-x-auto w-full"> <!-- Ensure overflow and full width -->
                <table class="min-w-full border-collapse border border-gray-300 w-full"> <!-- Set table to full width -->
                    <thead class="bg-gray-200 dark:bg-gray-700">
                        <tr>
                            <th class="border px-3 py-2 text-left text-gray-900 dark:text-gray-100 text-s">ID</th>
                            <th class="border px-3 py-2 text-left text-gray-900 dark:text-gray-100 text-s">Employee ID</th>
                            <th class="border px-3 py-2 text-left text-gray-900 dark:text-gray-100 text-s">NIC</th>
                            <th class="border px-3 py-2 text-left text-gray-900 dark:text-gray-100 text-s">Name</th>
                            <th class="border px-3 py-2 text-left text-gray-900 dark:text-gray-100 text-s">Email</th>
                            <th class="border px-3 py-2 text-left text-gray-900 dark:text-gray-100 text-s">Department Name</th>
                            <th class="border px-3 py-2 text-left text-gray-900 dark:text-gray-100 text-s">Join or Transfer</th>
                            <th class="border px-3 py-2 text-left text-gray-900 dark:text-gray-100 text-s">Date</th>
                            <th class="border px-3 py-2 text-left text-gray-900 dark:text-gray-100 text-s">Roles</th>
                            <th class="border px-3 py-2 text-left text-gray-900 dark:text-gray-100 text-s">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800">
                        @foreach ($users as $user)
                            <tr class="bg-gray-100 dark:bg-gray-700">
                                <td class="border px-3 py-2 text-gray-900 dark:text-gray-200 text-xs whitespace-normal break-words">{{ $user->id }}</td>
                                <td class="border px-3 py-2 text-gray-900 dark:text-gray-200 text-xs whitespace-normal break-words">{{ $user->employee_id }}</td>
                                <td class="border px-3 py-2 text-gray-900 dark:text-gray-200 text-xs whitespace-normal break-words">{{ $user->nic }}</td>
                                <td class="border px-3 py-2 text-gray-900 dark:text-gray-200 text-xs whitespace-normal break-words">{{ $user->name }}</td>
                                <td class="border px-3 py-2 text-gray-900 dark:text-gray-200 text-xs whitespace-normal break-words">{{ $user->email }}</td>
                                <td class="border px-3 py-2 text-gray-900 dark:text-gray-200 text-xs whitespace-normal break-words">{{ $user->department_name }}</td>
                                <td class="border px-3 py-2 text-gray-900 dark:text-gray-200 text-xs whitespace-normal break-words">{{ $user->join_or_transfer }}</td>
                                <td class="border px-3 py-2 text-gray-900 dark:text-gray-200 text-xs whitespace-normal break-words">{{ $user->date }}</td>
                                <td class="border px-3 py-2 text-gray-900 dark:text-gray-200 text-xs whitespace-normal break-words">
                                    @if (!empty($user->getRoleNames()))
                                        @foreach ($user->getRoleNames() as $rolename)
                                            <span class="inline-block bg-indigo-600 text-white text-xs font-semibold px-2 py-1 rounded-full mx-2 my-1">
                                                {{ $rolename }}
                                            </span>
                                        @endforeach
                                    @endif
                                </td>

                                <td class="border px-3 py-2 text-gray-900 dark:text-gray-200 text-xs whitespace-normal break-words">
                                    <a href="{{ url('users/'.$user->id.'/edit') }}" 
                                       class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</a>

                                    <a href="{{ url('users/'.$user->id.'/delete') }}" 
                                       class="bg-red-600 hover:bg-red-700 text-white font-bold py-2 px-4 rounded">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
