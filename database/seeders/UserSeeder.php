<?php

namespace Database\Seeders;

use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'photo' => null,
            'email_verified_at' => now(),
            'password' => Hash::make('123456789'),
            'remember_token' => null,
            'created_at' => now(),
            'updated_at' => now(),
        ]);


    }
}
