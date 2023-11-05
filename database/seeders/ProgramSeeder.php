<?php

namespace Database\Seeders;

use App\Models\Program;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class ProgramSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Program::create(['program_name' => 'Physical Fitness & Sport Development' ]);
        Program::create(['program_name' => 'Information Communication & Education' ]);
        Program::create(['program_name' => 'Literacy, Numeracy & Languange Enhancement' ]);
        Program::create(['program_name' => 'Cultural Development' ]);
        Program::create(['program_name' => 'Livelihood Technical & Business Management' ]);
        Program::create(['program_name' => 'Environmental Conversation & Disaster Preparedness' ]);
        Program::create(['program_name' => 'Management & Leardership Development' ]);
        Program::create(['program_name' => 'Special Institute & Teaching Training Program' ]);
    }
}
