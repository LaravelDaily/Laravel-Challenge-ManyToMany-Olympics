<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCountryMedalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('country_medals', function (Blueprint $table) {
            $table->id();
            $table->timestamps();
            $table->integer('sports_id')->unsigned();
            $table->integer('gold')->unsigned()->nullable()->default(0);
            $table->integer('silver')->unsigned()->nullable()->default(0);
            $table->integer('bronze')->unsigned()->nullable()->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('country_medals');
    }
}
