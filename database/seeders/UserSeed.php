<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('users')->insert([
            'number_id' => '1093221111',
            'name' => 'David',
            'last_name' => 'Torres',
            'email' => 'fernando.zapata.live@gmail.com',
            'password' => bcrypt(123456789),
        ]);
    }
}