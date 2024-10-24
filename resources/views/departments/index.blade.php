<x-app-layout>
    <div class="container py-6">
        <!-- Success Message -->
        @if(session('success'))
            <div class="alert alert-success" role="alert">
                {{ session('success') }}
            </div>
        @endif

        <!-- Main Card for All Departments -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-xl font-semibold mb-4">Departments</h1>
            
            <!-- Create New Department Button -->
            <a href="{{ route('departments.create') }}" 
               class="btn btn-primary mb-4">
                Create New Department
            </a>

            <!-- Table Container -->
            <div class="overflow-x-auto">
                <table class="table">
                    <thead class="table-light">
                        <tr>
                            <th>Department Name</th>
                            <th>Department No</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($departments as $department)
                            <tr>
                                <td>{{ $department->department_name }}</td>
                                <td>{{ $department->department_no }}</td>
                                <td>
                                    <a href="{{ route('departments.show', $department->id) }}" 
                                       class="btn btn-success">Show</a>
                                    <a href="{{ route('departments.edit', $department->id) }}" 
                                       class="btn btn-info">Edit</a>
                                    <form action="{{ route('departments.destroy', $department->id) }}" 
                                          method="POST" 
                                          class="d-inline">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="btn btn-danger">
                                            Delete
                                        </button>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</x-app-layout>
