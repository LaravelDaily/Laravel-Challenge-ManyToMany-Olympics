<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountrySportsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('country_sports', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("country_id");
            $table->unsignedBigInteger("sport_id");
            $table->foreign("country_id")->references('id')->on("countries");
            $table->foreign("sport_id")->references('id')->on("sports");
            $table->integer('place');
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
        Schema::dropIfExists('country_sports');
    }
}
