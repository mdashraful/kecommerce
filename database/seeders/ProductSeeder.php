<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Product::factory()->count(20)->create();

        $products = Product::select('id')->get();

        foreach($products as $product)
        {
            $product->addMediaFromUrl("https://i.ibb.co/WVKbczV/8-Essential-Smartphone-Accessories.jpg")->toMediaCollection('products');
        }
    }
}
