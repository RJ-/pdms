<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFacultiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('faculties', function (Blueprint $table) {
            $table->increments('id');
            $table->string('employee_id')->unique();
            $table->string('password');
            $table->string('surname');
            $table->string('firstname');
            $table->string('middlename')->nullable();
            $table->string('email')->nullable();
            $table->date('birthdate')->nullable();
            $table->interger('acadrank_id')->nullable();
            $table->integer('college_id')->unsigned();
            $table->rememberToken()->nullable();
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
        Schema::dropIfExists('faculties');
    }
}
