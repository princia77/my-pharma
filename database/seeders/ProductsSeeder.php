<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        (new Product())->insert([
            ["name" => "Amoxicillin", 'description' => 'Tablets for health',
                'category' => 'tablets',
                'inventory_stock' => '50',
                'price' => '20'],
            ["name" => "Vitamin D", 'description' => 'Tablets for health',
                'category' => 'tablets',
                'inventory_stock' => '50',
                'price' => '30'],
            ["name" => "Ibuprofen", 'description' => 'Tablets for health',
                'category' => 'tablets',
                'inventory_stock' => '50',
                'price' => '40'],
            ["name" => "ALevothyroxine", 'description' => 'Tablets for health',
                'category' => 'tablets',
                'inventory_stock' => '50',
                'price' => '50'],
            ["name" => "Lisinopril", 'description' => 'Tablets for health',
                'category' => 'tablets',
                'inventory_stock' => '50',
                'price' => '60'],
            ["name" => "Hizentra", 'description' => 'Tablets for health',
                'category' => 'vaccines',
                'inventory_stock' => '50',
                'price' => '20'],
            ["name" => "Hepatitis B adult vaccine", 'description' => 'Tablets for health',
                'category' => 'vaccines',
                'inventory_stock' => '50',
                'price' => '30'],
            ["name" => "Hydroxyzine Pamoate", 'description' => 'Tablets for health',
                'category' => 'vaccines',
                'inventory_stock' => '50',
                'price' => '40'],
            ["name" => "Haemophilus b Vaccine", 'description' => 'Tablets for health',
                'category' => 'vaccines',
                'inventory_stock' => '50',
                'price' => '50'],
            ["name" => "Lisinopril (Vaccine)", 'description' => 'Tablets for health',
                'category' => 'vaccines',
                'inventory_stock' => '50',
                'price' => '60'],
            ["name" => "Meloxicam (Mobic)", 'description' => 'Tablets for health',
                'category' => 'syrups',
                'inventory_stock' => '50',
                'price' => '20'],
            ["name" => "Lorazepam", 'description' => 'Tablets for health',
                'category' => 'syrups',
                'inventory_stock' => '50',
                'price' => '30'],
            ["name" => "Loratadine", 'description' => 'Tablets for health',
                'category' => 'syrups',
                'inventory_stock' => '50',
                'price' => '40'],
            ["name" => "Escitalopram", 'description' => 'Tablets for health',
                'category' => 'syrups',
                'inventory_stock' => '50',
                'price' => '50'],
            ["name" => "Furosemide", 'description' => 'Tablets for health',
                'category' => 'syrups',
                'inventory_stock' => '50',
                'price' => '60'],

        ]);

    }
}
