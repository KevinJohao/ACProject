<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeTracking extends Model
{
    use HasFactory;
    public function trackings()
    {
        return $this->hasMany(Tracking::class);
    }
}
