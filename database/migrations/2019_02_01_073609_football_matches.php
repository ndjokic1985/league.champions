<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class FootballMatches extends Migration
{

    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('football_matches', function (Blueprint $table) {
            $table->increments('id');
            $table->string('leagueTitle');
            $table->tinyInteger('matchDay');
            $table->string('group');
            $table->string('homeTeam');
            $table->string('awayTeam');
            $table->dateTime('kickoffAt');
            $table->string('score');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('football_matches');
    }
}
