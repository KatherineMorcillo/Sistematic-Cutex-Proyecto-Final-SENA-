<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles = [
            ['name' => 'Administrador'],
            ['name' => 'Vendedor'],
            ['name' => 'Auxiliar de bodega'],
        ];
        foreach ($roles as $rol) {
            Role::create([
                'name' => $rol['name'],
            ]);
        }
    }
}
