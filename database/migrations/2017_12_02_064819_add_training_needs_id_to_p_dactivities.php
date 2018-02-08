<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTrainingNeedsIdToPDactivities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
     public function up()
     {
         Schema::table('p_dactivities', function (Blueprint $table) {
             $table->integer('training_needs_id')->nullable()->after('p_dcategory_id');
         });
     }

     /**
      * Reverse the migrations.
      *
      * @return void
      */
     public function down()
     {
         Schema::table('p_dactivities', function (Blueprint $table) {
             $table->dropColumn('training_needs_id');
         });
     }
}
