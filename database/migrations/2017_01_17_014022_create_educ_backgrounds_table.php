<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEducBackgroundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('educ_backgrounds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('faculty_id');
            $table->integer('educ_category_id');
            $table->string('course');
            $table->string('major');
            $table->string('school');
            $table->string('scholarship');
            $table->string('award');
            $table->string('yearstarted');
            $table->string('yeargraduated')->nullable();
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
        Schema::dropIfExists('educ_backgrounds');
    }
}
