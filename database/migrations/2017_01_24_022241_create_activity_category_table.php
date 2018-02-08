<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityCategoryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('activity_categories', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('pdactivity_id')->unsigned();
          $table->foreign('pdactivity_id')->references('id')->on('p_dactivities');

          $table->integer('category_id')->unsigned();
          $table->foreign('category_id')->references('id')->on('p_dcategories');
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('activity_categories');
    }
}
