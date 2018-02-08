<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateActivityFacultyTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faculty_p_dactivity', function (Blueprint $table) {
            $table->increments('id');

            $table->integer('p_dactivity_id')->unsigned();
            $table->foreign('p_dactivity_id')->references('id')->on('p_dactivities');

            $table->integer('faculty_id')->unsigned();
            $table->foreign('faculty_id')->references('id')->on('faculties');

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
        Schema::drop('faculty_p_dactivity');
    }
}
