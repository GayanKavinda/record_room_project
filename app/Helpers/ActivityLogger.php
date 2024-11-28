<?php

namespace App\Helpers;

use App\Models\ActivityLog;
use Illuminate\Support\Facades\Auth;

class ActivityLogger
{
    /**
     * Log an activity.
     *
     * @param string $action
     * @param string|null $details
     * @return void
     */
    public static function log($action, $details = null)
    {
        ActivityLog::create([
            'user_id' => Auth::id(), // Get the authenticated user's ID
            'action'  => $action,
            'details' => $details,
        ]);
    }
}
