<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMovieGenresTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        /*
        movie_id [required]
        genre_id [required]
        */
        Schema::create('movie_genres', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('movie_id')->unsigned()->nullable(false);
            $table->integer('genre_id')->unsigned()->nullable(false);
            $table->timestamps();
        });

        Schema::table('movie_genres', function($table) {
            $table->foreign('movie_id')->references('id')->on('movies')->onDelete('cascade');
            $table->foreign('genre_id')->references('id')->on('genres')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movie_genres');
    }
}
