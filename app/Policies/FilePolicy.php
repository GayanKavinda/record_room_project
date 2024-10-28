<?php

namespace App\Policies;

use App\Models\File;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class FilePolicy
{
    public function view(User $user, File $file)
    {
        return $user->hasRole('admin') || $user->department_name === $file->department_name;
    }

    public function create(User $user)
    {
        return $user->hasRole('admin');
    }

    public function delete(User $user, File $file)
    {
        return $user->hasRole('admin');
    }
}
