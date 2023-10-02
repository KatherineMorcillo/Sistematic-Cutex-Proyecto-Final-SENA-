<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Database\Seeders\ProvidersTableSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(ProvidersTableSeeder::class);
        $this->call(ColorsTableSeeder::class);
        $this->call(CategoriesTableSeeder::class);
        $this->call(CompaniesTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(DocumentsTableSeeder::class);
        $this->call(ClientsTableSeeder::class);
        $this->call(SubcategoriesTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(InvoicesTableSeeder::class);
        $this->call(ProductsTableSeeder::class);
        $this->call(DetailsTableSeeder::class);
    }
}
