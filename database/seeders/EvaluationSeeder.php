<?php

namespace Database\Seeders;

use Faker\Factory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;
use App\Models\Evaluation;

class EvaluationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $faker = Factory::create();

        for ($i = 0; $i < 100; $i++) {

            Evaluation::create([
                'uuid' => Str::random(7),
                'user_id' => $faker->numberBetween(2,100),
                'faculty_id' => $faker->numberBetween(1,8),
                'period_of_evaluation' => '2024-2025',
                'chairmanship_university' => $faker->numberBetween(1,20),
                'chairmanship_college' => $faker->numberBetween(1,12),
                'membership_university' => $faker->numberBetween(1,12),
                'membership_college' => $faker->numberBetween(1,12),
                'advisorship' => $faker->numberBetween(1,12),
                'oic' => $faker->numberBetween(1,12),
                'judge' => $faker->numberBetween(1,12),
                'total_points' => $faker->numberBetween(20,30),
            ]);

        }
    }
}