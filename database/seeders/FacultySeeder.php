<?php

namespace Database\Seeders;

use App\Models\Faculty;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class FacultySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {


        Faculty::create(['name' => 'BSHM - Hospitaly Management Unit' ]);
        Faculty::create(['name' => 'BSTM - Tourism Management Unit' ]);
        Faculty::create(['name' => 'Entrepreneurship Unit' ]);
        Faculty::create(['name' => 'Library and Information Science Unit' ]);
        Faculty::create(['name' => 'BA Comm Unit' ]);
        Faculty::create(['name' => 'Social Work Unit' ]);
        Faculty::create(['name' => 'NSTP Unit' ]);
        Faculty::create(['name' => 'Language and Literature Unit' ]);
        Faculty::create(['name' => 'IT and Computer Education Unit' ]);
        Faculty::create(['name' => 'MAPE/PEHM/Humanities Unit' ]);
        Faculty::create(['name' => 'BSED - Mathematics Unit' ]);
        Faculty::create(['name' => 'BSED - Science Unit' ]);
        Faculty::create(['name' => 'BSED - Filipino Unit' ]);
        Faculty::create(['name' => 'BSED - Social Studies' ]);
        Faculty::create(['name' => 'BSED - Values' ]);
        Faculty::create(['name' => 'BSED - San Isidro External Campus' ]);
        Faculty::create(['name' => 'BTLED - Technology Livelihood Education' ]);
        Faculty::create(['name' => 'BSNE-Special Needs Education Unit' ]);
        Faculty::create(['name' => 'BPEd - Physical Education Unit' ]);
        Faculty::create(['name' => 'BECEd - Early Childhood Education Unit' ]);
        Faculty::create(['name' => 'BEEd - Elementary Education Unit' ]);
    }
}
