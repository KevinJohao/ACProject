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

    //$project -> $Projects
    public function Projects()
    {
        return $this->hasMany(Project::class);
    }
}
