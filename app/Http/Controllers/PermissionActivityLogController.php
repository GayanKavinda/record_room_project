<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PermissionActivityLog;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;

class PermissionActivityLogController extends Controller
{
    public function store($activityType, $modelName, $description)
    {
        PermissionActivityLog::create([
            'activity_type' => $activityType,
            'model_name' => $modelName,
            'description' => $description,
            'user_id' => Auth::id(),
        ]);
    }
}
