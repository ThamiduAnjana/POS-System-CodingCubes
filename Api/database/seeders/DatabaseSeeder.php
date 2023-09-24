<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            AddressSeeder::class,
            CustomerSeeder::class,
            EmployeeSeeder::class,
            MailSeeder::class,
            SupplierRepresentativeSeeder::class,
            SupplierSeeder::class,
        ]);
    }
}
