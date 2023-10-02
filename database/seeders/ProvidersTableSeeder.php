<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Provider;

class ProvidersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $providers = [
            [
                'business_name' => 'Correas Sofi',
                'admin_name' => 'Sandra Ortiz',
                'cellphone' => '3124005050',
                'email' => 'correasofi@gmail.com',
                'address' => 'Calle 123 Cra12 # 12-78',
            ],


            [
                'business_name' => 'Bolsos Dally',
                'admin_name' => 'Edgar Parra',
                'cellphone' => '3124505050',
                'email' => 'bd@gmail.com',
                'address' => 'Calle 33 Cra5 # 89-2',
            ]
        ];
        foreach ($providers as $provider) {
            Provider::create([
                'business_name' => $provider['business_name'],
                'admin_name' => $provider['admin_name'],
                'cellphone' => $provider['cellphone'],
                'email' => $provider['email'],
                'address' => $provider['address']
            ]);
        }
    }
}
