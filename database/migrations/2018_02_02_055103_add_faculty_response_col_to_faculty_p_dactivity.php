<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddFacultyResponseColToFacultyPDactivity extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('faculty_p_dactivity', function (Blueprint $table) {
          $table->integer('faculty_response')->nullable()->after('status')->default(NULL);
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
          $table->dropColumn('faculty_response');
        });
    }
}
