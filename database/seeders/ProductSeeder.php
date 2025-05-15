<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            "name" => "Nome do Produto 1",
            "description" => "Descrição do produto 1",
            "price" => 100.00,
            "stock" => 10
        ]);

        Product::create([
            "name" => "Nome do Produto 2",
            "description" => "Descrição do produto 2",
            "price" => 200.00,
            "stock" => 20
        ]);
    }
}
