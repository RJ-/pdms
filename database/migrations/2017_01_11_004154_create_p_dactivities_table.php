<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePDactivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('p_dactivities', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title');
            $table->string('venue');
            $table->string('sponsor');
            $table->string('dateFrom');
            $table->string('dateTo');
            $table->text('details');
            $table->string('budget')->nullable();
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
        Schema::dropIfExists('p_dactivities');
    }
}
