<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRankingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rankings', function (Blueprint $table) {
            $table->foreignId('country_id')
                ->constrained('countries')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->foreignId('sport_id')
                ->constrained('sports')
                ->onDelete('cascade')
                ->onUpdate('cascade');

            $table->enum('rank', [1, 2, 3]);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('rankings');
    }
}
