<?php

namespace App\Http\Controllers;

use Spatie\Permission\Models\Permission; // Import the Permission model
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\PermissionActivityLogController; // Import the new controller
use App\Models\PermissionActivityLog; // Import the PermissionActivityLog model



class PermissionController extends Controller
{
    public function index()
    {
        // Fetch all permissions from the database
        $permissions = Permission::get();

        // Pass the permissions to the view
        return view('role-permission.permission.index', ['permissions' => $permissions]);
    }

    public function create()
    {
        return view('role-permission.permission.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name'
            ]
        ]);

        // Create the permission and store it in a variable
        $permission = Permission::create([
            'name' => $request->name
        ]);

        // Log activity
        PermissionActivityLog::create([
            'user_id' => Auth::id(),
            'activity' => 'Permission created',
            'permission_name' => $permission->name, // Use the created permission object
        ]);

        return redirect()->route('permissions.index')->with('success', 'Permission created successfully');
    }


    public function edit(Permission $permission)
    {
        return view('role-permission.permission.edit',
        ['permission' => $permission]);
    }

    public function update(Request $request, Permission $permission)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:permissions,name,'.$permission->id
            ]
        ]);

        // Capture the old value of the permission
        $oldPermissionName = $permission->name;

        $permission->update([
            'name' => $request->name
        ]);

        // Log activity with old and new permission names in the same field
        PermissionActivityLog::create([
            'user_id' => Auth::id(),
            'activity' => 'Permission updated',
            'permission_name' => "From: {$oldPermissionName} To: {$request->name}", // Combine old and new names
        ]);

        return redirect()->route('permissions.index')->with('success', 'Permission updated successfully');
        
    }

    public function destroy($permissionId)
    {
        $permission = Permission::find($permissionId);

        if (!$permission) {
            return redirect()->route('permissions.index')->with('error', 'Permission not found.');
        }

        // Log activity
        PermissionActivityLog::create([
            'user_id' => Auth::id(),
            'activity' => 'Permission deleted',
            'permission_name' => $permission->name
        ]);

        $permission->delete();

        return redirect()->route('permissions.index')->with('success', 'Permission deleted successfully');
    }
}
