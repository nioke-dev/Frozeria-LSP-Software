<?php

namespace database\seeders;

use App\Models\Category;
use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $categories = [
            ['name' => 'Ayam', 'description' => 'Olahan berbahan dasar daging ayam'],
            ['name' => 'Seafood', 'description' => 'Olahan hasil laut'],
            ['name' => 'Sapi', 'description' => 'Olahan daging sapi'],
            ['name' => 'Sayuran', 'description' => 'Sayuran beku'],
            ['name' => 'Siap Saji', 'description' => 'Makanan yang tinggal dipanaskan'],
            ['name' => 'Sosis', 'description' => 'Berbagai jenis sosis premium'],
            ['name' => 'Bakso', 'description' => 'Bakso sapi dan ikan pilihan'],
            ['name' => 'Nugget', 'description' => 'Varian nugget ayam dan ikan'],
            ['name' => 'Kentang', 'description' => 'Kentang goreng beku berkualitas'],
            ['name' => 'Dimsum', 'description' => 'Dimsum dan siomay beku'],
            ['name' => 'Dessert', 'description' => 'Makanan pencuci mulut beku'],
            ['name' => 'Bumbu', 'description' => 'Bumbu masak instan beku'],
            ['name' => 'Susu', 'description' => 'Produk susu dan olahannya'],
            ['name' => 'Buah', 'description' => 'Buah-buahan beku segar'],
            ['name' => 'Pastry', 'description' => 'Adonan kue dan roti beku'],
        ];

        foreach ($categories as $category) {
            Category::updateOrCreate(['name' => $category['name']], $category);
        }
    }
}
