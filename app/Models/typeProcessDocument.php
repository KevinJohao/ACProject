<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class typeProcessDocument extends Model
{
    use HasFactory;

    public function typeDocs()
    {
        return $this->belongsTo(TypeDocs::class);
    }

    public function typeProcess()
    {
        return $this->belongsTo(TypeProcess::class);
    }

    public function processDocument()
    {
        return $this->hasMany(ProcessDocs::class);
    }
}
