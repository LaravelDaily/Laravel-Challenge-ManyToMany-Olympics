<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedalsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medals', function (Blueprint $table) {
            $table->foreignId('country_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();
            $table->foreignId('sport_id')
                ->constrained()
                ->cascadeOnUpdate()
                ->cascadeOnDelete();

            foreach (\App\Models\Medal::NAMES as $name) {
                $table->integer($name)->default(0);
            }

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
        Schema::dropIfExists('medals');
    }
}
