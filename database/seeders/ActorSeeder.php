<?php

namespace Database\Seeders;

use App\Models\Actor;
use Illuminate\Database\Seeder;

class ActorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Actor::create([
            'name' => 'Tom Hanks',
            'gender' => 'male',
            'biography' => 'lorem ipsum',
            'date_of_birth' => '1956-07-09',
            'place_of_birth' => 'Concord, California, USA',
            'image_url' => 'https://image.tmdb.org/t/p/w500/9O7gLzmreU0nGkIB6K3BsJbzvNv.jpg',
            'popularity' => 8.5,
        ]);
    }
}
