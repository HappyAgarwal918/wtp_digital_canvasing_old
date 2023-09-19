<?php

namespace Database\Seeders;

use App\Models\User;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\User::factory(10)->create();

        // \App\Models\User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        User::create([
            'first_name' => 'Chris',
            'last_name' => 'Handel',
            'birthday' => '2021-05-07 11:45:55',
            'gender' => 'm',
            'phone' => '7143499150',
            'email' => 'chrishandel@protonmail.com',
            'last_4_ssn' => '4321',
            'street_address' => '8548 W Spnoara St',
            'city' => 'Tolleson',
            'State' => 'AZ',
            'zipcode' => '85353',
            'voter_id' => '1234567',
            'username' => 'chandsel',
            'password' => bcrypt('Special1'),
        ]);
    }
}
