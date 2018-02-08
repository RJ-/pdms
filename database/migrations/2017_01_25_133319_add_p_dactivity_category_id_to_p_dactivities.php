<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPDactivityCategoryIdToPDactivities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('p_dactivities', function (Blueprint $table) {
            $table->integer('p_dcategory_id')->after('title');
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
            $table->dropColumn('p_dcategory_id');
        });
    }
}
