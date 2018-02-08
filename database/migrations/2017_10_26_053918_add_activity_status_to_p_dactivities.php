<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddActivityStatusToPDactivities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('p_dactivities', function (Blueprint $table) {
            $table->integer('activity_status')->nullable()->after('title')->default('0');
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
            $table->dropColumn('activity_status');
        });
    }
}
