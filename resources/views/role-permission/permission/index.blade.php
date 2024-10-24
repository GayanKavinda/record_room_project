<x-app-layout>
    <div class="container py-6">
        @include('role-permission.nav-links')
        <br>
        <!-- Main Card for Permissions -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-xl font-semibold mb-4">Permissions</h1>
            
            <!-- Create New Permission Button -->
            <a href="{{ route('permissions.create') }}" 
               class="btn btn-primary mb-4">
                Create Permission
            </a>
            
            <!-- Table Container -->
            <div class="overflow-x-auto">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($permissions as $permission)
                            <tr>
                                <td>{{ $permission->id }}</td>
                                <td>{{ $permission->name }}</td>
                                <td>
                                    <a href="{{ url('permissions/'.$permission->id.'/edit') }}" 
                                       class="btn btn-info">Edit</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
