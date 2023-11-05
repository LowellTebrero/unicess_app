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


        $this->call(RoleandPermissionSeeder::class);
        $this->call(ProgramSeeder::class);
        $this->call(FacultySeeder::class);
        $this->call(CesoRoleSeeder::class);
        $this->call(PartnerSeeder::class);
        $this->call(LocationSeeder::class);
        $this->call(ParticipationNameSeeder::class);
        $this->call(YearSeeder::class);
         $this->call(AdminSeeder::class);



    }
}
