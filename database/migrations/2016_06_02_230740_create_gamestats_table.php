<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateGamestatsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('gamestats', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->integer('wins');
            $table->integer('loses');
            $table->integer('draws');
            $table->integer('games_played');

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
        Schema::drop('gamestats');
    }
}
