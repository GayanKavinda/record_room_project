<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Department;
use Spatie\Permission\Models\Role;
use App\Models\UserActivityLog;

class UserController extends Controller
{
    public function index()
    {
        // Fetch all users from the database
        $users = User::all();

        // Get the total count of users
        $totalUsers = User::count();

        return view('role-permission.user.index', [
            'users' => $users, // Pass the users to the view
            'totalUsers' => $totalUsers, // Pass the total user count to the view
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
            'nic' => 'required|string|unique:users,nic|max:20', // Add validation for NIC
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
            'nic' => $request->nic,
            'email' => $request->email,
            'department_name' => $request->department_name, // You might need to link this to department ID if using relations
            'join_or_transfer' => $request->join_or_transfer,
            'date' => $request->date,
            'password' => bcrypt($request->password),
        ]);

        // Log the activity (creating a user)
        UserActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'Created User',
            'details' => 'User ' . $user->name . ' (ID: ' . $user->id . ') was created.',
        ]);

        $user->syncRoles($request->roles);

        // Redirect back with a success message
        return redirect()->route('users.index')->with('success', 'User created successfully with roles.');
    }

    public function edit(User $user)
    {
        // Format the date to 'Y-m-d' for the input field
        $user->date = \Carbon\Carbon::parse($user->date)->format('Y-m-d');
        
        // Fetch all departments from the database
        $departments = Department::all();

        // Fetch all roles from the database
        $roles = Role::pluck('name', 'name')->all();

        $userRoles = $user->roles->pluck('name', 'name')->all();

        // Pass the user, departments, and roles to the view
        return view('role-permission.user.edit', [
            'user' => $user,
            'departments' => $departments, // Pass departments to the view
            'roles' => $roles,
            'userRoles' => $userRoles
        ]);
    }


    public function update(Request $request, User $user)
    {
        // Validate the incoming request data, using the user's ID to ignore unique constraints on the existing user
        $request->validate([
            'employee_id' => 'required|string|unique:users,employee_id,' . $user->id,
            'name' => 'required|string|max:255',
            'nic' => 'required|string|max:20|unique:users,nic,' . $user->id, // Allow the existing user's NIC
            'email' => 'required|string|email|max:255|unique:users,email,' . $user->id, // Allow the existing user's email
            'department_name' => 'required|string|exists:departments,department_name',
            'join_or_transfer' => 'required|in:join,transfer',
            'date' => 'required|date',
            'password' => 'nullable|string|confirmed|min:8', // Password is optional
            'roles' => 'required'
        ]);

        // Store the original values (before the update)
        $originalData = $user->getOriginal();

        // Update the user data
        $data = [
            'employee_id' => $request->employee_id,
            'name' => $request->name,
            'nic' => $request->nic,
            'email' => $request->email,
            'department_name' => $request->department_name,
            'join_or_transfer' => $request->join_or_transfer,
            'date' => $request->date,
        ];

        // Only update the password if it is provided
        if (!empty($request->password)) {
            $data['password'] = bcrypt($request->password);
        }

        // Update user details
        $user->update($data);

        // Prepare the details for the activity log (what exactly was updated)
        $changes = [];
        foreach ($data as $key => $newValue) {
            // Check if the value has actually changed
            if ($originalData[$key] != $newValue) {
                // Log the change in details
                $changes[] = ucfirst(str_replace('_', ' ', $key)) . ': ' . $originalData[$key] . ' => ' . $newValue;
            }
        }

        // Log the activity with the changes
        UserActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'Updated User',
            'details' => 'User ' . $user->name . ' (ID: ' . $user->id . ') was updated. Changes: ' . implode(', ', $changes),
        ]);

        // Sync the roles
        $user->syncRoles($request->roles);

        // Redirect back with a success message
        return redirect()->route('users.index')->with('success', 'User updated successfully with roles.');
    }

    public function destroy($userId)
    {
        $user = User::findOrFail($userId);
        $user->delete();

        // Log the activity (deleting a user)
        UserActivityLog::create([
            'user_id' => auth()->id(),
            'action' => 'Deleted User',
            'details' => 'User ' . $user->name . ' (ID: ' . $user->id . ') was deleted.',
        ]);
        
        // Redirect back with a success message
        return redirect()->route('users.index')->with('success', 'User deleted successfully.');

    }
}
