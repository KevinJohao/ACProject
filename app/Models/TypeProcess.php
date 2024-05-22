<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeProcess extends Model
{
    use HasFactory;
    //$typeProcess -> $typeDocs
    public function typeProcessDocument()
    {
        return $this->hasMany(typeProcessDocument::class);
    }

    //$typeProcess -> $processes
    public function processes()
    {
        return $this->hasMany(Process::class);
    }
}
