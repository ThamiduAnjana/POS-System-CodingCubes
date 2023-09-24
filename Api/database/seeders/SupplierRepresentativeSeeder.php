<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SupplierRepresentativeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('supplier_representatives')->insert([
            'title' => 'System',
            'initials' => 'S',
            'first_name' => 'Walk-in',
            'middle_name' => 'Supplier',
            'last_name' => 'Representative',
            'sex' => 1,
            'dob' => '2023-01-01',
            'supplier_id' => 1,
            'status' => 1,
            'created_at' => now(),
            'created_by' => 1,
        ]);
    }
}
