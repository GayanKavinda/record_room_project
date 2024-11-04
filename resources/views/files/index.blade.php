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

            <!-- Error Message (Optional) -->
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
                            <tr class="bg-gray-100 dark:bg-gray-700">
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

                                    <!-- Edit Button (conditionally disabled) -->
                                    <button onclick="openModal({{ $file->id }}, '{{ addslashes($file->file_no) }}', '{{ addslashes($file->responsible_officer) }}', '{{ $file->given_date }}', '{{ $file->page_capacity }}', '{{ addslashes($file->note) }}')"
        class="{{ $file->is_editable ? 'bg-blue-500 hover:bg-blue-600' : 'bg-gray-400 cursor-not-allowed' }} text-white font-semibold py-1 px-2 rounded mr-2 text-sm"
        {{ !$file->is_editable ? 'disabled' : '' }}
        data-tooltip="{{ !$file->is_editable ? 'Locked' : '' }}">
    Edit
</button>

                                    <!-- Delete Button -->
                                    <form action="{{ route('files.destroy', $file->id) }}" method="POST" class="inline-block">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" 
                                                class="bg-red-500 hover:bg-red-600 text-white font-semibold py-1 px-2 rounded text-sm">
                                            Delete
                                        </button>
                                    </form>

                                    <!-- Expire Date Button (conditionally enabled) -->
                                    <button id="expireBtn{{ $file->id }}" onclick="expireFile({{ $file->id }})"
        class="{{ $file->is_expirable ? 'bg-yellow-500 hover:bg-yellow-600' : 'bg-gray-400 cursor-not-allowed' }} text-white font-semibold py-1 px-2 rounded text-sm"
        {{ !$file->is_expirable ? 'disabled' : '' }}
        data-tooltip="{{ !$file->is_expirable ? 'Locked' : '' }}">
    Expire Date
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
                    <input type="text" id="modal_file_no" name="file_no" required
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600" disabled>
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
                    <p id="givenDateError" class="text-red-500 text-xs hidden">Please select a given date.</p>
                </div>

                <!-- Page Capacity -->
                <div class="mb-4">
                    <label for="modal_page_capacity" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Page Capacity</label>
                    <input type="number" id="modal_page_capacity" name="page_capacity"
                           class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600">
                    <p id="pageCapacityError" class="text-red-500 text-xs hidden">Page capacity must be a positive number.</p>
                </div>

                <!-- Note -->
                <div class="mb-4">
                    <label for="modal_note" class="block text-sm font-medium text-gray-700 dark:text-gray-300">Note</label>
                    <textarea id="modal_note" name="note" rows="4"
                              class="mt-1 block w-full border-gray-300 rounded-md shadow-sm focus:border-blue-500 focus:ring-blue-500 dark:bg-gray-700 dark:text-white dark:border-gray-600"></textarea>
                    <p id="noteError" class="text-red-500 text-xs hidden">Note cannot be empty.</p>
                </div>

                <!-- Modal Buttons -->
                <div class="flex justify-end">
                    <button type="button" onclick="closeModal()" class="bg-gray-400 hover:bg-gray-500 text-white font-semibold py-2 px-4 rounded mr-2">
                        Cancel
                    </button>
                    <button type="submit" id="submitEditBtn" class="bg-blue-600 hover:bg-blue-700 text-white font-semibold py-2 px-4 rounded" disabled>
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</x-app-layout>

<script>
    let currentFileId;

    function openModal(fileId, fileNo, responsibleOfficer, givenDate, pageCapacity, note) {
        currentFileId = fileId;
        document.getElementById('modal_file_no').value = fileNo;
        document.getElementById('modal_responsible_officer').value = responsibleOfficer;
        document.getElementById('modal_given_date').value = givenDate;
        document.getElementById('modal_page_capacity').value = pageCapacity;
        document.getElementById('modal_note').value = note;

        // Set the action URL for the form
        document.getElementById('editForm').action = `/files/${fileId}`;
        
        // Show modal
        document.getElementById('editModal').classList.remove('hidden');
        
        // Enable validation checks
        checkModalCompletion();
    }

    function closeModal() {
        document.getElementById('editModal').classList.add('hidden');
        resetErrorMessages();
        // Clear form fields
        document.getElementById('editForm').reset();
        document.getElementById('submitEditBtn').disabled = true; // Reset the button state
    }

    function expireFile(fileId) {
        // Your expire file logic here
        alert(`Expiring file ${fileId}`);
    }

    function checkModalCompletion() {
        const givenDate = document.getElementById('modal_given_date').value.trim();
        const pageCapacity = document.getElementById('modal_page_capacity').value.trim();
        const note = document.getElementById('modal_note').value.trim();
        const expireBtn = document.getElementById(`expireBtn${currentFileId}`);
        const submitEditBtn = document.getElementById('submitEditBtn');

        // Reset error messages
        resetErrorMessages();

        let isValid = true;

        // Validate Given Date
        if (!givenDate) {
            document.getElementById('givenDateError').classList.remove('hidden');
            isValid = false;
        }

        // Validate Page Capacity
        if (!pageCapacity || pageCapacity <= 0) {
            document.getElementById('pageCapacityError').classList.remove('hidden');
            isValid = false;
        }

        // Validate Note
        if (!note) {
            document.getElementById('noteError').classList.remove('hidden');
            isValid = false;
        }

        expireBtn.disabled = !isValid; // Enable/disable button based on validity
        submitEditBtn.disabled = !isValid; // Enable/disable Save Changes button based on validity
    }

    function resetErrorMessages() {
        document.getElementById('givenDateError').classList.add('hidden');
        document.getElementById('pageCapacityError').classList.add('hidden');
        document.getElementById('noteError').classList.add('hidden');
    }

    // Attach event listeners to each modal input field for validation
    document.getElementById('modal_given_date').addEventListener('input', checkModalCompletion);
    document.getElementById('modal_page_capacity').addEventListener('input', checkModalCompletion);
    document.getElementById('modal_note').addEventListener('input', checkModalCompletion);

    // Form submission with validation
    document.getElementById('editForm').addEventListener('submit', function(event) {
    event.preventDefault(); // Prevent default form submission
    
    resetErrorMessages(); // Reset error messages on submission

    // Check if form is valid
    const givenDate = document.getElementById('modal_given_date').value.trim();
    const pageCapacity = document.getElementById('modal_page_capacity').value.trim();
    const note = document.getElementById('modal_note').value.trim();

    let isValid = true;

    if (!givenDate) {
        document.getElementById('givenDateError').classList.remove('hidden');
        isValid = false;
    }
    if (!pageCapacity || pageCapacity <= 0) {
        document.getElementById('pageCapacityError').classList.remove('hidden');
        isValid = false;
    }
    if (!note) {
        document.getElementById('noteError').classList.remove('hidden');
        isValid = false;
    }

    if (!isValid) return; // Stop submission if not valid

    // Prepare data for submission
    const formData = new FormData(this);

    // Submit the form using Fetch API
    fetch(this.action, {
        method: 'POST',
        body: formData,
    })
    .then(response => response.json())
    .then(data => {
        if (data.success) {
            displaySuccessMessage(data.message); // Display success message
            closeModal(); // Close the modal
            fetchFiles(); // Fetch updated list of files
        } else {
            alert("Error: " + data.message); // Display error message
        }
    })
    .catch(error => console.error('Error:', error));
});

// Function to display a success message after submission
function displaySuccessMessage(message) {
    const successMessage = document.createElement('div');
    successMessage.className = 'bg-green-100 border-l-4 border-green-500 text-green-700 p-2 mb-4 max-w-md mx-auto rounded';
    successMessage.role = 'alert';
    successMessage.innerHTML = `<p class="font-bold">Success</p><p>${message}</p>`;
    
    document.body.appendChild(successMessage); // Append the message to the body or a specific container
    
    // Automatically remove the success message after 3 seconds
    setTimeout(() => {
        successMessage.remove(); // Remove the message after 3 seconds
    }, 3000);
}

// Function to fetch the updated file list without page refresh
function fetchFiles() {
    fetch('/files', {
        headers: {
            'X-Requested-With': 'XMLHttpRequest' // Indicates it's an AJAX request
        }
    })
    .then(response => {
        if (!response.ok) throw new Error('Network response was not ok');
        return response.json();
    })
    .then(files => {
        const tbody = document.querySelector('table tbody');
        tbody.innerHTML = ''; // Clear current content

        files.forEach(file => {
            tbody.innerHTML += `
                <tr class="bg-gray-100 dark:bg-gray-700">
                    <td class="border px-3 py-2 text-gray-900 dark:text-gray-200 text-sm">${file.file_no}</td>
                    <td class="border px-3 py-2 text-gray-900 dark:text-gray-200 text-sm">${file.responsible_officer}</td>
                    <td class="border px-3 py-2 text-gray-900 dark:text-gray-200 text-sm">${file.open_date}</td>
                    <td class="border px-3 py-2 text-gray-900 dark:text-gray-200 text-sm">${file.close_date || 'N/A'}</td>
                    <td class="border px-3 py-2 text-gray-900 dark:text-gray-200 text-sm">${file.given_date}</td>
                    <td class="border px-3 py-2 text-gray-900 dark:text-gray-200 text-sm">${file.page_capacity}</td>
                    <td class="border px-3 py-2 text-gray-900 dark:text-gray-200 text-sm text-wrap">${file.note}</td>
                    <td class="border px-3 py-2 text-gray-900 dark:text-gray-200 text-sm">${file.expire_date || 'N/A'}</td>
                    <td class="border px-3 py-2 text-center">
                        <button onclick="editFile(${file.id})" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-1 px-2 rounded">Edit</button>
                        <button onclick="deleteFile(${file.id})" class="bg-red-500 hover:bg-red-700 text-white font-bold py-1 px-2 rounded">Delete</button>
                        <button onclick="showExpireDate('${file.expire_date || 'N/A'}')" class="bg-gray-500 hover:bg-gray-700 text-white font-bold py-1 px-2 rounded">Show Expire Date</button>
                    </td>
                </tr>
            `;
        });
    })
    .catch(error => console.error('Fetch error:', error));
}
</script>

<style>
    button[data-tooltip]:hover::after {
    content: attr(data-tooltip);
    position: absolute;
    top: -1.5rem;
    left: 50%;
    transform: translateX(-50%);
    background-color: rgba(55, 65, 81, 1); /* Tailwind Gray-800 */
    color: white;
    padding: 0.25rem 0.5rem;
    border-radius: 0.25rem;
    font-size: 0.75rem;
    white-space: nowrap;
    opacity: 1;
    transition: opacity 0.2s ease-in-out;
    z-index: 10;
}

button[data-tooltip]::after {
    opacity: 0;
    pointer-events: none;
}

</style>

