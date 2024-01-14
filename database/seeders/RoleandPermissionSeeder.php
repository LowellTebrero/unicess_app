<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class RoleandPermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Permission::create(['name' => 'create-user']);
        Permission::create(['name' => 'edit-user']);
        Permission::create(['name' => 'delete-user']);

        Permission::create(['name' => 'create-proposal']);
        Permission::create(['name' => 'edit-proposal']);
        Permission::create(['name' => 'delete-proposal']);

        $adminRole = Role::create(['name' => 'admin']);
        $editorRole = Role::create(['name' => 'College extension coordinator']);
        $editorRole = Role::create(['name' => 'Faculty ']);
        $editorRole = Role::create(['name' => 'Student ']);
        $editorRole = Role::create(['name' => 'Extension Staff ']);

        Role::create(['name' => 'New User']);
        Role::create(['name' => 'Partners/Linkages']);

        $adminRole->givePermissionTo([
            'create-user',
            'edit-user',
            'delete-user',
            'create-proposal',
            'edit-proposal',
            'delete-proposal',
        ]);

        $editorRole->givePermissionTo([
            'create-proposal',
            'edit-proposal',
            'delete-proposal',
        ]);
    }


    }

