<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountriesSportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries_sports', function (Blueprint $table) {
            $table->id();

            $table->enum('place', [1, 2, 3]);

            $table->bigInteger('sport_id')->unsigned()->index();
            $table->foreign('sport_id')->references('id')->on('sports')->onDelete('cascade');

            $table->bigInteger('country_id')->unsigned()->index();
            $table->foreign('country_id')->references('id')->on('countries')->onDelete('cascade');

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
        Schema::dropIfExists('countries_sports');
    }
}
