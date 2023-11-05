<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Laravel\Socialite\Facades\Socialite;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        $users =  User::create([

            'name' => 'Administrator',
            'first_name' =>'Admin',
            'middle_name' =>'admin',
            'last_name' =>'Administrator',
            'gender' =>'Male',
            'email' => 'Admin@gmail.com',
            'email_verified_at' => now(),
            'address' => 'Tacloban City',
            'contact_number' => '0955325345',
            'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
            'faculty_id' => 2,
            'authorize' => 'checked',
            'provider' => 'google',

        ]);

        $users -> assignRole('admin');
    }
}
