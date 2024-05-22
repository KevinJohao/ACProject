<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable = ['id', /* otros campos que quieras hacer fillable */];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function projects()
    {
        //$user->$projects
        return $this->hasMany(Project::class);
    }

    public function generalDocuments()
    {
        //$user->$projects
        return $this->hasMany(generalDocument::class);
    }
}
