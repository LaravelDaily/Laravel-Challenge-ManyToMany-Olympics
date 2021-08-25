<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable('sports')) {
            Schema::table('sports', function (Blueprint $table){
                $table->index(['name']);
            });
        }

        if (Schema::hasTable('countries')) {
            Schema::table('countries', function (Blueprint $table){
                $table->index(['short_code']);
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
        Schema::table('sports', function (Blueprint $table){
            $table->dropIndex(['name']);
        });
        Schema::table('countries', function (Blueprint $table){
            $table->dropIndex(['short_code']);
        });
    }
}
