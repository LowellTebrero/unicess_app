<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Proposal;
use Illuminate\Support\Str;
use Illuminate\Database\Seeder;
use App\Models\ProposalMember;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        for ($i = 0; $i < 10; $i++) { // Assuming you want to create 100 data


            $projects =  Proposal::create([
                'uuid' => Str::random(7),
                'project_title' => $faker->sentence(),
                'program_id' => $faker->numberBetween(1, 8),
                'colleges_name' => $faker->randomElement(['BSED', 'CAS', 'CME', 'COE','Graduate School']),
                'started_date' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
                'finished_date' => $faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
                'authorize' => $faker->randomElement(['pending', 'finished', 'ongoing']),
                'status' => $faker->randomElement(['active', 'inactive']),
                'status_check_at' => now()->addMonths(3),
                'user_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            for ($j = 0; $j < 10; $j++) {
            ProposalMember::create([
                'proposal_id' => $projects->id, // Set proposal_id to the newly created proposal's ID
                'user_id' => $faker->numberBetween(2,100), // Set user_id to the current tag (user's ID)
                'created_at' => now(),
                'updated_at' => now(),
            ]);

            }


        }
    }
}
