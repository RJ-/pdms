<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacultyFieldTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('faculty_field', function (Blueprint $table) {
          $table->increments('id');
          $table->integer('faculty_id')->unsigned();
          $table->foreign('faculty_id')->references('id')->on('faculties');

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
        Schema::dropIfExists('faculty_field');
    }
}
