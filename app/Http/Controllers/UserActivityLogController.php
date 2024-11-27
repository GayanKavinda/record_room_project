<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\UserActivityLog;  // Make sure to import the model

class UserActivityLogController extends Controller
{
    public function index()
    {
        $logs = UserActivityLog::latest()->paginate(10);

        if ($logs->isEmpty()) {
            $message = 'No user activity logs available.';
        } else {
            $message = null;
        }

        return view('activity_logs.user_activity', compact('logs', 'message'));
    }
}
