<?php

namespace Database\Seeders;

use App\Models\ParticipationName;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ParticipationNameSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        ParticipationName::create(['participation_name' => 'Coordinator/Organizer/consultants' ]);
        ParticipationName::create(['participation_name' => 'Resource person/lecturer' ]);
        ParticipationName::create(['participation_name' => 'Facilitator' ]);
        ParticipationName::create(['participation_name' => 'Member' ]);

    }
}
