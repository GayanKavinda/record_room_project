<x-app-layout>
    <div class="max-w-7xl mx-auto py-6 px-4">
        <!-- Main Card for All Files -->
        <div class="bg-white dark:bg-gray-800 shadow-md rounded-lg p-6">
            <h1 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Files</h1>

            <!-- Create New File Button -->
            @if(Auth::user()->hasRole('super-admin') || Auth::user()->hasRole('admin'))
            <a href="{{ route('files.create') }}" 
               class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded mb-4 inline-block">
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
                <table class="min-w-full border-collapse border border-gray-300">
                    <thead class="bg-gray-200 dark:bg-gray-700">
                        <tr>
                            <th class="border px-3 py-2 text-left text-gray-900 dark:text-gray-100 text-sm">File No</th>
                            <th class="border px-3 py-2 text-left text-gray-900 dark:text-gray-100 text-sm">Responsible Officer</th>
                            <th class="border px-3 py-2 text-left text-gray-900 dark:text-gray-100 text-sm">Open Date</th>
                            <th class="border px-3 py-2 text-left text-gray-900 dark:text-gray-100 text-sm">Close Date</th>
                            <th class="border px-3 py-2 text-left text-gray-900 dark:text-gray-100 text-sm">Given Date</th>
                            <th class="border px-3 py-2 text-left text-gray-900 dark:text-gray-100 text-sm">Page Capacity</th>
                            <th class="border px-3 py-2 text-left text-gray-900 dark:text-gray-100 text-sm">Note</th>
                            <th class="border px-3 py-2 text-left text-gray-900 dark:text-gray-100 text-sm">Expire Date</th>
                            <th class="border px-3 py-2 text-left text-gray-900 dark:text-gray-100 text-sm">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="bg-white dark:bg-gray-800">
                        @foreach ($files as $file)
                            <tr data-file-id="{{ $file->id }}" class="bg-white dark:bg-gray-800">
                                <td class="border px-3 py-2 text-gray-900 dark:text-gray-200 text-sm">{{ $file->file_no }}</td>
                                <td class="border px-3 py-2 text-gray-900 dark:text-gray-200 text-sm">{{ $file->responsible_officer }}</td>
                                <td class="border px-3 py-2 text-gray-900 dark:text-gray-200 text-sm">{{ $file->open_date }}</td>
                                <td class="border px-3 py-2 text-gray-900 dark:text-gray-200 text-sm">{{ $file->close_date ?? 'N/A' }}</td>
                                <td class="border px-3 py-2 text-gray-900 dark:text-gray-200 text-sm">{{ $file->given_date }}</td>
                                <td class="border px-3 py-2 text-gray-900 dark:text-gray-200 text-sm">{{ $file->page_capacity }}</td>
                                <td class="border px-3 py-2 text-gray-900 dark:text-gray-200 text-sm text-wrap">{{ $file->note }}</td>
                                <td class="border px-3 py-2 text-gray-900 dark:text-gray-200 text-sm">{{ $file->expire_date }}</td>
                                <td class="border px-3 py-2">
                                    <!-- Show Button -->
                                    <a href="{{ route('files.show', $file->id) }}" 
                                       class="bg-green-500 hover:bg-green-600 text-white font-semibold py-1 px-2 rounded mr-2 text-sm">
                                        Show
                                    </a>

                                    <!-- Edit Button -->
                                    <button onclick="openModal({{ $file->id }}, '{{ addslashes($file->file_no) }}', '{{ addslashes($file->responsible_officer) }}', '{{ $file->given_date }}', '{{ $file->page_capacity }}', '{{ addslashes($file->note) }}', '{{ $file->expire_date }}')"
                                            class="bg-blue-500 hover:bg-blue-600 text-white font-semibold py-1 px-2 rounded mr-2 text-sm">
                                        Edit
                                    </button>

                                    <!-- Delete Button -->
                                    <form action="{{ route('files.destroy', $file->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-2 rounded text-sm">
                                            Delete
                                        </button>
                                    </form>

                                    <!-- Send to Record Room Button -->
                                    <button onclick="sendToRecordRoom({{ $file->id }})"
                                            class="bg-gray-500 hover:bg-gray-700 text-white font-semibold py-1 px-2 rounded text-sm">
                                        Send to Record Room
                                    </button>
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

    <!-- Send to Record Room Modal -->
    <div id="recordRoomModal" class="fixed inset-0 z-50 flex items-center justify-center hidden bg-gray-900 bg-opacity-50" role="dialog" aria-modal="true">
        <div class="bg-white dark:bg-gray-800 p-6 rounded-lg shadow-lg w-full max-w-md">
            <h2 class="text-xl font-semibold mb-4 text-gray-900 dark:text-white">Send to Record Room</h2>
            
            <form id="recordRoomForm" class="space-y-4">
                <!-- Rack Letter -->
                <div>
                    <label for="rack_letter" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Rack Letter</label>
                    <select id="rack_letter" name="rack_letter" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600">
                        <option value="">Select Rack Letter</option>
                    </select>
                </div>

                <!-- Sub Rack -->
                <div>
                    <label for="sub_rack" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Sub Rack</label>
                    <select id="sub_rack" name="sub_rack" required
                            class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600">
                        <option value="1">1</option>
                        <option value="2">2</option>
                    </select>
                </div>

                <!-- Cell Number -->
                <div>
                    <label for="cell_number" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Cell Number</label>
                    <input type="number" id="cell_number" name="cell_number" required min="1"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600">
                </div>

                <!-- Buttons -->
                <div class="flex justify-end space-x-2">
                    <button type="button" onclick="closeRecordRoomModal()" 
                            class="bg-gray-400 hover:bg-gray-600 text-white font-semibold py-2 px-4 rounded">
                        Cancel
                    </button>
                    <button type="submit" 
                            class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded">
                        Submit
                    </button>
                </div>
            </form>
        </div>
    </div>

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
            // Store fileId in a data attribute of the modal
            const modal = document.getElementById('recordRoomModal');
            modal.setAttribute('data-file-id', fileId);

            // Populate rack letters dropdown
            const rackLetterSelect = document.getElementById('rack_letter');
            rackLetterSelect.innerHTML = '<option value="">Select Rack Letter</option>';
            for (let i = 65; i <= 90; i++) {
                const letter = String.fromCharCode(i);
                rackLetterSelect.innerHTML += `<option value="${letter}">${letter}</option>`;
            }

            // Show the modal
            modal.classList.remove('hidden');
            
            // Remove any existing event listeners
            const form = document.getElementById('recordRoomForm');
            const newForm = form.cloneNode(true);
            form.parentNode.replaceChild(newForm, form);
            
            // Handle rack letter change
            document.getElementById('rack_letter').addEventListener('change', function() {
                const subRackSelect = document.getElementById('sub_rack');
                const selectedLetter = this.value;
                
                if (selectedLetter === 'A' || selectedLetter === 'Z') {
                    subRackSelect.value = '1';
                    subRackSelect.disabled = true;
                } else {
                    subRackSelect.disabled = false;
                }
            });

            // Handle form submission
            document.getElementById('recordRoomForm').addEventListener('submit', function(e) {
                e.preventDefault();
                
                const formData = {
                    fileId: fileId,
                    rackLetter: document.getElementById('rack_letter').value,
                    subRack: document.getElementById('sub_rack').value,
                    cellNumber: document.getElementById('cell_number').value
                };

                fetch('/files/send-to-record-room', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content')
                    },
                    body: JSON.stringify(formData)
                })
                .then(response => {
                    if (!response.ok) {
                        return response.json().then(err => Promise.reject(err));
                    }
                    return response.json();
                })
                .then(data => {
                    if (data.success) {
                        // Find the current row using the stored fileId
                        const currentRow = document.querySelector(`tr[data-file-id="${fileId}"]`);
                        if (currentRow) {
                            // Update buttons
                            const buttons = currentRow.querySelectorAll('button, a');
                            buttons.forEach(button => {
                                button.classList.add('opacity-50', 'cursor-not-allowed');
                                if (button.tagName === 'BUTTON') {
                                    button.disabled = true;
                                }
                            });

                            // Remove the send to record room button
                            const sendButton = currentRow.querySelector('button[onclick*="sendToRecordRoom"]');
                            if (sendButton) {
                                sendButton.remove();
                            }
                        }

                        // Show success message
                        alert('File successfully sent to record room');
                        closeRecordRoomModal();
                    }
                })
                .catch(error => {
                    console.error('Error:', error);
                    alert('An error occurred while sending the file to record room: ' + (error.message || 'Unknown error'));
                });
            });
        }

        function closeRecordRoomModal() {
            const modal = document.getElementById('recordRoomModal');
            modal.classList.add('hidden');
            document.getElementById('recordRoomForm').reset();
            const subRackSelect = document.getElementById('sub_rack');
            subRackSelect.disabled = false;
            modal.removeAttribute('data-file-id');
        }
    </script>
</x-app-layout>
