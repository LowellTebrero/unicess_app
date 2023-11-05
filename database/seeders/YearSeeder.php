<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class YearSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $currentYear = Carbon::now()->year;
        $startYear = 1990; // Change this to the desired starting year

        // Loop through the years and insert records
        for ($year = $startYear; $year <= $currentYear; $year++) {
            DB::table('admin_years')->insert([
                'year' => $year,
            ]);
        }
    }
}
