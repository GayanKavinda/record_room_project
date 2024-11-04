<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RecordRoom extends Model
{
    protected $fillable = ['file_id', 'rack_letter', 'sub_rack', 'cell_number'];

    public function file()
    {
        return $this->belongsTo(File::class);
    }
}
