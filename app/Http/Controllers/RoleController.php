<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Routing\Controllers\HasMiddleware;
use Illuminate\Support\Facades\Auth;

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
        Role::create([
            'name' => $request->name
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

        return redirect()->route('roles.index')->with('success', 'Role updated successfully');
    }

    public function destroy($roleId)
    {
        // Find the role by ID
        $role = Role::find($roleId);

        if (!$role) {
            return redirect('roles')->with('error', 'Role not found.');
        }

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
        $role->syncPermissions($request->permission);

        return redirect()->back()->with('success', 'Permissions added to role');
    }
}
