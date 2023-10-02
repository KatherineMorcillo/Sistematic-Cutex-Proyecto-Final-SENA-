<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $users = [
            [
                'name' => 'Katerine',
                'surname' => 'Ordoñez',
                'document_number' => '1083814056',
                'address' => 'Calle 45 Cra12 # 12-78',
                'cellphone' => '3124314528',
                'email' => 'ko@gmail.com',
                'gender' => 'femenino',
                'document_id' => '1',
                'rol_id' => '1',
                'company_id' => '1',
                'password' => 'prueba123'
            ],


            [
                'name' => 'Carlos',
                'surname' => 'Lopez',
                'document_number' => '1083814045',
                'address' => 'Calle 45 Cra12 # 12-78',
                'cellphone' => '3124314512',
                'email' => 'cl@gmail.com',
                'gender' => 'masculino',
                'document_id' => '2',
                'rol_id' => '2',
                'company_id' => '1',
                'password' => 'prueba123'
            ],
            [
                'name' => 'Samanta',
                'surname' => 'Herrera',
                'document_number' => '1083814089',
                'address' => 'Calle 45 Cra12 # 12-78',
                'cellphone' => '3124314556',
                'email' => 'sh@gmail.com',
                'gender' => 'femenino',
                'document_id' => '3',
                'rol_id' => '3',
                'company_id' => '1',
                'password' => 'prueba123'
            ],
            [
                'name' => 'Sebastian',
                'surname' => 'Caicedo',
                'document_number' => '10014068975',
                'address' => 'Calle 45 Cra12 # 12-78',
                'cellphone' => '31243145296',
                'email' => 'sc@gmail.com',
                'gender' => 'masculino',
                'document_id' => '1',
                'rol_id' => '1',
                'company_id' => '1',
                'password' => 'prueba123'
            ],
            [
                'name' => 'Elena',
                'surname' => 'Sandobal Peña',
                'document_number' => '1004415278',
                'address' => 'Calle 45 Cra12 # 12-78',
                'cellphone' => '3137256892',
                'email' => 'esp@gmail.com',
                'gender' => 'femenino',
                'document_id' => '2',
                'rol_id' => '2',
                'company_id' => '1',
                'password' => 'prueba123'
            ],
            [
                'name' => 'Santiago',
                'surname' => 'Alarcon',
                'document_number' => '1083812659',
                'address' => 'Calle 45 Cra12 # 12-78',
                'cellphone' => '3124311235',
                'email' => 'as@gmail.com',
                'gender' => 'masculino',
                'document_id' => '3',
                'rol_id' => '3',
                'company_id' => '1',
                'password' => 'prueba123'
            ]

        ];
        foreach ($users as $user) {
            User::create([
                'name' => $user['name'],
                'surname' => $user['surname'],
                'document_number' => $user['document_number'],
                'address' => $user['address'],
                'cellphone' => $user['cellphone'],
                'email' => $user['email'],
                'gender' => $user['gender'],
                'document_id' => $user['document_id'],
                'rol_id' => $user['rol_id'],
                'company_id' => $user['company_id'],
                'password' => Hash::make($user['password']),

            ]);
        }
    }
}
