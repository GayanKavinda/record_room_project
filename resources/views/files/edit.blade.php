<x-app-layout>
    <div class="container py-6">
        <div class="bg-white shadow-md rounded-lg p-6">
            <h1 class="text-2xl font-semibold mb-4">Edit File</h1>

            <form action="{{ route('files.update', $file->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="file_no" class="form-label">File No</label>
                    <input type="text" id="file_no" name="file_no" value="{{ old('file_no', $file->file_no) }}" required
                           class="form-control">
                </div>
                <div class="mb-4">
                    <label for="responsible_officer" class="form-label">File Responsible Officer</label>
                    <input type="text" id="responsible_officer" name="responsible_officer" value="{{ old('responsible_officer', $file->responsible_officer) }}" required
                           class="form-control">
                </div>
                <div class="mb-4">
                    <label for="open_date" class="form-label">Open Date</label>
                    <input type="date" id="open_date" name="open_date" value="{{ old('open_date', $file->open_date) }}" required
                           class="form-control">
                </div>
                <div class="mb-4">
                    <label for="close_date" class="form-label">Close Date</label>
                    <input type="date" id="close_date" name="close_date" value="{{ old('close_date', $file->close_date) }}"
                           class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">
                    Update File
                </button>
            </form>
        </div>
    </div>
</x-app-layout>
