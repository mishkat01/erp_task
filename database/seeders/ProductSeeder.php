<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $products = [
            ['sku' => 'STA-0001', 'name' => 'A4 Paper Ream', 'unit' => 'ream', 'current_stock' => 120],
            ['sku' => 'STA-0002', 'name' => 'Ballpoint Pen (Box of 50)', 'unit' => 'box', 'current_stock' => 40],
            ['sku' => 'STA-0003', 'name' => 'Stapler', 'unit' => 'pcs', 'current_stock' => 25],
            ['sku' => 'STA-0004', 'name' => 'File Folder', 'unit' => 'pcs', 'current_stock' => 200],
            ['sku' => 'IT-0001', 'name' => 'Wireless Mouse', 'unit' => 'pcs', 'current_stock' => 15],
            ['sku' => 'IT-0002', 'name' => 'USB Keyboard', 'unit' => 'pcs', 'current_stock' => 15],
            ['sku' => 'IT-0003', 'name' => '24" Monitor', 'unit' => 'pcs', 'current_stock' => 8],
            ['sku' => 'IT-0004', 'name' => 'HDMI Cable', 'unit' => 'pcs', 'current_stock' => 30],
            ['sku' => 'FUR-0001', 'name' => 'Office Chair', 'unit' => 'pcs', 'current_stock' => 10],
            ['sku' => 'FUR-0002', 'name' => 'Office Desk', 'unit' => 'pcs', 'current_stock' => 6],
            ['sku' => 'CLN-0001', 'name' => 'Hand Sanitizer (500ml)', 'unit' => 'bottle', 'current_stock' => 50],
            ['sku' => 'CLN-0002', 'name' => 'Tissue Box', 'unit' => 'box', 'current_stock' => 100],
        ];

        foreach ($products as $product) {
            Product::firstOrCreate(
                ['sku' => $product['sku']],
                $product
            );
        }
    }
}
