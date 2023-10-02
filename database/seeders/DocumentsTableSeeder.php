<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Document;

class DocumentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $documents = [
            [
                'name' => 'Cedula de ciudadania',
                'acronym' => 'CC',
            ],

            [
                'name' => 'Tarjeta de identidad',
                'acronym' => 'TI',
            ],

            [
                'name' => 'Pasaporte',
                'acronym' => 'PA',
            ]
        ];
        foreach ($documents as $document) {
            Document::create([
                'name' => $document['name'],
                'acronym' => $document['acronym'],
            ]);
        }
    }
}
