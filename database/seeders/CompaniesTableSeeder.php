<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Company;

class CompaniesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $companies = [
            [
                'name' => 'Peleteria Cueros y Color',
                'nit' => '108381256978',
                'owner_name' => 'Yaneth Ortiz',
                'date_fundation' => '2000-02-06',
                'email' => 'peleteriacueros@gmail.com',
                'address' => 'Calle 123 Cra12 # 12-78',
                'cellphone' => '3124568974',
            ],
            [
                'name' => 'Peleteria 2',
                'nit' => '108381256',
                'owner_name' => 'Yaneth Ortiz',
                'date_fundation' => '2012-02-06',
                'email' => 'peleteria2@gmail.com',
                'address' => 'Calle 13 Cra12 # 12-78',
                'cellphone' => '3124568956',

            ]
        ];
        foreach ($companies as $company) {
            Company::create([
                'name' => $company['name'],
                'nit' => $company['nit'],
                'owner_name' => $company['owner_name'],
                'date_fundation' => $company['date_fundation'],
                'email' => $company['email'],
                'address' => $company['address'],
                'cellphone' => $company['cellphone'],
            ]);
            //
        }
    }
}
