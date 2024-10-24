<x-app-layout>
    <div class="container py-6">
        <!-- Main Card for Permissions -->
        <div class="bg-white shadow-md rounded-lg p-6">
            <div class="d-flex justify-content-between mb-4">
                <h1 class="text-xl font-semibold">Role Edit</h1>
                <a href="{{ url('roles') }}" 
                   class="btn btn-primary">
                    Back
                </a>
            </div>

            <form action="{{ url('roles/'.$role->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Role Name</label>
                    <input type="text" name="name" value="{{ $role->name }}" class="mt-1 block w-full border border-gray-300 rounded-md shadow-sm focus:ring-blue-500 focus:border-blue-500 dark:bg-gray-700 dark:border-gray-600 dark:text-gray-200 form-control" required>
                </div>
                
                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Update
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
