<?php

namespace Leo\Users\Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Leo\Users\Models\User;
use Leo\Users\Role;

class User_Seeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $idRole=Role::where('name','admin')->value('id');
        $user=[
            'name'=>'admin',
            'email'=>'admin@gmail.com',
            'phone'=>'',
            'password'=>Hash::make(111),
            'idRole'=>$idRole
        ];
        User::create($user);
    }
}
