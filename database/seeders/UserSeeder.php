<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
             'name' => 'amira' ,
             'password'=>1111,
             'role'=>'admin',
              'email'=>'amira@gmail.com',
              'points'=>0


        ]);  User::create([
             'name' => 'razi' ,
             'password'=>1111,
             'role'=>'admin',
              'email'=>'razi@gmail.com',
              'points'=>0


        ]);

    }
}
