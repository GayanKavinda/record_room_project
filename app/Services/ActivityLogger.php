<?php

namespace App\Services;

use Illuminate\Support\Facades\Log;

class ActivityLogger
{
    public static function log($action, $details)
    {
        Log::info('Activity: ' . $action . ' | Details: ' . $details);
    }
}
