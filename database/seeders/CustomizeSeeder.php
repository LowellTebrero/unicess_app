<?php

namespace Database\Seeders;

use App\Models\CustomizeAdminAccess;
use App\Models\CustomizeAdminInventory;
use App\Models\CustomizeAdminProposal;
use App\Models\CustomizeAdminUserData;
use App\Models\CustomizeUserAllProposal;
use App\Models\CustomizeUserInventory;
use App\Models\EvaluationStatus;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CustomizeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CustomizeAdminProposal::create(['number' => 1 ]);
        CustomizeAdminInventory::create(['number' => 1 ]);
        CustomizeAdminUserData::create(['number' => 1 ]);
        CustomizeUserAllProposal::create(['number' => 1 ]);
        CustomizeUserInventory::create(['number' => 1 ]);
        CustomizeUserInventory::create(['number' => 2 ]);
        EvaluationStatus::create(['status' => 'close' ]);

        for ($i = 0; $i < 7; $i++) {
            CustomizeAdminAccess::create(['status' => 'checked' ]);
        }

    }
}