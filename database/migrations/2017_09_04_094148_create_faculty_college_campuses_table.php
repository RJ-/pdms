<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacultyCollegeCampusesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::create('college_campus_faculty', function (Blueprint $table) {
          $table->increments('id');

          $table->integer('faculty_id')->unsigned();
          $table->foreign('faculty_id')->references('id')->on('faculties');

          $table->integer('college_campus_id')->unsigned();
          $table->foreign('college_campus_id')->references('id')->on('college_campuses');
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
      Schema::dropIfExists('college_dean');
    }
}
