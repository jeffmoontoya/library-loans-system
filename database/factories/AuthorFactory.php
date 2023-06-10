<?php

namespace Database\Factories;

use App\Models\Book;
use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\Author;

class AuthorFactory extends Factory
{

    protected $model = Author::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'biography' => $this->faker->paragraph(),
        ];
    }

    public function configure()
    {
        return $this->afterCreating(function (Author $author) {
            Book::factory(8)->AuthorId($author)->create();
        });
    }
}
