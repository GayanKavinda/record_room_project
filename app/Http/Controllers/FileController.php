<?php

namespace App\Http\Controllers;
use App\Models\File;
use Illuminate\Http\Request;
use App\Rules\FileNoFormat;
use Illuminate\Support\Facades\Auth;
use App\Models\Department; // Import your Department model
use Illuminate\Validation\ValidationException;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\RecordRoom;


class FileController extends Controller
{
    use AuthorizesRequests; // Add this line

    public function index(Request $request)
{
    $user = Auth::user();
    $query = File::query();

    // Fetch all departments for the filter dropdown
    $departments = Department::all();

    // Apply filters based on request parameters
    if ($request->filled('status')) {
        $query->where('status', $request->input('status'));
    }

    if ($request->filled('department')) {
        $query->whereHas('department', function ($q) use ($request) {
            $q->where('department_name', $request->input('department'));
        });
    }

    if ($request->filled('file_no')) {
        $query->where('file_no', 'like', '%' . $request->input('file_no') . '%');
    }

    if ($request->filled('responsible_officer')) {
        $query->where('responsible_officer', 'like', '%' . $request->input('responsible_officer') . '%');
    }

    // Apply the unified date filter to Open Date, Close Date, and Given Date
    if ($request->filled('date_filter')) {
        $date = $request->input('date_filter');
        $query->where(function ($q) use ($date) {
            // Use whereDate to filter based on the date part only
            $q->whereDate('open_date', $date)
              ->orWhereDate('close_date', $date)
              ->orWhereDate('given_date', $date);
        });
    }

    // Apply role-based logic and paginate results
    if ($user->hasRole('super-admin')) {
        $files = $query->paginate(10); // Paginate for super-admins
    } elseif ($user->hasRole('admin')) {
        $department = Department::where('department_name', $user->department_name)->first();
        if ($department) {
            $files = $query->where('department_no', $department->department_no)->paginate(10); // Paginate for admins
        } else {
            $files = collect(); // No files for users without a department
        }
    } else {
        $files = $query->paginate(10); // Paginate for other users
    }

    // Return JSON response for AJAX requests, or a view with the paginated data
    return request()->ajax() ? response()->json($files) : view('files.index', compact('files', 'departments'));
}



    // Show the form for creating a new file
    public function create()
{
    $user = Auth::user();

    if ($user->hasRole('super-admin')) {
        // Super admins can see all departments
        $departments = Department::all();
    } else {
        // Admins can only see their own department
        $departments = Department::where('department_name', $user->department_name)->get();
    }

    // Pass the departments to the view
    return view('files.create', compact('departments'));
}


    // Store a newly created file in storage
    public function store(Request $request)
{
    // Validate input fields
    $request->validate([
        'file_no' => ['required', 'string', new FileNoFormat(), 'unique:files,file_no'],
        'responsible_officer' => 'required|string|max:255',
        'open_date' => 'required|date',
        'close_date' => 'nullable|date|after_or_equal:open_date',
        'department_name' => 'required|string|max:255', // Ensure department_name is required
    ]);

    // Fetch the department using department_name
    $department = Department::where('department_name', $request->department_name)->first();
    if (!$department) {
        return back()->withErrors(['department_name' => 'Department not found.']);
    }

    // Log the department data to verify correct fetching
    \Log::info('Fetched Department: ', $department->toArray());

    File::create([
        'file_no' => $request->file_no,
        'responsible_officer' => $request->responsible_officer,
        'open_date' => $request->open_date,
        'close_date' => $request->close_date,
        'department_no' => $department->department_no ?? 0,  // This should not be NULL
    ]);
    return redirect()->route('files.index')->with('success', 'File created successfully.');
}

    // Show the specified file
    public function show(File $file)
    {
        return view('files.show', compact('file'));
    }

    // Show the form for editing the specified file
    public function edit(File $file)
    {
        // Super admins can see all departments, admins can only see their own department
        $user = Auth::user();
        if ($user->hasRole('super-admin')) {
            $departments = Department::all();
        } else {
            $departments = Department::where('department_name', $user->department_name)->get();
        }
        return view('files.edit', compact('file', 'departments'));
    }

    // Update the specified file in storage
    public function update(Request $request, $id)
    {
        \Log::info('Update Request Data: ', $request->all());

        try {
            $request->validate([
                'responsible_officer' => 'required|string|max:255',
                'given_date' => 'required|date',
                'page_capacity' => 'required|integer',
                'note' => 'nullable|string',
                'expire_date' => 'nullable|date',
            ]);

            $file = File::findOrFail($id);
            $file->responsible_officer = $request->responsible_officer;
            $file->given_date = $request->given_date;
            $file->page_capacity = $request->page_capacity;
            $file->note = $request->note;
            $file->expire_date = $request->expire_date;
            $file->save();

            return response()->json(['success' => true]);
        } catch (\Illuminate\Validation\ValidationException $e) {
            return response()->json(['success' => false, 'message' => $e->validator->errors()->first()], 422);
        } catch (\Exception $e) {
            \Log::error('Update Failed: ' . $e->getMessage());
            return response()->json(['success' => false, 'message' => 'An error occurred while updating the file.'], 500);
        }
    }

    // Remove the specified file from storage
    public function destroy(File $file)
    {
        $file->delete();
        return redirect()->route('files.index')->with('success', 'File deleted successfully.');
    }

    /**
     * Send the file to the record room by updating its status.
     */
    public function sendToRecordRoom(Request $request)
{
    $fileId = $request->file_id;

    // Update the file status to 'Pending'
    $file = File::find($fileId);
    $file->status = 'Pending';
    $file->save();

    return response()->json(['success' => true, 'status' => 'Pending']);
}



    public function recordRoomIndex()
    {
        $this->authorize('accessRecordRoom');

        $files = File::where('status', 'Pending')->get();
        return view('record_room.index', compact('files'));
    }

    // Assign Rack Location and Update File Status
    public function assignRackLocation(Request $request, $id)
    {
        $file = File::findOrFail($id);

        // Validate the rack assignment input
        $request->validate([
            'rack_letter' => 'required|string|max:1',
            'sub_rack' => 'required|integer',
            'cell_number' => 'required|integer',
        ]);

        // Assign the rack location to the file
        $file->rack_letter = $request->rack_letter;
        $file->sub_rack = $request->sub_rack;
        $file->cell_number = $request->cell_number;

        // Update the status to 'Stored' after assigning the rack
        $file->status = 'Stored';
        $file->save();

        // Return a success response and update the front end
        if ($request->ajax()) {
            return response()->json(['success' => true, 'status' => 'Stored']);
        }

        return redirect()->route('record-room.storedFiles')->with('success', 'File successfully stored in the record room.');
    }

    // Store the file after the rack has been assigned
    public function storeRecordRoom($id)
    {
        $file = File::findOrFail($id);

        // Check if the file status is "Pending" before storing it
        if ($file->status === 'Pending') {
            $file->status = 'Stored'; // Change status to 'Stored'
            $file->save();

            return redirect()->route('record-room.index')->with('success', 'File stored in the record room.');
        }

        return redirect()->route('record-room.index')->with('error', 'Cannot store file. It needs to be rack assigned first.');
    }

    public function storedFiles(Request $request)
    {
        // Fetch all departments for the filter dropdown
        $departments = Department::all();

        $query = File::where('status', 'Stored')->with('department');

        // Apply status filter if provided
        if ($request->filled('status')) {
            $query->where('status', $request->input('status'));
        }

        // Apply department filter if provided
        if ($request->filled('department')) {
            $query->whereHas('department', function ($q) use ($request) {
                $q->where('department_name', $request->input('department'));
            });
        }

        // Apply file number filter if provided
        if ($request->filled('file_no')) {
            $query->where('file_no', 'like', '%' . $request->input('file_no') . '%');
        }

        // Apply responsible officer filter if provided
        if ($request->filled('responsible_officer')) {
            $query->where('responsible_officer', 'like', '%' . $request->input('responsible_officer') . '%');
        }

        $storedFiles = $query->get();
        return view('record_room.stored_files', compact('storedFiles', 'departments'));
    }
}