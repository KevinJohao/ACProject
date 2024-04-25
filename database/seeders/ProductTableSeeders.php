<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductTableSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        /*
        \App\Models\Category::factory(5)->create();
        \App\Models\Product::factory(100)->create();
        \App\Models\ProductImage::factory(200)->create(); */

        $categories = Category::factory(5)->create();
        $categories->each(function ($category) {
            $products = Product::factory(20)->make();
            $category->products()->saveMany($products);

            $products->each(function ($p) {
                $images = ProductImage::factory(5)->make();
                $p->images()->saveMany($images);
            });
        });
    }
}
