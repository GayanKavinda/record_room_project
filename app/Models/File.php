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
        'department_no',
        'given_date',
        'page_capacity',
        'note',
        'expire_date',
        'in_record_room'
    ];

    public function department()
    {
        return $this->belongsTo(Department::class, 'department_no', 'department_no');
    }

    public function recordRoom()
    {
        return $this->hasOne(RecordRoom::class, 'file_no', 'file_no');
    }
}
