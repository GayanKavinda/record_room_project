<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecordRoom extends Model
{
    protected $table = 'record_room';

    protected $fillable = ['file_no', 'rack_no', 'cell_no'];

    public function file()
    {
        return $this->belongsTo(File::class, 'file_no', 'file_no');
    }
}
