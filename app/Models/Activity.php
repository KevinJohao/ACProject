<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    use HasFactory;
    public function process()
    {
        //$Activity->$process
        return $this->belongsTo(Process::class);
    }

    public function typeActivity()
    {
        //$typeActivity->$typeactivity
        return $this->belongsTo(TypeActivity::class);
    }

    public function taskStatus()
    {
        return $this->belongsTo(TaskStatus::class);
    }

    public function employee()
    {
        //$Activity->$user
        return $this->belongsTo(Employee::class);
    }

    public function trackings()
    {
        return $this->hasMany(Tracking::class);
    }
}
