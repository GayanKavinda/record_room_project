<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DepartmentActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',  // User who performed the action
        'action',   // Action (Create, Update, Delete)
        'details',  // Action details (name of department, changes made, etc.)
    ];

    /**
     * Get the user that owns the department activity log.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
