<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProhibitedNumberSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('prohibited_numbers')->delete();

        DB::table('prohibited_numbers')->insert(array (
            0 =>
            array (
                'id' => 1,
                'number' => 1028,
                'created_at' => '2023-01-12 21:07:42',
                'updated_at' => '2023-01-12 21:07:42',
            ),
            1 =>
            array (
                'id' => 2,
                'number' => 1022,
                'created_at' => '2023-01-12 21:07:42',
                'updated_at' => '2023-01-12 21:07:42'
            ),
            2 =>
            array (
                'id' => 3,
                'number' => 1039,
                'created_at' => '2023-01-12 21:07:42',
                'updated_at' => '2023-01-12 21:07:42'
            ),
            3 =>
            array (
                'id' => 4,
                'number' => 5138,
                'created_at' => '2023-01-12 21:07:42',
                'updated_at' => '2023-01-12 21:07:42'
            ),
            4 =>
            array (
                'id' => 5,
                'number' => 1306,
                'created_at' => '2023-01-12 21:07:42',
                'updated_at' => '2023-01-12 21:07:42'
            )
        ));
    }
}
