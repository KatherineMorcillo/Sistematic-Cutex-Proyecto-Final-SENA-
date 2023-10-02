<?php

namespace Database\Seeders;

use App\Models\Detail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DetailsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */

    public function run(): void
    {
        //
        $details = [
            [
                "price" => "25000",
                "stock" => "5",
                "subtotal" => "125000",
                "invoice_id" => "1",
                "product_id" => "1"
            ],
            [
                "price" => "35000",
                "stock" => "3",
                "subtotal" => "105000",
                "invoice_id" => "2",
                "product_id" => "2"
            ],
            [
                "price" => "25000",
                "stock" => "1",
                "subtotal" => "25000",
                "invoice_id" => "2",
                "product_id" => "1"
            ],
            [
                "price" => "35000",
                "stock" => "2",
                "subtotal" => "70000",
                "invoice_id" => "3",
                "product_id" => "3"
            ],
        ];

        foreach ($details as $detial) {
            Detail::create([
                "price" => $detial['price'],
                "stock" => $detial['stock'],
                "subtotal" => $detial['subtotal'],
                "invoice_id" => $detial['invoice_id'],
                "product_id" => $detial['product_id']
            ]);
        }
    }
}
