<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class EmployeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('employees')->insert([
            'title' => 'System',
            'initials' => 'C C',
            'first_name' => 'CodingCubes',
            'middle_name' => 'Software',
            'last_name' => 'Company',
            'sex' => 1,
            'dob' => '2023-01-01',
            'username' => 'codingcubes@gmail.com',
            'password' => Hash::make('123'),
            'status' => 1,
            'created_at' => now(),
            'created_by' => 1,
        ]);
    }
}
