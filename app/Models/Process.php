<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Process extends Model
{
    use HasFactory;

    //$process -> $project
    public function project()
    {
        return $this->belongsTo(Project::class);
    }

    public function taskStatus()
    {
        return $this->belongsTo(TaskStatus::class);
    }

    //$process -> $typeProcess
    public function typeProcess()
    {
        return $this->belongsTo(TypeProcess::class);
    }

    //$process -> $activities
    public function activities()
    {
        return $this->hasMany(Activity::class);
    }

    //$process -> $processDocs
    public function processDocs()
    {
        return $this->hasMany(ProcessDocs::class);
    }
}
