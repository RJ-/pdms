<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacultyTrainingNeedsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('faculty_training_needs', function (Blueprint $table) {
          $table->increments('id');

          $table->integer('faculty_id')->unsigned();
          $table->foreign('faculty_id')->references('id')->on('faculties');

          $table->integer('training_needs_id')->unsigned();
          $table->foreign('training_needs_id')->references('id')->on('training_needs');
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
        Schema::dropIfExists('faculty_training_needs');
    }
}
