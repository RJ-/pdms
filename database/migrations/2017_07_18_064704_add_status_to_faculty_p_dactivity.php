<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddStatusToFacultyPDactivity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('faculty_p_dactivity', function (Blueprint $table) {
            $table->boolean('status')->nullable()->after('faculty_id');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('faculty_p_dactivity', function (Blueprint $table) {
            $table->dropColumn('status');
        });
    }
}
