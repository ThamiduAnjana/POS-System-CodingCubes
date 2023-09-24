<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('mails')->insert([
            [
                'owner_type' => 1,
                'owner_id' => 1,
                'mail' => 'codingcubes@gmail.com',
                'is_primary' => 1,
                'status' => 1,
                'created_at' => now(),
                'created_by' => 1,
            ],
            [
                'owner_type' => 2,
                'owner_id' => 1,
                'mail' => 'walkincustomer@gmail.com',
                'is_primary' => 1,
                'status' => 1,
                'created_at' => now(),
                'created_by' => 1,
            ],
            [
                'owner_type' => 3,
                'owner_id' => 1,
                'mail' => 'walkinsupplier@gmail.com',
                'is_primary' => 1,
                'status' => 1,
                'created_at' => now(),
                'created_by' => 1,
            ],
            [
                'owner_type' => 4,
                'owner_id' => 1,
                'mail' => 'walkinsupplierrep@gmail.com',
                'is_primary' => 1,
                'status' => 1,
                'created_at' => now(),
                'created_by' => 1,
            ]
        ]);
    }
}
