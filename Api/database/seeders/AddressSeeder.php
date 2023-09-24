<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AddressSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('addresses')->insert([
            [
                'owner_type' => 1,
                'owner_id' => 1,
                'house' => 'Anjana',
                'street' => 'Kothalawala Road',
                'village' => 'Raja Ela',
                'city' => 'Hingurakgoda',
                'postal_code' => '51400',
                'district' => 'Polonnaruwa',
                'province' => 'North Central Province',
                'country' => 'Sri Lanka',
                'is_primary' => 1,
                'status' => 1,
                'created_at' => now(),
                'created_by' => 1,
            ],
            [
                'owner_type' => 2,
                'owner_id' => 1,
                'house' => 'Walk-in Customer',
                'street' => 'Street',
                'village' => 'Village',
                'city' => 'City',
                'postal_code' => '00000',
                'district' => 'District',
                'province' => 'Province',
                'country' => 'Sri Lanka',
                'is_primary' => 1,
                'status' => 1,
                'created_at' => now(),
                'created_by' => 1,
            ],
            [
                'owner_type' => 3,
                'owner_id' => 1,
                'house' => 'Walk-in Supplier',
                'street' => 'Street',
                'village' => 'Village',
                'city' => 'City',
                'postal_code' => '00000',
                'district' => 'District',
                'province' => 'Province',
                'country' => 'Sri Lanka',
                'is_primary' => 1,
                'status' => 1,
                'created_at' => now(),
                'created_by' => 1,
            ],
            [
                'owner_type' => 4,
                'owner_id' => 1,
                'house' => 'Walk-in Supplier Representative',
                'street' => 'Street',
                'village' => 'Village',
                'city' => 'City',
                'postal_code' => '00000',
                'district' => 'District',
                'province' => 'Province',
                'country' => 'Sri Lanka',
                'is_primary' => 1,
                'status' => 1,
                'created_at' => now(),
                'created_by' => 1,
            ]
        ]);
    }
}
