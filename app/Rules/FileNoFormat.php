<?php

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class FileNoFormat implements Rule
{
    public function passes($attribute, $value)
    {
        // Validate the file_no format
        return preg_match('/^(HA\/\d{2}\/\d{2}\/\d{2}\/\d{2}|[0-9]+)$/', $value) === 1;
    }

    public function message()
    {
        return 'The :attribute must be a valid file number (e.g., HA/05/10/02/17 or 15).';
    }
}
