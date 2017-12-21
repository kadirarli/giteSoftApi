<?php

use Illuminate\Database\Seeder;
use App\Comment;
use App\User;
use App\Movie;

class CommentsTableSeeder extends Seeder
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
        Comment::truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');

        // Faker
        $faker = \Faker\Factory::create();

        /*
        movie_id [required]
        name [required]
        comment [required]
        */

        // Create 1 comment per 1 movie
        $movies = Movie::all();
        $users = User::all()->toArray();
        foreach ($movies as $movie) {
            $comment = new Comment;
            $comment->movie_id = $movie->id;
            // Only registered users can post comments so i get name from users table.
            $comment->name = $users[array_rand($users)]['name'];
            $comment->comment = $faker->paragraph;
            $comment->save();
        }
    }
}