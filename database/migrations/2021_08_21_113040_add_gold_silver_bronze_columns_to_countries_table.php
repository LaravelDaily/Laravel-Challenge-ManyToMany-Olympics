<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddGoldSilverBronzeColumnsToCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->integer("count_gold", unsigned:true)->default(0);
            $table->integer("count_silver",unsigned:true)->default(0);
            $table->integer("count_bronze",unsigned:true)->default(0);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('countries', function (Blueprint $table) {
            $table->dropColumn("count_gold");
            $table->dropColumn("count_silver");
            $table->dropColumn("count_bronze");
        });
    }
}
