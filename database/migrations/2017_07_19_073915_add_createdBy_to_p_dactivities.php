<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCreatedByToPDactivities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        $value = "0";
        Schema::table('p_dactivities', function (Blueprint $table) {
            $table->integer('createdBy')->nullable()->after('id')->default($value);
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
            $table->dropColumn('createdBy');
        });
    }
}
