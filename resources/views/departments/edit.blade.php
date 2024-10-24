<x-app-layout>
    <div class="container py-6">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-semibold mb-4">{{ isset($department) ? 'Edit Department' : 'Create New Department' }}</h1>

            <form action="{{ isset($department) ? route('departments.update', $department->id) : route('departments.store') }}" method="POST">
                @csrf
                @if (isset($department))
                    @method('PUT')
                @endif

                <div class="mb-4">
                    <label for="department_name" class="form-label">Department Name</label>
                    <input type="text" id="department_name" name="department_name" value="{{ old('department_name', isset($department) ? $department->department_name : '') }}" 
                           class="form-control" required>
                </div>
                <div class="mb-4">
                    <label for="department_no" class="form-label">Department No</label>
                    <input type="number" id="department_no" name="department_no" value="{{ old('department_no', isset($department) ? $department->department_no : '') }}" 
                           class="form-control" required min="0">
                </div>

                <button type="submit" class="btn btn-primary">
                    {{ isset($department) ? 'Update' : 'Create' }} Department
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
