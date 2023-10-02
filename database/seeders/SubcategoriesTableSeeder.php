<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Subcategory;

class SubcategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $subcategories = [
            [
                'name' => 'Correas',
                'category_id' => '1'
            ],
            [
                'name' => 'Billeteras',
                'category_id' => '1'
            ],
            [
                'name' => 'Correas',
                'category_id' => '2'
            ],
            [
                'name' => 'Billeteras',
                'category_id' => '2'
            ],
            [
                'name' => 'Bolsos',
                'category_id' => '1'
            ],
            [
                'name' => 'Bolsos',
                'category_id' => '2'
            ],
            [
                'name' => 'Cueros y pieles',
                'category_id' => '3'
            ],

        ];
        foreach ($subcategories as $subcategory) {
            Subcategory::create([
                'name' => $subcategory['name'],
                'category_id' => $subcategory['category_id'],
            ]);
        }
    }
}
