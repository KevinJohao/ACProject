<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;
    //$project -> $user
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function taskStatus()
    {
        return $this->belongsTo(TaskStatus::class);
    }

    //$project -> $Processes
    public function processes()
    {
        return $this->hasMany(Process::class);
    }
}
