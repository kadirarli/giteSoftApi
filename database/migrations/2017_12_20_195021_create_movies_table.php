<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateMoviesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
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

        Schema::create('movies', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable(false);
            $table->text('description')->nullable(false);
            $table->date('release_date')->nullable(false);
            $table->tinyInteger('rating')->nullable(false); // this will be between 1-5
            $table->float('ticket_price', 8, 2)->nullable(false);
            $table->integer('country_id')->unsigned()->nullable(false);
            $table->string('photo')->nullable(false);
            $table->string('slug')->nullable(false);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('movies');
    }
}
