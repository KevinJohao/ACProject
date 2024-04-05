<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assignment extends Model
{
    use HasFactory;
    public function process()
    {
        //$assignment->$process
        return $this->belongsTo(Process::class);
    }

    public function activity()
    {
        //$assignment->$activity
        return $this->belongsTo(Activity::class);
    }

    public function user()
    {
        //$assignment->$user
        return $this->belongsTo(User::class);
    }

    public function trackings()
    {
        return $this->hasMany(Tracking::class);
    }
}
