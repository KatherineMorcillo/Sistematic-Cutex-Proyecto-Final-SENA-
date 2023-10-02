<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Color;

class ColorsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $colors = [

            [
                'name' => 'Blanco',
                'color_code' => '#FDFEFE ',

            ],
            [
                'name' => 'Café',
                'color_code' => '#784212',

            ],
            [
                'name' => 'Rosado',
                'color_code' => '#D98880',

            ],

            [
                'name' => 'Negro',
                'color_code' => '#17202A',

            ],
            [
                'name' => 'Gris',
                'color_code' => '#626567 ',

            ],
            [
                'name' => 'Vinotinto',
                'color_code' => '#A93226 ',

            ],
            [
                'name' => 'Morado',
                'color_code' => '#8E44AD  ',

            ],


        ];
        foreach ($colors as $color) {
            Color::create([
                'name' => $color['name'],
                'color_code' => $color['color_code'],
            ]);
        }
    }
}
