<x-app-layout>
    <div class="container py-6">
        @include('role-permission.nav-links')
        <br>
        
        <!-- Main Card for Permissions -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-xl font-semibold mb-4">Roles</h1>
            
            <!-- Create New Permission Button -->
            <a href="{{ route('roles.create') }}" 
               class="btn btn-primary mb-4">
                Create Roles
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
                        @foreach ($roles as $role)
                            <tr>
                                <td>{{ $role->id }}</td>
                                <td>{{ $role->name }}</td>
                                <td>
                                    <a href="{{ url('roles/'.$role->id.'/give-permissions') }}" 
                                       class="btn btn-warning">Add / Edit Role Permission</a>
                                    <a href="{{ url('roles/'.$role->id.'/edit') }}" 
                                       class="btn btn-info">Edit</a>
                                    <a href="{{ url('roles/'.$role->id.'/delete') }}" 
                                       class="btn btn-danger">Delete</a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
