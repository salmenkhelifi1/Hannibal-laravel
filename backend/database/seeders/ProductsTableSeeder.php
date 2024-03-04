<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        for ($i = 1; $i <= 10; $i++) {
            Product::create([
                'name' => 'Product ' . $i,
                'price' => 19.99 + $i,
                'image' => 'product' . $i . '.jpg',
                'description' => 'Sample description for Product ' . $i,
                'available' => true,
                'rate' => 4.5,
                'quantity' => 10,
                'seller_id' => 1,
                'img2' => 'product' . $i . '_2.jpg',
                'img3' => 'product' . $i . '_3.jpg',
                'img4' => 'product' . $i . '_4.jpg',
            ]);
        }
    }
}
