<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DepartmentActivityLog;  // Import the correct model

class DepartmentActivityLogController extends Controller
{
    public function index()
{
    $activities = DepartmentActivityLog::with('user') // Assuming you have a relationship with the User model
        ->orderBy('created_at', 'desc') // To show the latest activities at the top
        ->get();

    return view('activity_logs.department_activity', compact('activities'));
}
}
