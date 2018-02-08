<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFieldPdactivityTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('field_p_dactivity', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('p_dactivity_id')->unsigned();
          $table->foreign('p_dactivity_id')->references('id')->on('p_dactivities');

          $table->integer('field_id')->unsigned();
          $table->foreign('field_id')->references('id')->on('fields');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('field_p_dactivity');
    }
}
