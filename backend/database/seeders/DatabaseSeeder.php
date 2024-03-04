<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\Product;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // Create 10 products using the Product model factory
        Product::factory(10)->create();

        // Create a single product with custom attributes
        Product::factory()->create([
            'name' => 'Sample Product',
            'price' => 19.99,
            'image' => 'sample_product.jpg',
            'description' => 'This is a sample product description.',
            'available' => true,
            'rate' => 4.5,
            'quantity' => 10,
            'seller_id' => 1, // Assuming seller with ID 1 exists in the users table
            'img2' => 'sample_product_2.jpg',
            'img3' => 'sample_product_3.jpg',
            'img4' => 'sample_product_4.jpg',
        ]);
    }
}
