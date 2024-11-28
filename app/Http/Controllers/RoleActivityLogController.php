<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use App\Models\RoleActivityLog;
use Illuminate\Support\Facades\DB;

class RoleActivityLogController extends Controller
{
    public function index(Request $request)
    {
        // Fetch logs with optional filters
        $query = RoleActivityLog::query();

        // Filter by role ID
        if ($request->has('role_id') && $request->role_id) {
            $query->where('role_id', $request->role_id);
        }

        // Filter by user ID
        if ($request->has('user_id') && $request->user_id) {
            $query->where('user_id', $request->user_id);
        }

        // Filter by specific updated date
        if ($request->has('filter_date') && $request->filter_date) {
            $query->whereDate('updated_at', $request->filter_date);
        }

        // Get logs with pagination
        $logs = $query->with(['role', 'user'])->latest()->paginate(10);

        // Fetch roles and users for the filter dropdowns
        $roles = Role::all();
        $users = DB::table('users')->select('id', 'name')->get();

        return view('activity_logs.role_activity', compact('logs', 'roles', 'users'));
    }
    
}
