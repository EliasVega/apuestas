<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        //$this->call(IndicatorsTableSeeder::class);
        $this->call(RoleSeeder::class);
        $this->call(DepartmentsTableSeeder::class);
        $this->call(MunicipalitiesTableSeeder::class);
        $this->call(CompaniesTableSeeder::class);
        $this->call(IndicatorTableSeeder::class);
        $this->call(UsersTableSeeder::class);
        $this->call(LotterySeeder::class);
        $this->call(ProhibitedNumberSeeder::class);
    }
}
