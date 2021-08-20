<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesPlaceBySports extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries_place_by_sports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('sport_id');
            $table->unsignedTinyInteger("place");
            $table->timestamps();
            $table->foreign('country_id')->references('id')->on('countries');
            $table->foreign('sport_id')->references('id')->on('sports');
            $table->unique(["sport_id", "place"])->unique();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('countries_place_by_sports');
    }
}
