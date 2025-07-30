<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class DeductionsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('deductions')->insert([
            [
                'name' => 'PAYE',
                'amount' => 30,
                'is_percentage' => true,
                'is_statutory' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'NHIF',
                'amount' => 500, // Will be calculated dynamically
                'is_percentage' => false,
                'is_statutory' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Housing Levy',
                'amount' => 1.5,
                'is_percentage' => true,
                'is_statutory' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'NSSF',
                'amount' => 6, // Tier II percentage
                'is_percentage' => true,
                'is_statutory' => true,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Service Charge',
                'amount' => 1000,
                'is_percentage' => false,
                'is_statutory' => false,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
