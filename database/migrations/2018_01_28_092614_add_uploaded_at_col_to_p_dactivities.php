<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddUploadedAtColToPDactivities extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('p_dactivities', function (Blueprint $table) {
            $table->string('uploaded_at')->nullable()->after('file');
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
            $table->dropColumn('uploaded_at');
        });
    }
}
