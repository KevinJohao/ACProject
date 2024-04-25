<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeProcess extends Model
{
    use HasFactory;
    //$typeProcess -> $typeDocs
    public function typeDocs()
    {
        return $this->hasMany(TypeDocs::class);
    }

    //$typeProcess -> $processes
    public function processes()
    {
        return $this->hasMany(Process::class);
    }
}
