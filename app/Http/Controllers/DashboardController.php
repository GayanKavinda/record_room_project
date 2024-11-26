<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Department;
use App\Models\File;
use App\Models\User;
use Spatie\Permission\Models\Permission; // Import Permission model
use Spatie\Permission\Models\Role; // Import Role model

class DashboardController extends Controller
{
    public function index()
    {
        // Fetch real-time data
        $departmentCount = Department::count();
        $fileCount = File::count();
        $pendingFileCount = File::where('status', 'pending')->count();
        $storedFileCount = File::where('status', 'stored')->count();

        // Fetch users with no roles assigned (pending users)
        $pendingUserCount = User::whereDoesntHave('roles')->count();

        // Fetch total users
        $userCount = User::count(); 

        // Fetch the number of permissions
        $permissionCount = Permission::count();

        // Fetch the number of roles
        $roleCount = Role::count();

        // Pass data to the view
        return view('dashboard', compact(
            'departmentCount',
            'fileCount',
            'pendingFileCount',
            'storedFileCount',
            'userCount',
            'pendingUserCount', // This variable is for users with no roles assigned
            'permissionCount', // Add this line to pass the permission count
            'roleCount' // Add this line to pass the role count
        ));
    }
}