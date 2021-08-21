<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePivotCountrySportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('country_sport', function (Blueprint $table) {
           $table->foreignId('country_id')->references('id')->on('countries');
           $table->foreignId('sport_id')->references('id')->on('sports');
           $table->foreignId('first')->references('id')->on('countries')->nullable();
           $table->foreignId('second')->references('id')->on('countries')->nullable();
           $table->foreignId('third')->references('id')->on('countries')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('country_sport');
    }
}
