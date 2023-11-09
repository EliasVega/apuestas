<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LotterySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('lotteries')->delete();

        DB::table('lotteries')->insert(array (
            0 =>
            array (
                'id' => 1,
                'code' => '1day',
                'name' => 'CUNDINAMARCA',
                'day' => 'lunes',
                'created_at' => '2023-01-12 21:07:42',
                'updated_at' => '2023-01-12 21:07:42'
            ),
            1 =>
            array (
                'id' => 2,
                'code' => '1day',
                'name' => 'TOLIMA',
                'day' => 'lunes',
                'created_at' => '2023-01-12 21:07:42',
                'updated_at' => '2023-01-12 21:07:42'
            ),
            2 =>
            array (
                'id' => 3,
                'code' => '1day',
                'name' => 'CRUZ ROJA',
                'day' => 'martes',
                'created_at' => '2023-01-12 21:07:42',
                'updated_at' => '2023-01-12 21:07:42'
            ),
            3 =>
            array (
                'id' => 4,
                'code' => '1day',
                'name' => 'HUILA',
                'day' => 'martes',
                'created_at' => '2023-01-12 21:07:42',
                'updated_at' => '2023-01-12 21:07:42'
            ),
            4 =>
            array (
                'id' => 5,
                'code' => '1day',
                'name' => 'MANIZALES',
                'day' => 'miercoles',
                'created_at' => '2023-01-12 21:07:42',
                'updated_at' => '2023-01-12 21:07:42'
            ),
            5 =>
            array (
                'id' => 6,
                'code' => '1day',
                'name' => 'VALLE',
                'day' => 'miercoles',
                'created_at' => '2023-01-12 21:07:42',
                'updated_at' => '2023-01-12 21:07:42'
            ),
            6 =>
            array (
                'id' => 7,
                'code' => '1day',
                'name' => 'META',
                'day' => 'miercoles',
                'created_at' => '2023-01-12 21:07:42',
                'updated_at' => '2023-01-12 21:07:42'
            ),
            7 =>
            array (
                'id' => 8,
                'code' => '1day',
                'name' => 'BOGOTA',
                'day' => 'jueves',
                'created_at' => '2023-01-12 21:07:42',
                'updated_at' => '2023-01-12 21:07:42'
            ),
            8 =>
            array (
                'id' => 9,
                'code' => '1day',
                'name' => 'QUINDIO',
                'day' => 'jueves',
                'created_at' => '2023-01-12 21:07:42',
                'updated_at' => '2023-01-12 21:07:42'
            ),
            9 =>
            array (
                'id' => 10,
                'code' => '1day',
                'name' => 'SANTANDER',
                'day' => 'viernes',
                'created_at' => '2023-01-12 21:07:42',
                'updated_at' => '2023-01-12 21:07:42'
            ),
            10 =>
            array (
                'id' => 11,
                'code' => '1day',
                'name' => 'MEDELLIN',
                'day' => 'viernes',
                'created_at' => '2023-01-12 21:07:42',
                'updated_at' => '2023-01-12 21:07:42'
            ),
            11 =>
            array (
                'id' => 12,
                'code' => '1day',
                'name' => 'RISARALDA',
                'day' => 'viernes',
                'created_at' => '2023-01-12 21:07:42',
                'updated_at' => '2023-01-12 21:07:42'
            ),
            12 =>
            array (
                'id' => 13,
                'code' => '1day',
                'name' => 'BOYACA',
                'day' => 'sabado',
                'created_at' => '2023-01-12 21:07:42',
                'updated_at' => '2023-01-12 21:07:42'
            ),
            13 =>
            array (
                'id' => 14,
                'code' => '1day',
                'name' => 'CAUCA',
                'day' => 'sabado',
                'created_at' => '2023-01-12 21:07:42',
                'updated_at' => '2023-01-12 21:07:42'
            ),
            14 =>
            array (
                'id' => 15,
                'code' => '7days',
                'name' => 'CULONA MAÑANA',
                'day' => 'todos',
                'created_at' => '2023-01-12 21:07:42',
                'updated_at' => '2023-01-12 21:07:42'
            ),
            15 =>
            array (
                'id' => 16,
                'code' => '7days',
                'name' => 'CULONA TARDE',
                'day' => 'todos',
                'created_at' => '2023-01-12 21:07:42',
                'updated_at' => '2023-01-12 21:07:42'
            ),
            16 =>
            array (
                'id' => 17,
                'code' => '7days',
                'name' => 'DORADO MAÑANA',
                'day' => 'todos',
                'created_at' => '2023-01-12 21:07:42',
                'updated_at' => '2023-01-12 21:07:42'
            ),
            17 =>
            array (
                'id' => 18,
                'code' => '7days',
                'name' => 'DORADO TARDE',
                'day' => 'todos',
                'created_at' => '2023-01-12 21:07:42',
                'updated_at' => '2023-01-12 21:07:42'
            ),
            18 =>
            array (
                'id' => 19,
                'code' => '7days',
                'name' => 'DORADO NOCHE',
                'day' => 'todos',
                'created_at' => '2023-01-12 21:07:42',
                'updated_at' => '2023-01-12 21:07:42'
            ),

        ));
    }
}
