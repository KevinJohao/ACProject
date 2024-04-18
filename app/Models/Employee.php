<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function activities()
    {
        //$user->$activities
        return $this->hasMany(Activity::class);
    }

    public function trackings()
    {
        //$user->$trackings
        return $this->hasMany(Tracking::class);
    }

    public function projects()
    {
        //$user->$trackings
        return $this->hasMany(Project::class);
    }
}
