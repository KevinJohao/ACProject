<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TaskStatus extends Model
{
    use HasFactory;
    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function processes()
    {
        return $this->hasMany(Process::class);
    }

    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    public function trackings()
    {
        return $this->hasMany(Tracking::class);
    }
}
