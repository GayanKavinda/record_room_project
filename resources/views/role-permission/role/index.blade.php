<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 px-4">

    @include('role-permission.nav-links')
    <br>
    
        <!-- Main Card for Permissions -->
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            <h1 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Roles</h1>
            
            <!-- Create New Permission Button -->
            <a href="{{ route('roles.create') }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
                Create Roles
            </a>

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
            <div class="overflow-x-auto">
                <table class="min-w-full border-collapse border border-gray-300">
                    <thead class="bg-gray-200 dark:bg-gray-700">
                        <tr>
                            <th class="border px-3 py-2 text-left text-gray-900 dark:text-gray-100 text-sm">ID</th>
                            <th class="border px-3 py-2 text-left text-gray-900 dark:text-gray-100 text-sm">Name</th>
                            <th class="border px-3 py-2 text-left text-gray-900 dark:text-gray-100 text-sm">Action</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800">
                        @foreach ($roles as $role)
                            <tr class="bg-gray-100 dark:bg-gray-700">
                                <td class="border px-3 py-2 text-gray-900 dark:text-gray-200 text-sm">{{ $role->id }}</td>
                                <td class="border px-3 py-2 text-gray-900 dark:text-gray-200 text-sm">{{ $role->name }}</td>
                                <td class="border px-3 py-2 text-gray-900 dark:text-gray-200 text-sm">
                                    
                                    <a href="{{ url('roles/'.$role->id.'/give-permissions') }}" 
                                    class="bg-orange-600 hover:bg-purple-700 text-white font-bold py-2 px-4 rounded">Add / Edit Role Permission</a>

                                    <a href="{{ url('roles/'.$role->id.'/edit') }}" 
                                    class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">Edit</a>

                                    <a href="{{ url('roles/'.$role->id.'/delete') }}" 
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
