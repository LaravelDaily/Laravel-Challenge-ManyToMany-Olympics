<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountrySportTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('country_sport', function (Blueprint $table) {
            $table->id();
            $table->timestamps();

            $table->unsignedBigInteger('sport_id');
            $table->unsignedBigInteger('country_id');
            $table->string('place');

            $table->foreign('sport_id')->references('id')->on('sports')
                ->onDelete('cascade');

            $table->foreign('country_id')->references('id')->on('countries')
                ->onDelete('cascade');
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
