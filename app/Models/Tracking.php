<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tracking extends Model
{
    use HasFactory;

    public function assignment()
    {
        //$tracking->$assignment
        return $this->belongsTo(Assignment::class);
    }

    public function user()
    {
        //$tracking->$user
        return $this->belongsTo(User::class);
    }
}
