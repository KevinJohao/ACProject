<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeDocs extends Model
{
    use HasFactory;

    //$typeDocs -> $processDocs
    public function typeProcessDocument()
    {
        return $this->hasMany(typeProcessDocument::class);
    }
}
