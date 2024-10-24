<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 px-4">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-semibold mb-4">Create New Department</h1>

            <!-- Display Validation Errors -->
            @if ($errors->any())
                <div class="mb-4">
                    <div class="font-medium text-red-600">
                        Whoops! Something went wrong.
                    </div>
                    <ul class="mt-3 list-disc list-inside text-sm text-red-600">
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            <form action="{{ route('departments.store') }}" method="POST">
                @csrf
                <div class="mb-4">
                    <label for="department_name" class="form-label">Department Name</label>
                    <input type="text" id="department_name" name="department_name" required
                           class="form-control">
                </div>
                <div class="mb-4">
                    <label for="department_no" class="form-label">Department No</label>
                    <input type="number" id="department_no" name="department_no" required min="0"
                           class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">
                    Create Department
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
