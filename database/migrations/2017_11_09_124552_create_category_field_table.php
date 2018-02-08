<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCategoryFieldTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::create('category_field', function (Blueprint $table) {
           $table->increments('id');

           $table->integer('category_id')->unsigned();
           $table->foreign('category_id')->references('id')->on('categories');

           $table->integer('field_id')->unsigned();
           $table->foreign('field_id')->references('id')->on('fields');

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
         Schema::dropIfExists('category_field');
     }
}
