<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            GenreSeeder::class,
            ActorSeeder::class,
            MovieSeeder::class,
            UserSeeder::class,
            UserMovieSeeder::class,
            ActorMovieSeeder::class,
        ]);
    }
}
