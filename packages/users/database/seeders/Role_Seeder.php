<?php

namespace Leo\Users\Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Leo\Users\Role;

class Role_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $roles=['admin','users'];
        foreach ($roles as $key => $value) {
            Role::create(['name'=>$value]);
        }
    }
}
