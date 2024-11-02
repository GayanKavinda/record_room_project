<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use App\Rules\FileNoFormat;
use Illuminate\Support\Facades\Auth;
use App\Models\Department; // Import your Department model
use Illuminate\Validation\ValidationException;



class FileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        
        if ($user->hasRole('super-admin')) {
            // Super admins see all files
            $files = File::all();
        } elseif ($user->hasRole('admin')) {
            // Admins only see files for their department
            $department = Department::where('department_name', $user->department_name)->first();
            
            if ($department) {
                $files = File::where('department_no', $department->department_no)->get();
            } else {
                $files = collect(); // Empty collection if department not found
            }
        } else {
            // Primary users see all files
            $files = File::all();
        }

        return view('files.index', compact('files'));
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
    public function update(Request $request, File $file)
{
    $request->validate([
        'file_no' => [
            'required',
            'string',
            'regex:/^HA\/\d{2}\/\d{2}\/\d{2}\/\d{2}$|^[0-9]+$/', // Ensure the regex pattern is correct
            'unique:files,file_no,' . $file->id,
        ],
        'responsible_officer' => 'required|string|max:255',
        'open_date' => 'required|date',
        'close_date' => 'nullable|date|after_or_equal:open_date',
    ]);

    // Update the file data
    $file->update($request->all());

    return redirect()->route('files.index')->with('success', 'File updated successfully.');
}


    // Remove the specified file from storage
    public function destroy(File $file)
    {
        $file->delete();
        return redirect()->route('files.index')->with('success', 'File deleted successfully.');
    }
}