<?php

namespace Database\Seeders;
use \App\Models\User;
use App\Models\Author;
use Database\Seeders\CategorySeed;
use Database\Seeders\UserSeed;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeed::class,
            CategorySeed::class
        ]);

        User::factory(100)->create();
        Author::factory(100)->create();
    }
}
