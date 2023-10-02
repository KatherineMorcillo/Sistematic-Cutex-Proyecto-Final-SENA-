<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Client;

class ClientsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $clients = [
            [
                'names' => 'Erick',
                'surnames' => 'Camargo Peña',
                'cellphone' => '3124005050',
                'email' => 'Erick@gmail.com',
                'address' => 'Calle 45 Cra12 # 12-78',
                'document_number' => '1083814026',
                'document_id' => '1'
            ],


            [
                'names' => 'Camila',
                'surnames' => 'Murillo',
                'cellphone' => '3124005023',
                'email' => 'cm@gmail.com',
                'address' => 'Calle 45 Cra45 # 12-78',
                'document_number' => '1083814023',
                'document_id' => '2'
            ],
            [
                'names' => 'Steven',
                'surnames' => 'Fernandez',
                'cellphone' => '3135689754',
                'email' => 'cm@gmail.com',
                'address' => 'Carrera 45 calle 4 # 12-23',
                'document_number' => '1004415298',
                'document_id' => '3'
            ]
        ];
        foreach ($clients as $client) {
            Client::create([
                'names' => $client['names'],
                'surnames' => $client['surnames'],
                'cellphone' => $client['cellphone'],
                'email' => $client['email'],
                'address' => $client['address'],
                'document_number' => $client['document_number'],
                'document_id' => $client['document_id'],

            ]);
        }
    }
}
