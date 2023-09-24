<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('employees')->insert([
            'first_name' => 'CodingCubes',
            'middle_name' => 'Software',
            'last_name' => 'Company',
            'initials' => 'C C',
            'sex' => 1,
            'dob' => '2023-01-01',
            'user_id' => 1,
            'status' => 1,
            'created_at' => now(),
            'created_by' => 1,
        ]);
    }
}
