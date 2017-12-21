<?php

use Illuminate\Database\Seeder;
use App\Movie;
use App\Country;
use App\Genre;

class MoviesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Truncate our existing records.
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        Movie::truncate();
        DB::table('movie_genres')->delete();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Faker
        $faker = \Faker\Factory::create();

        $movieNames = [
            'The Shawshank Redemption',
            'The Godfather',
            'The Godfather: Part II',
            'The Dark Knight',
            '12 Angry Men',
            'Schindler\'s List',
            'Pulp Fiction',
            'The Lord of the Rings: The Return of the King',
            'The Good, the Bad and the Ugly',
            'Fight Club'
        ];

        /*
        name [required]
        description [required]
        release_date [required]
        rating [required, 1 to 5]
        ticket_price [required]
        country_id [required]
        photo [required]
        slug [required]
        */

        // Create 3 movies
        for ($i = 0; $i < 3; $i++) {
            $movie = new Movie;
            $moviesNameExampleKey = array_rand($movieNames);
            $filmName = $movieNames[$moviesNameExampleKey];
            unset($movieNames[$moviesNameExampleKey]);
            $movie->name = $filmName;
            $movie->description = $faker->paragraph;
            $movie->release_date = $faker->date('Y-m-d H:i:s', 'now');
            $movie->rating = $faker->numberBetween(1,5);
            $movie->ticket_price = $faker->randomFloat(2,0, 100);
            $countries = Country::all()->toArray();
            $movie->country_id = $countries[array_rand($countries)]['id'];
            $movie->photo = $faker->imageUrl(640, 480, null, true, 'Gite Soft');
            $movie->slug = str_slug($filmName);
            $movie->save();
            //insert genres for movies
            $genres = Genre::all()->toArray();
            $genresCount = rand(1,5);
            // I used DB class, because i didn't create Movie Genres Class. (movie_denres is a pivot table)
            for ($j = 0; $j < $genresCount; $j++){
                DB::table('movie_genres')->insert(array(
                    array('movie_id'=>$movie->id,'genre_id'=>$genres[array_rand($genres)]['id']),
                ));
            }
        }
    }
}
