<?php

namespace App\Http\Controllers;

use App\Models\File;
use Illuminate\Http\Request;
use App\Rules\FileNoFormat;


class FileController extends Controller
{
    public function index()
    {
        $files = File::all();
        return view('files.index', compact('files'));
    }

    // Show the form for creating a new file
    public function create()
    {
        return view('files.create');
    }

    // Store a newly created file in storage
    public function store(Request $request)
    {
        // Validate using the custom rule
        $request->validate([
            'file_no' => ['required', 'string', new FileNoFormat(), 'unique:files,file_no'],
            'responsible_officer' => 'required|string|max:255',
            'open_date' => 'required|date',
            'close_date' => 'nullable|date',
        ]);

        // Create the file record in the database
        File::create($request->only('file_no', 'responsible_officer', 'open_date', 'close_date'));

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
        return view('files.edit', compact('file'));
    }

    // Update the specified file in storage
    public function update(Request $request, File $file)
    {
        $request->validate([
            'file_no' => 'required|string|regex:/^(HA\/\d{2}\/\d{2}\/\d{2}\/\d{2}|[0-9]+)$/|unique:files,file_no,' . $file->id,
            'responsible_officer' => 'required|string|max:255',
            'open_date' => 'required|date',
            'close_date' => 'nullable|date|after_or_equal:open_date',
        ]);

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
