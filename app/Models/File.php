<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;

    protected $fillable = [
        'file_no',
        'responsible_officer',
        'open_date',
        'close_date',
        'department_no',  // Add this line to make department_no fillable
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_no', 'department_no');
    }
}
