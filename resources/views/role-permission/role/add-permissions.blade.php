<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 px-4">
        <!-- Header Section with Separate Color -->
        <div class="bg-blue-500 dark:bg-blue-800 text-white shadow-md rounded-lg p-6 mb-4">
            <div class="flex justify-between items-center">
                <h1 class="text-xl font-semibold">Role: {{ $role->name}}</h1>
                <a href="{{ url('roles') }}" 
                   class="bg-white hover:bg-gray-100 text-blue-500 font-bold py-2 px-4 rounded">
                    Back
                </a>
            </div>
        </div>

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

        <!-- Permissions Section with Different Color -->
        <div class="bg-gray-100 dark:bg-gray-700 shadow-md rounded-lg p-6">
            <form action="{{ url('roles/'.$role->id.'/give-permissions') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    @error('permission')
                    <span class="text-red-700">{{ $message }}</span>
                    @enderror

                    <label for="permissions" class="block text-lg font-semibold text-gray-800 dark:text-gray-100 mb-2">
                        Permissions
                    </label>

                    <!-- Permissions Grid -->
                    <div id="permissions" class="grid grid-cols-4 gap-6 p-4 bg-gray-50 dark:bg-gray-800 rounded-lg shadow-inner">
                        @foreach ($permissions as $permission)
                        <div class="flex items-center">
                            <label class="text-gray-900 dark:text-gray-200">
                                <input 
                                    type="checkbox" 
                                    name="permission[]" 
                                    value="{{ $permission->name }}"
                                    {{ in_array($permission->id, $rolePermissions) ? 'checked':'' }}
                                    class="mr-2"
                                />
                                {{ $permission->name }}
                            </label>
                        </div>
                        @endforeach
                    </div>
                </div>

                <button type="submit" class="inline-flex items-center px-4 py-2 border border-transparent text-sm font-medium rounded-md shadow-sm text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                    Update
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
