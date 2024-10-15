<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 px-4">
        <!-- Main Card for Permissions -->
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            <div class="flex justify-between items-center mb-4">
                <h1 class="text-xl font-semibold text-gray-900 dark:text-white">Role : {{ $role->name}}</h1>
                <a href="{{ url('roles') }}" 
                   class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                    Back
                </a>
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



            <form action="{{ url('roles/'.$role->id.'/give-permissions') }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    @error('permission')
                    <span class="text-red-700">{{ $message }}</span>
                    @enderror

                    <label for="" class="block text-sm font-medium text-gray-700 dark:text-gray-200">Permissions</label>

                    <div class="row">
                        @foreach ($permissions as $permission)
                        
                        <div class="col-md-2">
                            <label>
                                <input 
                                    type="checkbox" 
                                    name="permission[]" 
                                    value="{{ $permission->name }}"
                                    {{ in_array($permission->id, $rolePermissions) ? 'checked':'' }}
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
