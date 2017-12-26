<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // seed countries
        $path = 'countries.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('Countries table seeded!');

        // seed genres
        $path = 'genres.sql';
        DB::unprepared(file_get_contents($path));
        $this->command->info('Genres table seeded!');

        // seed users
        $this->call(UsersTableSeeder::class );
        $this->command->info('Users table seeded!');

        // seed movies
        $this->call(MoviesTableSeeder::class );
        $this->command->info('Movies table seeded!');

        // seed comments
        $this->call(CommentsTableSeeder::class );
        $this->command->info('Comments table seeded!');
    }
}
