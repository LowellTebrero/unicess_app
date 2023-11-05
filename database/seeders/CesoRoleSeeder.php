<?php

namespace Database\Seeders;

use App\Models\CesoRole;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CesoRoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        CesoRole::create(['role_name' => 'Training Director/Coordinator']);
        CesoRole::create(['role_name' => 'Resource Speaker/Trainer']);
        CesoRole::create(['role_name' => 'Facilitator/Moderator']);
        CesoRole::create(['role_name' => 'Reactor/Panel member']);
        CesoRole::create(['role_name' => 'Technical Assistance/Consultancy']);
        CesoRole::create(['role_name' => 'Judge']);
        CesoRole::create(['role_name' => 'Commencement/Guest Speaker']);

    }
}
