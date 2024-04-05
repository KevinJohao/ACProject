<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TypeDocs extends Model
{
    use HasFactory;
    //$typeDocs -> $typeProcess
    public function typeProcess()
    {
        return $this->belongsTo(TypeProcess::class);
    }

    //$typeDocs -> $processDocs
    public function processDocs()
    {
        return $this->hasMany(ProcessDocs::class);
    }
}
