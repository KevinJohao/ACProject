<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;
    //$product -> $category
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    //$product -> $images
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
