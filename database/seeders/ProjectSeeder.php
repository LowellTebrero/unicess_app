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

        for ($i = 0; $i < 200; $i++) { // Assuming you want to create 100 data
            $created_at = $faker->dateTimeThisYear();
            $updated_at = $faker->dateTimeThisYear();

            // Check if the current iteration is a multiple of 10
            if ($i % 10 == 0) {
                $created_at->modify('+' . rand(0, 11) . ' months');
                $created_at->modify('+' . rand(0, $created_at->format('t')) . ' days');

                $updated_at->modify('+' . rand(0, 11) . ' months');
                $updated_at->modify('+' . rand(0, $updated_at->format('t')) . ' days');
            }

            $projects =  Proposal::create([
                'uuid' => Str::random(7),
                'project_title' => $faker->sentence(),
                'program_id' => $faker->numberBetween(1, 8),
                'started_date' => $faker->dateTimeBetween('-1 year', 'now')->format('Y-m-d'),
                'finished_date' => $faker->dateTimeBetween('now', '+1 year')->format('Y-m-d'),
                'authorize' => $faker->randomElement(['pending', 'finished', 'ongoing']),
                'status' => $faker->randomElement(['active', 'inactive']),
                'created_at' => $created_at->format('Y-m-d H:i:s'),
                'updated_at' => $updated_at->format('Y-m-d H:i:s'),
                'user_id' => $faker->numberBetween(2,100),
            ]);

            for ($j = 0; $j < 10; $j++) {
            ProposalMember::create([
                'proposal_id' => $projects->id, // Set proposal_id to the newly created proposal's ID
                'user_id' => $faker->numberBetween(2,100), // Set user_id to the current tag (user's ID)
            ]);

            }

        }
    }
}
