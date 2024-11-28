<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;
use App\Models\RoleActivityLog; // Import the RoleActivityLog model

class RoleController extends Controller
{

    public function index()
    {
        // Fetch all roles from the database
        $roles = Role::get();

        // Pass the roles to the view
        return view('role-permission.role.index', ['roles' => $roles]);
    }

    public function create()
    {
        return view('role-permission.role.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name'
            ]
        ]);

        // Create a new role
        // Role::create([
        //     'name' => $request->name
        // ]);

        // Create a new role and assign it to $role
        $role = Role::create([
            'name' => $request->name
        ]);

        // Log the role activity
        RoleActivityLog::create([
            'user_id' => Auth::id(),
            'role_id' => $role->id, // Use the $role variable
            'details' => 'Role created: ' . $role->name, // Add dynamic details here
        ]);
        
        return redirect()->route('roles.index')->with('success', 'Role created successfully');
    }

    public function edit(Role $role)
    {
        return view('role-permission.role.edit', ['role' => $role]);
    }

    public function update(Request $request, Role $role)
    {
        $request->validate([
            'name' => [
                'required',
                'string',
                'unique:roles,name,' . $role->id
            ]
        ]);

        // Update the role
        $role->update([
            'name' => $request->name
        ]);

        // Log the role activity
        RoleActivityLog::create([
            'user_id' => Auth::id(),
            'role_id' => $role->id,
            'details' => 'Role updated: ' . $role->name // Ensure details is populated
        ]);
        
        return redirect()->route('roles.index')->with('success', 'Role updated successfully');
    }

    public function destroy($roleId)
    {
        // Find the role by ID
        $role = Role::find($roleId);

        if (!$role) {
            return redirect('roles')->with('error', 'Role not found.');
        }

        // Log the activity before deleting the role
        RoleActivityLog::create([
            'user_id' => Auth::id(),
            'role_id' => $role->id,
            'details' => 'Role deleted: ' . $role->name
        ]);

        // Delete the role
        $role->delete();

        return redirect('roles')->with('success', 'Role deleted successfully');
    }

    public function addPermissionToRole($roleId)
    {
        $permissions = Permission::get();
        $role = Role::findOrFail($roleId);
        $rolePermissions = DB::table('role_has_permissions')
            ->where('role_has_permissions.role_id', $role->id)
            ->pluck('role_has_permissions.permission_id', 'role_has_permissions.permission_id')
            ->all();

        // Log activity: View permission page for a specific role
        RoleActivityLog::create([
            'user_id' => Auth::id(),
            'role_id' => $role->id,
            'details' => 'Viewed permissions for role: ' . $role->name
        ]);
        
        return view('role-permission.role.add-permissions', [
            'role' => $role,
            'permissions' => $permissions,
            'rolePermissions' => $rolePermissions
        ]);
    }

    public function givePermissionToRole(Request $request, $roleId)
    {
        $request->validate([
            'permission' => 'required'
        ]);

        $role = Role::findOrFail($roleId);
        // Get previous permissions before syncing
        $previousPermissions = $role->permissions->pluck('name')->toArray();

        // Sync the permissions
        $role->syncPermissions($request->permission);

        // Get the newly assigned permissions
        $newPermissions = $role->permissions->pluck('name')->toArray();


        // Log the role activity
        RoleActivityLog::create([
            'user_id' => Auth::id(),
            'role_id' => $role->id,
            'details' => 'Assigned permissions to role: ' . $role->name . 
                        '. Previous: [' . implode(', ', $previousPermissions) . '], ' . 
                        'New: [' . implode(', ', $newPermissions) . ']'
        ]);
        
        return redirect()->back()->with('success', 'Permissions added to role');
    }
}
