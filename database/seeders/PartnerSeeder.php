<?php

namespace Database\Seeders;

use App\Models\Partner;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class PartnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Partner::create(['partners_name' => 'Archdiocese of Palo' ]);
        Partner::create(['partners_name' => 'Palo Metropolitan Cathedral Our Lords Transfiguration Parish' ]);
        Partner::create(['partners_name' => 'Our Lady of Guadalupe Parish' ]);
        Partner::create(['partners_name' => 'Department of Education (DepEd) Regional Office 8, Candahug, Palo, Leyte' ]);
        Partner::create(['partners_name' => 'Department of Education (DepEd), Leyte Division, Candahug, Palo, Leyte' ]);
        Partner::create(['partners_name' => 'Department of Education (DepEd) City Division, Tacloban City' ]);
        Partner::create(['partners_name' => 'Department of Education (DepEd) Southern Leyte Division' ]);
        Partner::create(['partners_name' => 'Department of Education (DepEd) Biliran Division' ]);
        Partner::create(['partners_name' => 'Dr. Banez Memorial Elementary School' ]);
        Partner::create(['partners_name' => 'Sagkahan National High School' ]);
        Partner::create(['partners_name' => 'Hannam University, South Korea' ]);
        Partner::create(['partners_name' => 'St. John the Evangelist School of Theology' ]);
        Partner::create(['partners_name' => 'Naval Institute of Technology' ]);
        Partner::create(['partners_name' => 'Department of Social Welfare Development Region 08' ]);
        Partner::create(['partners_name' => 'Department of Science and Technology' ]);
        Partner::create(['partners_name' => 'Department of Agrarian Reform, Biliran, Biliran' ]);
        Partner::create(['partners_name' => 'Commission on Audit' ]);
        Partner::create(['partners_name' => 'PhilHealth 08']);
        Partner::create(['partners_name' => 'Foster Parents Plan, Inc. (Plan Philippines)' ]);
        Partner::create(['partners_name' => 'Junior Chamber International Tacloban' ]);
        Partner::create(['partners_name' => 'Local Government Unit of the Municipality of Sta. Fe, Leyte' ]);
        Partner::create(['partners_name' => 'LGU of Barangay Katipunan, Sta. Fe, Leyte' ]);
        Partner::create(['partners_name' => 'Office of the An-Waray Party List Representative to the House of Congress' ]);
        Partner::create(['partners_name' => 'Local Government Unit of the Municipality of Palo, Leyte' ]);
        Partner::create(['partners_name' => 'LGU of Barangay Cavite East, Palo, Leyte' ]);
        Partner::create(['partners_name' => 'Local Government Unit of Tacloban City' ]);
        Partner::create(['partners_name' => 'LGU of Barangay Diit, Tacloban City' ]);
        Partner::create(['partners_name' => 'LGU of Sto. Nino, Tacloban City' ]);
        Partner::create(['partners_name' => 'House of Senate, Manila' ]);
        Partner::create(['partners_name' => 'City Prosecutors Office, Tacloban City' ]);
        Partner::create(['partners_name' => 'Region 08 Medical Association' ]);
        Partner::create(['partners_name' => 'EVRMC Hospital' ]);
        Partner::create(['partners_name' => 'Medical Representative of Region 08 (Unilab, Pfizer, Glaxo, etc.)' ]);
        Partner::create(['partners_name' => 'An Waray Center for Youth Development' ]);
    }
}
