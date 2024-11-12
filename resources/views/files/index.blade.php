<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 px-4">
        <!-- Main Card for All Files -->
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
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
                        <th class="border px-3 py-2 text-left text-sm">PAGE CAPACITY</th>
                        <th class="border px-3 py-2 text-left text-sm">NOTE</th>
                        <!-- Status Column -->
                        <th class="border px-3 py-2 text-left text-sm">STATUS</th>
                        <th class="border px-3 py-2 text-left text-sm">EXPIRE DATE</th>
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
                        <td class="border px-3 py-2 text-gray-900 dark:text-gray-200 text-sm">{{ $file->page_capacity }}</td>
                        <td class="border px-3 py-2 text-gray-900 dark:text-gray-200 text-sm text-wrap">{{ $file->note }}</td>
                        <td class="border px-3 py-2 text-gray-900 dark:text-gray-200 text-sm" id="status-cell-{{ $file->id }}">{{ $file->status }}</td>
                        <td class="border px-3 py-2 text-gray-900 dark:text-gray-200 text-sm">{{ $file->expire_date }}</td>
                        <td class="border px-3 py-2">
                            <!-- Wrapper for buttons -->
                            <div class="flex flex-col space-y-2"> <!-- Using vertical spacing for stacked buttons -->

                                <!-- Show Button -->
                                <a href="{{ route('files.show', $file->id) }}" 
                                class="bg-gradient-to-r from-green-400 to-green-600 hover:from-green-500 hover:to-green-700 text-white font-semibold py-1 px-2 rounded text-sm inline-flex items-center transition duration-300 ease-in-out transform hover:scale-105 mb-2">
                                <i class="fa-solid fa-face-grin-hearts mr-1"></i>
                                Show
                                </a>

                                <!-- Edit Button -->
                                <button id="edit-button-{{ $file->id }}"
                                        onclick="openModal({{ $file->id }}, '{{ addslashes($file->file_no) }}', '{{ addslashes($file->responsible_officer) }}', '{{ $file->given_date }}', '{{ $file->page_capacity }}', '{{ addslashes($file->note) }}', '{{ $file->expire_date }}')"
                                        class="bg-gradient-to-r from-blue-400 to-blue-600 hover:from-blue-500 hover:to-blue-700 text-white font-semibold py-1 px-2 rounded text-sm inline-flex items-center transition duration-300 ease-in-out transform hover:scale-105 mb-2 {{ $file->status === 'Pending' || $file->status === 'Stored' ? 'opacity-50 cursor-not-allowed' : '' }}"
                                        {{ $file->status === 'Pending' || $file->status === 'Stored' ? 'disabled' : '' }}>
                                    <i class="fas fa-edit mr-1"></i>
                                    {{ $file->status === 'Pending' || $file->status === 'Stored' ? 'Locked Edit' : 'Edit' }}
                                </button>

                                <!-- Delete Button -->
                                <form action="{{ route('files.destroy', $file->id) }}" method="POST" class="inline-block mb-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" 
                                            id="delete-button-{{ $file->id }}" 
                                            class="bg-gradient-to-r from-red-400 to-red-600 hover:from-red-500 hover:to-red-700 text-white font-semibold py-1 px-2 rounded text-sm inline-flex items-center transition duration-300 ease-in-out transform hover:scale-105 {{ $file->status === 'Pending' || $file->status === 'Stored' ? 'opacity-50 cursor-not-allowed' : '' }}"
                                            {{ $file->status === 'Pending' || $file->status === 'Stored' ? 'disabled' : '' }}>
                                        <i class="fas fa-trash-alt mr-1"></i>
                                        Delete
                                    </button>
                                </form>
                            </div>

                            <!-- Separate div for the conditional 'Send to Record Room' button or messages -->
                            <div class="mt-2">
                                @if ($file->status !== 'Stored' && $file->status !== 'Pending')
                                    <button id="send-button-{{ $file->id }}"
                                            onclick="sendToRecordRoom({{ $file->id }})"
                                            class="bg-gradient-to-r from-gray-400 to-gray-600 hover:from-gray-500 hover:to-gray-700 text-white font-semibold py-1 px-2 rounded text-sm transition duration-300 ease-in-out">
                                        Send to Record Room
                                    </button>
                                    
                                @elseif ($file->status === 'Pending')
                                <!-- Display icon and outline for 'Pending' status -->
                                <span class="flex items-center space-x-1 text-yellow-600 border border-yellow-500 rounded-lg px-2 py-1 bg-yellow-100">
                                            <i class="fas fa-hourglass-half text-yellow-600"></i> <!-- Font Awesome icon for pending -->
                                            <span>File is pending rack assignment.</span>
                                        </span>
                                    @else
                                    <!-- Display icon and outline for 'File Stored' -->
                                    <span class="flex items-center space-x-1 text-gray-500 border border-gray-400 rounded-lg px-2 py-1 bg-gray-100">
                                        <i class="fas fa-check-circle text-green-500"></i> <!-- Font Awesome icon -->
                                        <span>File Stored</span>
                                    </span>
                                @endif
                            </div>
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </table>
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
            alert(data.message);
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

</script>

</x-app-layout>
