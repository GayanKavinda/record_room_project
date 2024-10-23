<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Department extends Model
{
    use HasFactory;

    // Specify the table name if it's not the plural of the model name
    protected $table = 'departments'; // Ensure this is correct

    // Specify the fillable attributes if using mass assignment
    protected $fillable = ['department_name']; // Use 'department_name' as your column name
}
