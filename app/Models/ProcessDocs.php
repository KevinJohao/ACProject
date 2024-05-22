<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProcessDocs extends Model
{
    use HasFactory;
    //$processDocs -> $process
    public function process()
    {
        return $this->belongsTo(Process::class);
    }

    //$processDocs -> $typeDocs
    public function typeProcessDocument()
    {
        return $this->belongsTo(typeProcessDocument::class);
    }
}
