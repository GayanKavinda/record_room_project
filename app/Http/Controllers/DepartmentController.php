<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;

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

    Department::create([
        'department_name' => $request->department_name,
        'department_no' => $request->department_no,
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

        $department->update([
            'department_name' => $request->department_name,
            'department_no' => $request->department_no,
        ]);

        return redirect()->route('departments.index')->with('success', 'Department updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Department $department)
    {
        $department->delete();
        return redirect()->route('departments.index')->with('success', 'Department deleted successfully.');
    }
}
