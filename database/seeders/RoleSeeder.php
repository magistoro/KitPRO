<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $role = new Role;
        $role->id = '1';
        $role->name = 'user';
        $role->timestamps = false;
        $role->save();

        $role = new Role;
        $role->id = '2';
        $role->name = 'manager';
        $role->timestamps = false;
        $role->save();
        
        $role = new Role;
        $role->id = '3';
        $role->name = 'admin';
        $role->timestamps = false;
        $role->save();
    }
}
