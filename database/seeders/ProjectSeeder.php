<?php

namespace Database\Seeders;

use Faker\Factory;
use App\Models\Proposal;
use Carbon\Carbon;
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

        $startDate = Carbon::create(2024, 1, 1, 0, 0, 0); // January 1, 2024
        $endDate = Carbon::create(2024, 4, 5, 0, 0, 0); // April 5, 2024

        for ($i = 0; $i < 100; $i++) { // Assuming you want to create 100 data

            $createdAt = $faker->dateTimeBetween($startDate, $endDate)->format('Y-m-d H:i:s');
            $updatedAt = $faker->dateTimeBetween($startDate, $endDate)->format('Y-m-d H:i:s');

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
                'user_id' => $faker->numberBetween(2, 100),
                'created_at' => $createdAt,
                'updated_at' => $updatedAt,
            ]);

            for ($j = 0; $j < 10; $j++) {
            ProposalMember::create([
                'proposal_id' => $projects->id, // Set proposal_id to the newly created proposal's ID
                'user_id' => $faker->numberBetween(2,100), // Set user_id to the current tag (user's ID)
                'created_at' => $createdAt,
                'updated_at' => $updatedAt,
            ]);

            }


        }
    }
}
