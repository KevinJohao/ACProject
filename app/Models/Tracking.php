<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    use HasFactory;

    public function activity()
    {
        //$tracking->$activity
        return $this->belongsTo(Activity::class);
    }

    public function taskStatus()
    {
        return $this->belongsTo(TaskStatus::class);
    }

    public function employee()
    {
        //$tracking->$user
        return $this->belongsTo(Employee::class);
    }

    public function typeTracking(){

        return $this->belongsTo(TypeTracking::class);
    }
}
