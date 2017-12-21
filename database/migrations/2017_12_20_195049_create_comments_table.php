<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCommentsTable extends Migration
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
        name [required]
        comment [required]
        */
        Schema::create('comments', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('movie_id')->unsigned()->nullable(false);
            $table->string('name')->nullable(false); // If only registered users can post comments, this (name) column may not be added. Because i have name column at users table.
            $table->text('comment')->nullable(false);
            $table->timestamps();
        });

        Schema::table('comments', function($table) {
            $table->foreign('movie_id')->references('id')->on('movies')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('comments');
    }
}
