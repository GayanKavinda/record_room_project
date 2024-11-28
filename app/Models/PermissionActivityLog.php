<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PermissionActivityLog extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'activity', 'permission_name'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}