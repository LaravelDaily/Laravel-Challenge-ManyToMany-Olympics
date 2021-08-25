<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountrySportPivotTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (!Schema::hasTable('country_sport')) {
            Schema::create('country_sport', function (Blueprint $table) {
                $table->unsignedBigInteger('country_id');
                $table->unsignedBigInteger('sport_id');
                $table->unsignedTinyInteger('ranking');

                $table->primary(['country_id', 'sport_id']);

                $table->foreign('country_id')
                    ->references('id')->on('countries')
                    ->onDelete('cascade');

                $table->foreign('sport_id')
                    ->references('id')->on('sports')
                    ->onDelete('cascade');

                $table->timestamp('created_at')->useCurrent();
                $table->timestamp('updated_at')->useCurrent();
            });
        }
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
