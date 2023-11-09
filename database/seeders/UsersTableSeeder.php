<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'id' => 1,
            'name' => 'ELIAS VEGA DELGADO',
            'number' => '91260182',
            'email' => 'discom.is@gmail.com',
            'email_verified_at' => NULL,
            'password' => bcrypt('matrix2012'),
            'two_factor_secret' => NULL,
            'two_factor_recovery_codes' => NULL,
            'two_factor_confirmed_at' => NULL,
            'remember_token' => NULL,
            'current_team_id' => NULL,
            'profile_photo_path' => NULL,
            'status' => 'active',
            'company_id' => 1,
            'created_at' => '2023-01-12 21:07:43',
            'updated_at' => '2023-01-12 21:07:43'

        ])->assignRole(1);

        User::create([
            'id' => 2,
            'name' => 'Prins dos',
            'number' => '91260183',
            'email' => 'prinsdos@gmail.com',
            'email_verified_at' => NULL,
            'password' => bcrypt('prins2'),
            'two_factor_secret' => NULL,
            'two_factor_recovery_codes' => NULL,
            'two_factor_confirmed_at' => NULL,
            'remember_token' => NULL,
            'current_team_id' => NULL,
            'profile_photo_path' => NULL,
            'status' => 'active',
            'company_id' => 1,
            'created_at' => '2023-01-12 21:07:43',
            'updated_at' => '2023-01-12 21:07:43'

        ])->assignRole(2);

        User::create([
            'id' => 3,
            'name' => 'Prins tres',
            'number' => '91260184',
            'email' => 'prinstres@gmail.com',
            'email_verified_at' => NULL,
            'password' => bcrypt('prins3'),
            'two_factor_secret' => NULL,
            'two_factor_recovery_codes' => NULL,
            'two_factor_confirmed_at' => NULL,
            'remember_token' => NULL,
            'current_team_id' => NULL,
            'profile_photo_path' => NULL,
            'status' => 'active',
            'company_id' => 1,
            'created_at' => '2023-01-12 21:07:43',
            'updated_at' => '2023-01-12 21:07:43'

        ])->assignRole(3);

        User::create([
            'id' => 4,
            'name' => 'Prins cuatro',
            'number' => '91260185',
            'email' => 'prinscuatro@gmail.com',
            'email_verified_at' => NULL,
            'password' => bcrypt('prins4'),
            'two_factor_secret' => NULL,
            'two_factor_recovery_codes' => NULL,
            'two_factor_confirmed_at' => NULL,
            'remember_token' => NULL,
            'current_team_id' => NULL,
            'profile_photo_path' => NULL,
            'status' => 'active',
            'company_id' => 1,
            'created_at' => '2023-01-12 21:07:43',
            'updated_at' => '2023-01-12 21:07:43'

        ])->assignRole(4);

        User::create([
            'id' => 5,
            'name' => 'Prins cinco',
            'number' => '91260186',
            'email' => 'prinscinco@gmail.com',
            'email_verified_at' => NULL,
            'password' => bcrypt('prins5'),
            'two_factor_secret' => NULL,
            'two_factor_recovery_codes' => NULL,
            'two_factor_confirmed_at' => NULL,
            'remember_token' => NULL,
            'current_team_id' => NULL,
            'profile_photo_path' => NULL,
            'status' => 'active',
            'company_id' => 1,
            'created_at' => '2023-01-12 21:07:43',
            'updated_at' => '2023-01-12 21:07:43'

        ])->assignRole(5);
    }
}
