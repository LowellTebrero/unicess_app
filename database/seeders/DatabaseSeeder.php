<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\ParticipationName;
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
        $this->call([
            CustomizeSeeder::class,
            RoleandPermissionSeeder::class,
            ProgramSeeder::class,
            FacultySeeder::class,
            YearSeeder::class,
            AdminSeeder::class,
            ProjectSeeder::class,
        ]);
    }
}