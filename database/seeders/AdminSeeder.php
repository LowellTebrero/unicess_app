<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\User;
use Faker\Generator as Faker;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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

        // $users =  User::create([
        //     'name' => 'Administrator',
        //     'first_name' =>'CesoAdmin',
        //     'middle_name' =>'CesoAdmin',
        //     'last_name' =>'Administrator',
        //     'gender' =>'Male',
        //     'email' => 'Admin@gmail.com',
        //     'email_verified_at' => now(),
        //     'address' => 'Tacloban City',
        //     'contact_number' => '0955325345',
        //     'password' => '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', // password
        //     'faculty_id' => 2,
        //     'authorize' => 'checked',
        //     'provider' => 'google',

        // ]);

        // $users->assignRole('admin');

        $faker = Factory::create();

            $roles = ['College extension coordinator', 'Faculty ', 'Student', 'Extension Staff '];

            foreach (range(1, 100) as $index) {
                $gender = $faker->randomElement(['male', 'female']);
                $role = $faker->randomElement($roles);

                $users =  User::create([
                    'name' => $faker->name,
                    'first_name' => $faker->firstName($gender),
                    'middle_name' => $faker->lastName,
                    'last_name' => $faker->lastName,
                    'gender' => $gender,
                    'email' => $faker->unique()->safeEmail,
                    'email_verified_at' => now(),
                    'address' => $faker->address,
                    'contact_number' => $faker->phoneNumber,
                    'password' => bcrypt('password'), // You can customize the default password
                    'faculty_id' => $faker->numberBetween(1, 21),
                    'authorize' => 'checked',
                    'provider' => 'google',
                    'city' => 'Tacloban City',
                    'created_at' => now(),
                    'updated_at' => now(),
                ]);

                 $users -> assignRole($role);

        }


     }
}
