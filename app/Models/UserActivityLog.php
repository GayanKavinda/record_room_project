<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory; // Correct import
use Illuminate\Database\Eloquent\Model;

class UserActivityLog extends Model
{
    use HasFactory;

    // Define the table name if it's not the plural form of the model name
    protected $table = 'user_activity_logs';

    // Define the fillable fields to allow mass assignment
    protected $fillable = [
        'user_id', 
        'action', 
        'details',
    ];

    // Relationship with User (assuming you have a User model)
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
