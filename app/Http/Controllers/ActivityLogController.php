<?php

namespace App\Http\Controllers;

use App\Models\ActivityLog; // Import the ActivityLog model
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ActivityLogController extends Controller
{
    public function index()
    {
        $logs = ActivityLog::latest()->paginate(10);

        // If no logs exist, show a message
        if ($logs->isEmpty()) {
            $message = 'No activity logs available.';
        } else {
            $message = null;
        }

        return view('activity_logs.index', compact('logs', 'message'));
    }
}
