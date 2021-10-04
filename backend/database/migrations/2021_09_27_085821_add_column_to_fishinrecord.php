<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnToFishinrecord extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fishingrecords', function (Blueprint $table) {
            $table->dateTime('datetime')->nullable();
            $table->date('time')->nullable()->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fishingrecords', function (Blueprint $table) {
            $table->dropColumn('datetime');
            $table->date('time')->nullable(false)->change();
        });
    }
}
