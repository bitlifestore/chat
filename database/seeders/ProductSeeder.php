<?php
namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class ProductSeeder extends Seeder {
    public function run(): void {
        $products = [
            [
                'name'        => 'iPhone 15 Pro',
                'description' => 'Apple iPhone 15 Pro with A17 Pro chip, titanium design, and 48MP camera system.',
                'price'       => 79999,
                'stock'       => 50,
                'category'    => 'Electronics',
                'is_active'   => true,
            ],
            [
                'name'        => 'Nike Air Max 270',
                'description' => 'Lightweight, breathable Nike Air Max with full-length Air unit for all-day comfort.',
                'price'       => 8999,
                'stock'       => 100,
                'category'    => 'Footwear',
                'is_active'   => true,
            ],
            [
                'name'        => 'Sony WH-1000XM5',
                'description' => 'Industry-leading noise cancelling wireless headphones with 30-hour battery life.',
                'price'       => 24999,
                'stock'       => 30,
                'category'    => 'Electronics',
                'is_active'   => true,
            ],
            [
                'name'        => 'Smart LED TV 55"',
                'description' => '55-inch 4K UHD Smart LED TV with Dolby Vision and built-in Alexa.',
                'price'       => 45999,
                'stock'       => 15,
                'category'    => 'Electronics',
                'is_active'   => true,
            ],
            [
                'name'        => 'Levi\'s 511 Slim Jeans',
                'description' => 'Classic slim fit jeans in stretch denim for all-day comfort.',
                'price'       => 3499,
                'stock'       => 200,
                'category'    => 'Apparel',
                'is_active'   => true,
            ],
            [
                'name'        => 'Himalaya Neem Face Wash',
                'description' => 'Oil control and pimple-clearing neem face wash for combination skin.',
                'price'       => 149,
                'stock'       => 500,
                'category'    => 'Beauty',
                'is_active'   => false,
            ],
        ];

        foreach ($products as $p) {
            $p['slug'] = Str::slug($p['name']);
            Product::create($p);
        }

        $this->command->info('✅ ' . count($products) . ' products seeded successfully!');
    }
}
