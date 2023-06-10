<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CategorySeed extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {   
        //1
        DB::table('categories')->insert([
            'name' => 'Terror',
        ]);
        //2
        DB::table('categories')->insert([
            'name' => 'Comedia',
        ]);
        //3
        DB::table('categories')->insert([
            'name' => 'Autos',
        ]);
        
    }
}
