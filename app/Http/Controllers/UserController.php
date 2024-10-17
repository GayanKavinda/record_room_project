<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Department;
use Spatie\Permission\Models\Role;

class UserController extends Controller
{
    public function index()
    {
        // Fetch all departments and roles
        $departments = Department::all();
        $roles = Role::pluck('name', 'name')->all();

        return view('role-permission.user.create', [
            'departments' => $departments,
            'roles' => $roles,
        ]);
    }


    public function create()
    {
        // Fetch all departments from the database
        $departments = Department::all();

        // Fetch all roles from the database
        $roles = Role::pluck('name', 'name')->all();

        // Pass departments and roles to the view
        return view('role-permission.user.create', [
            'departments' => $departments,
            'roles' => $roles,
        ]);
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $request->validate([
            'employee_id' => 'required|string|unique:users,employee_id',
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users,email',
            'department_name' => 'required|string|exists:departments,department_name',
            'join_or_transfer' => 'required|in:join,transfer',
            'date' => 'required|date',
            'password' => 'required|string|confirmed|min:8',
            'roles' => 'required'
        ]);

        // Create the user
        $user = User::create([
            'employee_id' => $request->employee_id,
            'name' => $request->name,
            'email' => $request->email,
            'department_name' => $request->department_name, // You might need to link this to department ID if using relations
            'join_or_transfer' => $request->join_or_transfer,
            'date' => $request->date,
            'password' => bcrypt($request->password),
        ]);

        $user->syncRoles($request->roles);

        // Redirect back with a success message
        return redirect()->route('users.index')->with('success', 'User created successfully with roles.');
    }
}
