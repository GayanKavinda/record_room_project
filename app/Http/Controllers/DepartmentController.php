<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\DepartmentActivityLog;

class DepartmentController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $departments = Department::all();
        return view('departments.index', compact('departments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('departments.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
{
    // Log the input data for debugging
    \Log::info('Department creation attempt:', $request->all());

    $request->validate([
        'department_name' => 'required|string|max:255',
        'department_no' => 'required|integer|unique:departments,department_no',
    ]);

    // Create the department and store it in the $department variable
    $department = Department::create([
        'department_name' => $request->department_name,
        'department_no' => $request->department_no,
    ]);

    // Log the activity for department creation
    DepartmentActivityLog::create([
        'user_id' => auth()->id(),
        'action' => 'Created Department',
        'details' => 'Department ' . $department->department_name . ' (ID: ' . $department->id . ') was created.',
    ]);

    return redirect()->route('departments.index')->with('success', 'Department created successfully!');
}



    /**
     * Display the specified resource.
     */
    public function show(Department $department)
    {
        return view('departments.show', compact('department'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Department $department)
    {
        return view('departments.edit', compact('department'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Department $department)
    {
        $request->validate([
            'department_name' => 'required|string|max:255',
            'department_no' => 'required|integer|unique:departments,department_no,' . $department->id,
        ]);

        // Capture the original values before updating
        $original = $department->getOriginal();

        $department->update([
            'department_name' => $request->department_name,
            'department_no' => $request->department_no,
        ]);

        // Capture the updated values after the update
        $updated = Department::find($department->id);  // This fetches the updated record from the database

        // Determine what has changed
        $changes = [];
        if ($original['department_name'] !== $updated->department_name) {
            $changes[] = "Department Name: '{$original['department_name']}' → '{$updated->department_name}'";
        }
        if ($original['department_no'] !== $updated->department_no) {
            $changes[] = "Department Number: '{$original['department_no']}' → '{$updated->department_no}'";
        }

        // Log the activity for department update with detailed changes
        DepartmentActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'Updated Department',
            'details' => 'Department ' . $updated->department_name . ' (ID: ' . $updated->id . ') was updated. Changes: ' . implode(', ', $changes),
        ]); 
        
        return redirect()->route('departments.index')->with('success', 'Department updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $department->delete();
        
        // Log the activity for department deletion
        DepartmentActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'Deleted Department',
            'details' => 'Department ' . $department->department_name . ' (ID: ' . $department->id . ') was deleted.',
        ]);
        return redirect()->route('departments.index')->with('success', 'Department deleted successfully.');
    }
}
