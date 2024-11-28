<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Models\Role; // Import the Role model
use App\Models\User;

class RoleActivityLog extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'details',
        'role_id', // Ensure this is included
    ];

    // Define relationship with User
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Define relationship with Role
    public function role()
    {
        return $this->belongsTo(Role::class);
    }
}
