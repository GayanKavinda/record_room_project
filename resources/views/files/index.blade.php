<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 px-4">

        <!-- Main Card for All Files -->
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            <!-- Filter Form -->
            <h1 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Filters</h1>
            <form method="GET" action="{{ route('files.index') }}" class="mb-4" id="filter-form">
    <div class="flex flex-wrap gap-4">
        <!-- Status Filter -->
        <div class="relative w-full md:w-1/6">
            <label for="status" class="absolute left-3 top-2 text-gray-600 dark:text-gray-300"><i class="fas fa-tasks"></i></label>
            <select name="status" id="status" class="form-select w-full p-2 text-sm border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 focus:outline-none pl-10">
                <option value="">All Statuses</option>
                <option value="Pending" {{ request('status') == 'Pending' ? 'selected' : '' }}>Pending</option>
                <option value="Stored" {{ request('status') == 'Stored' ? 'selected' : '' }}>Stored</option>
                <option value="Active" {{ request('status') == 'Active' ? 'selected' : '' }}>Active</option>        
            </select>
        </div>

        <!-- Department Filter (Visible only for Super Admin) -->
        @if(auth()->user()->hasRole('super-admin'))
            <div class="relative w-full md:w-1/2">
                <label for="department" class="absolute left-3 top-2 text-gray-600 dark:text-gray-300"><i class="fas fa-building"></i></label>
                <select name="department" id="department" class="form-select w-full p-2 text-sm border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 focus:outline-none pl-10">
                    <option value="">All Departments</option>
                    @foreach($departments as $department)
                        <option value="{{ $department->department_name }}" {{ request('department') == $department->department_name ? 'selected' : '' }}>
                            {{ $department->department_name }}
                        </option>
                    @endforeach
                </select>
            </div>
        @endif

        <!-- File Number Filter -->
        <div class="relative w-full md:w-1/4">
            <label for="file_no" class="absolute left-3 top-2 text-gray-600 dark:text-gray-300"><i class="fas fa-file-alt"></i></label>
            <input type="text" name="file_no" id="file_no" placeholder="File Number" value="{{ request('file_no') }}" class="form-input w-full p-2 text-sm border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 focus:outline-none pl-10">
        </div>

        <!-- Responsible Officer Filter -->
        <div class="relative w-full md:w-1/4">
            <label for="responsible_officer" class="absolute left-3 top-2 text-gray-600 dark:text-gray-300"><i class="fas fa-user-tie"></i></label>
            <input type="text" name="responsible_officer" id="responsible_officer" placeholder="Responsible Officer" value="{{ request('responsible_officer') }}" class="form-input w-full p-2 text-sm border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 focus:outline-none pl-10">
        </div>

        <!-- Date Range Filter for Open, Close, and Given Dates -->
        <div class="flex w-full md:w-1/2 gap-4">
            <div class="relative w-full">
                <label for="date_filter" class="absolute left-3 top-2 text-gray-600 dark:text-gray-300"><i class="fas fa-calendar-day"></i></label>
                <input type="date" name="date_filter" id="date_filter" value="{{ request('date_filter') }}" class="form-input w-full p-2 text-sm border border-gray-300 rounded focus:ring-2 focus:ring-blue-500 focus:outline-none pl-10">
            </div>
        </div>

        <!-- Submit Button -->
        <div class="w-full md:w-auto mt-4 md:mt-0">
            <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded w-full md:w-auto transition duration-300 ease-in-out transform hover:scale-105">
                <i class="fas fa-filter"></i> Filter
            </button>
        </div>

        <!-- Reset Button -->
        <div class="w-full md:w-auto mt-4 md:mt-0">
            <button type="button" onclick="resetFilters()" class="bg-red-500 hover:bg-gray-400 text-black font-bold py-2 px-4 rounded w-full md:w-auto transition duration-300 ease-in-out transform hover:scale-105">
                <i class="fas fa-times"></i> Reset
            </button>
        </div>
    </div>
</form>

            <br>

            <h1 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Files</h1>

            <!-- Create New File Button -->
            @if(Auth::user()->hasRole('super-admin') || Auth::user()->hasRole('admin'))
            <a href="{{ route('files.create') }}" 
                class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-flex items-center transition duration-300 ease-in-out transform hover:scale-105">
                <i class="fas fa-plus mr-2"></i> <!-- Icon for 'Create' -->
                Create New File
            </a>
            @endif

            <!-- Success Message -->
            @if(session('success'))
                <div 
                    x-data="{ show: true }"
                    x-init="setTimeout(() => show = false, 3000)"
                    x-show="show"
                    x-transition
                    class="bg-green-100 border-l-4 border-green-500 text-green-700 p-2 mb-4 max-w-md mx-auto rounded"
                    role="alert">
                    <p class="font-bold">Success</p>
                    <p>{{ session('success') }}</p>
                </div>
            @endif

            <!-- Error Message -->
            @if(session('error'))
                <div 
                    x-data="{ show: true }"
                    x-init="setTimeout(() => show = false, 3000)"
                    x-show="show"
                    x-transition
                    class="bg-red-100 border-l-4 border-red-500 text-red-700 p-2 mb-4 max-w-md mx-auto rounded"
                    role="alert">
                    <p class="font-bold">Error</p>
                    <p>{{ session('error') }}</p>
                </div>
            @endif

            <!-- Table Container -->
            <div class="overflow-x-auto">
                <table class="min-w-full border-collapse border border-gray-300 rounded mb-4">
                <thead class="bg-gradient-to-r from-indigo-500 via-violet-500 to-purple-500 text-white">
                    <tr>
                        <th class="border px-3 py-2 text-left text-sm">FILE NO</th>
                        <th class="border px-3 py-2 text-left text-sm">RESPONSIBLE OFFICER</th>
                        <th class="border px-3 py-2 text-left text-sm">OPEN DATE</th>
                        <th class="border px-3 py-2 text-left text-sm">CLOSE DATE</th>
                        <th class="border px-3 py-2 text-left text-sm">GIVEN DATE</th>
                        <!-- <th class="border px-3 py-2 text-left text-sm">PAGE CAPACITY</th> -->
                        <!-- <th class="border px-3 py-2 text-left text-sm">NOTE</th> -->
                        <!-- Status Column -->
                        <th class="border px-3 py-2 text-left text-sm">STATUS</th>
                        <th class="border px-3 py-2 text-left text-sm">EXPIRE DATE</th>
                        @if (Auth::user()->hasRole('super-admin'))
                            <th class="border px-3 py-2 text-left text-sm">DEPARTMENT NAME</th>
                        @endif
                        <th class="border px-3 py-2 text-left text-sm">ACTIONS</th>
                    </tr>
                </thead>

                    <tbody class="text-sm text-gray-700 dark:text-gray-200">
                    @foreach ($files as $file)
                    <tr data-file-id="{{ $file->id }}" class="hover:bg-green-100 dark:hover:bg-emerald-700 transition-all duration-300">
                        <td class="border px-3 py-2 text-gray-900 dark:text-gray-200 text-sm">{{ $file->file_no }}</td>
                        <td class="border px-3 py-2 text-gray-900 dark:text-gray-200 text-sm">{{ $file->responsible_officer }}</td>
                        <td class="border px-3 py-2 text-gray-900 dark:text-gray-200 text-sm">{{ $file->open_date }}</td>
                        <td class="border px-3 py-2 text-gray-900 dark:text-gray-200 text-sm">{{ $file->close_date ?? 'N/A' }}</td>
                        <td class="border px-3 py-2 text-gray-900 dark:text-gray-200 text-sm">{{ $file->given_date }}</td>
                        <!-- <td class="border px-3 py-2 text-gray-900 dark:text-gray-200 text-sm">{{ $file->page_capacity }}</td> -->
                        <!-- <td class="border px-3 py-2 text-gray-900 dark:text-gray-200 text-sm text-wrap">{{ $file->note }}</td> -->
                        <td class="border px-3 py-2 text-gray-900 dark:text-gray-200 text-sm" id="status-cell-{{ $file->id }}">{{ $file->status }}</td>
                        <td class="border px-3 py-2 text-gray-900 dark:text-gray-200 text-sm">{{ $file->expire_date }}</td>
                        @if (Auth::user()->hasRole('super-admin'))
                            <td class="border px-3 py-2 text-gray-900 dark:text-gray-200 text-sm">{{ $file->department->department_name ?? 'N/A' }}</td>
                        @endif
                        <!-- Table Container -->
                        <td class="border px-3 py-2">
                        <!-- Wrapper for buttons and status message -->
                        <div class="flex items-center justify-start space-x-2"> <!-- Flex to align horizontally -->
                            <!-- Show Button -->
                            <a href="{{ route('files.show', $file->id) }}" 
                                class="bg-gradient-to-r from-green-400 to-yellow-200 hover:from-green-500 hover:to-green-700 text-white font-semibold py-1 px-2 rounded text-sm inline-flex items-center transition duration-300 ease-in-out transform hover:scale-105 whitespace-nowrap">
                                <i class="fa-solid fa-face-grin-hearts mr-1"></i> Show
                            </a>

                            <!-- Edit Button -->
                            <button id="edit-button-{{ $file->id }}"
                                    onclick="openModal({{ $file->id }}, '{{ addslashes($file->file_no) }}', '{{ addslashes($file->responsible_officer) }}', '{{ $file->given_date }}', '{{ $file->page_capacity }}', '{{ addslashes($file->note) }}', '{{ $file->expire_date }}')"
                                    class="bg-gradient-to-r from-blue-400 to-blue-600 hover:from-blue-500 hover:to-blue-700 text-white font-semibold py-1 px-2 rounded text-sm inline-flex items-center transition duration-300 ease-in-out transform hover:scale-105 whitespace-nowrap {{ $file->status === 'Pending' || $file->status === 'Stored' ? 'opacity-50 cursor-not-allowed' : '' }}"
                                    {{ $file->status === 'Pending' || $file->status === 'Stored' ? 'disabled' : '' }}>
                                <i class="fas fa-edit mr-1"></i>
                                {{ $file->status === 'Pending' || $file->status === 'Stored' ? 'Locked Edit' : 'Edit' }}
                            </button>

                            <!-- Delete Button -->
                            <form action="{{ route('files.destroy', $file->id) }}" method="POST" class="inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" 
                                        id="delete-button-{{ $file->id }}" 
                                        class="bg-gradient-to-r from-red-400 to-red-600 hover:from-red-500 hover:to-red-700 text-white font-semibold py-1 px-2 rounded text-sm inline-flex items-center transition duration-300 ease-in-out transform hover:scale-105 whitespace-nowrap {{ $file->status === 'Pending' || $file->status === 'Stored' ? 'opacity-50 cursor-not-allowed' : '' }}"
                                        {{ $file->status === 'Pending' || $file->status === 'Stored' ? 'disabled' : '' }}>
                                    <i class="fas fa-trash-alt mr-1"></i> Delete
                                </button>
                            </form>

                            <!-- Request Record File Button -->
                            <!-- @if ($file->status === 'Pending' || $file->status === 'Stored')
                                <button class="bg-gradient-to-r from-yellow-400 to-yellow-600 hover:from-yellow-500 hover:to-yellow-700 text-white font-semibold py-1 px-2 rounded text-sm inline-flex items-center transition duration-300 ease-in-out transform hover:scale-105 whitespace-nowrap">
                                    <i class="fa-solid fa-file-arrow-down mr-1"></i> Request Record File
                                </button>
                            @endif -->

                            <!-- Request Record File Button -->       <!-- $file->status === 'Pending' ||  -->
                            <!-- <form action="" method="POST">
                                @csrf
                                @if ($file->status === 'Stored') 
                                    <button type="submit" class="bg-gradient-to-r from-yellow-400 to-yellow-600 hover:from-yellow-500 hover:to-yellow-700 text-white font-semibold py-1 px-2 rounded text-sm inline-flex items-center transition duration-300 ease-in-out transform hover:scale-105 whitespace-nowrap">
                                        <i class="fa-solid fa-file-arrow-down mr-1"></i> Request Record File
                                    </button>
                                @endif
                            </form> -->

                            <!-- Send to Record Room Button or Status Message -->
                            <div class="ml-auto flex items-center space-x-2"> <!-- Align to the right side -->
                                @if ($file->status !== 'Stored' && $file->status !== 'Pending')
                                    <button id="send-button-{{ $file->id }}"
                                            onclick="sendToRecordRoom({{ $file->id }})"
                                            class="bg-gradient-to-r from-gray-400 to-gray-600 hover:from-gray-500 hover:to-gray-700 text-white font-semibold py-1 px-2 rounded text-sm transition duration-300 ease-in-out whitespace-nowrap">
                                        Send to Record Room
                                    </button>
                                @elseif ($file->status === 'Pending')
                                    <!-- Display icon and outline for 'Pending' status -->
                                    <span class="flex items-center space-x-1 text-yellow-600 border border-yellow-500 rounded-lg px-2 py-1 bg-yellow-100 whitespace-nowrap">
                                        <i class="fas fa-hourglass-half text-yellow-600"></i>
                                        <span>File is pending rack assignment.</span>
                                    </span>
                                @else
                                    <!-- Display icon and outline for 'File Stored' -->
                                    <span class="flex items-center space-x-1 text-gray-500 border border-gray-400 rounded-lg px-2 py-1 bg-gray-100 whitespace-nowrap">
                                        <i class="fas fa-check-circle text-green-500"></i>
                                        <span>File Stored</span>
                                    </span>
                                @endif
                            </div>
                        </div>
                    </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            
            <!-- Pagination -->
            <div class="flex justify-between items-center mt-4">
                <!-- Custom text showing pagination info -->
                <div class="text-sm text-gray-700">
                    @if ($files->hasPages())
                        <span>Showing {{ $files->firstItem() }} to {{ $files->lastItem() }} of {{ $files->total() }} results</span>
                    @else
                        <span>No results found</span>
                    @endif
                </div>

                <!-- Custom Pagination Links -->
                <div class="inline-flex items-center space-x-2">
                    <!-- Previous Button -->
                    @if ($files->onFirstPage())
                        <span class="px-3 py-1 text-gray-500 bg-gray-100 cursor-not-allowed">Previous</span>
                    @else
                        <a href="{{ $files->previousPageUrl() }}" class="px-3 py-1 text-blue-600 hover:text-blue-800">Previous</a>
                    @endif

                    <!-- Page Numbers -->
                    @foreach ($files->getUrlRange(max(1, $files->currentPage() - 5), min($files->lastPage(), $files->currentPage() + 5)) as $page => $url)
                        @if ($page == $files->currentPage())
                            <span class="px-3 py-1 text-white bg-blue-600">{{ $page }}</span>
                        @else
                            <a href="{{ $url }}" class="px-3 py-1 text-blue-600 hover:text-blue-800">{{ $page }}</a>
                        @endif
                    @endforeach

                    <!-- Next Button -->
                    @if ($files->hasMorePages())
                        <a href="{{ $files->nextPageUrl() }}" class="px-3 py-1 text-blue-600 hover:text-blue-800">Next</a>
                    @else
                        <span class="px-3 py-1 text-gray-500 bg-gray-100 cursor-not-allowed">Next</span>
                    @endif
                </div>

                <!-- Jump to Page Text Field and Go Button -->
                <div class="flex items-center space-x-2 ml-4">
                    <label for="jump-to-page" class="text-sm text-gray-700">Jump to page:</label>
                    <input type="number" id="jump-to-page" min="1" max="{{ $files->lastPage() }}" class="px-3 py-1 border rounded text-sm w-16" value="{{ $files->currentPage() }}" aria-label="Page Number">
                    <button onclick="goToPage()" class="px-3 py-1 text-white bg-blue-600 hover:bg-blue-800 rounded text-sm">Go</button>
                </div>
            </div>
        </div>
    </div>

    <!-- Edit Modal -->
    <div id="editModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-gray-900 bg-opacity-50" role="dialog" aria-modal="true">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-md">
            <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Edit File</h2>
            
            <form id="editForm" method="POST">
                @csrf
                @method('PUT')

                <!-- File No (Non-editable) -->
                <div class="mb-4">
                    <label for="modal_file_no" class="block text-sm font-medium text-gray-700 dark:text-gray-300">File No</label>
                    <input type="text" id="modal_file_no" name="file_no" required value="" readonly
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600">
                </div>

                <!-- Responsible Officer -->
                <div class="mb-4">
                    <label for="modal_responsible_officer" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Responsible Officer</label>
                    <input type="text" id="modal_responsible_officer" name="responsible_officer" required
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600">
                </div>

                <!-- Given Date -->
                <div class="mb-4">
                    <label for="modal_given_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Given Date</label>
                    <input type="date" id="modal_given_date" name="given_date"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600">
                </div>

                <!-- Page Capacity -->
                <div class="mb-4">
                    <label for="modal_page_capacity" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Page Capacity</label>
                    <input type="number" id="modal_page_capacity" name="page_capacity"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600">
                </div>

                <!-- Note -->
                <div class="mb-4">
                    <label for="modal_note" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Note</label>
                    <textarea id="modal_note" name="note" rows="4"
                              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600"></textarea>
                </div>

                <!-- Expire Date -->
                <div class="mb-4">
                    <label for="modal_expire_date" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Expire Date</label>
                    <input type="date" id="modal_expire_date" name="expire_date"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600">
                </div>

                <!-- Buttons -->
                <div class="flex justify-end">
                    <button type="button" onclick="closeModal()" class="bg-gray-400 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded mr-2">Cancel</button>
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">Update</button>
                </div>
            </form>
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <script>

    // Reset the filter form and clear the URL parameters
    function resetFilters() {
        
        // Reset form fields
        document.getElementById('filter-form').reset();

        // Clear URL query parameters by reloading the page without any parameters
        const currentUrl = window.location.href.split('?')[0];
        window.history.replaceState(null, '', currentUrl);
        location.reload(); // Reload the page to reflect the reset
    }

    function openModal(id, fileNo, responsibleOfficer, givenDate, pageCapacity, note, expireDate) {
        document.getElementById('modal_file_no').value = fileNo;
        document.getElementById('modal_responsible_officer').value = responsibleOfficer;
        document.getElementById('modal_given_date').value = givenDate;
        document.getElementById('modal_page_capacity').value = pageCapacity;
        document.getElementById('modal_note').value = note;
        document.getElementById('modal_expire_date').value = expireDate;
        document.getElementById('editForm').action = '/files/' + id; // Set the action to the correct route
        document.getElementById('editModal').classList.remove('hidden');
    }

    function closeModal() {
        document.getElementById('editModal').classList.add('hidden');
    }

    document.getElementById('editForm').addEventListener('submit', function(event) {
        event.preventDefault();
        const formData = new FormData(this);

        fetch(this.action, {
            method: 'POST',
            headers: {
                'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
            },
            body: formData
        })
        .then(response => {
            if (!response.ok) {
                return response.json().then(errorData => { throw errorData; });
            }
            return response.json();
        })
        .then(data => {
            if (data.success) {
                location.reload(); // Reload the page on success
            }
        })
        .catch(error => {
            console.error('Error:', error);
            alert(error.message || 'An error occurred while updating the file.');
        });
    });

    function sendToRecordRoom(fileId) {
    const sendButton = document.getElementById(`send-button-${fileId}`);
    const editButton = document.getElementById(`edit-button-${fileId}`);
    const deleteButton = document.getElementById(`delete-button-${fileId}`);
    const statusCell = document.getElementById(`status-cell-${fileId}`);

    // Disable the send button immediately
    sendButton.disabled = true;
    sendButton.classList.add('bg-gray-400', 'cursor-not-allowed');
    sendButton.classList.remove('hover:bg-gray-700');

    // Disable the Edit and Delete buttons if status is not 'Stored'
    if (editButton && deleteButton) {
        editButton.disabled = true;
        deleteButton.disabled = true;
        editButton.classList.add('bg-gray-400', 'cursor-not-allowed');
        deleteButton.classList.add('bg-gray-400', 'cursor-not-allowed');
    }

    // Update the file status to 'Pending'
    fetch('/files/send-to-record-room', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({ file_id: fileId })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Update the file status on the UI
            statusCell.textContent = 'Pending';
            alert("File status updated to Pending. Please assign a rack.");
        } else {
            // alert(data.message);
            alert("Failed to update file status.");
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while sending the file to the record room.');
    });
}


// When rack is assigned, update the file status to 'Stored'
function assignRack(fileId, rackDetails) {
    fetch('/files/assign-rack', {
        method: 'POST',
        headers: {
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
            'Content-Type': 'application/json'
        },
        body: JSON.stringify({
            file_id: fileId,
            rack_details: rackDetails
        })
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            // Change the button text to "File Stored"
            const sendButton = document.getElementById(`send-button-${fileId}`);
            sendButton.textContent = 'File Stored';
            sendButton.classList.remove('bg-gray-500');
            sendButton.classList.add('bg-gray-300');
        } else {
            alert(data.message);
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while assigning the rack.');
    });
}

function goToPage() {
        var page = document.getElementById('jump-to-page').value;
        var maxPage = {{ $files->lastPage() }};
        if (page >= 1 && page <= maxPage) {
            window.location.href = '?page=' + page;
        } else {
            alert('Please enter a valid page number between 1 and ' + maxPage);
        }
    }
</script>

</x-app-layout>

