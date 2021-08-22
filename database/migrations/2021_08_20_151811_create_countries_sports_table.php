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
            $table->tinyInteger("medal");
            $table->foreignId("country_id")->constrained("countries");
            $table->foreignId("sport_id")->constrained("sports");
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
