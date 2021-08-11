<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddAlternatifIdToAlternatifsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('kriterias', function (Blueprint $table) {
            $table->unsignedInteger('alternatif_id')->after('id')->nullable();
            $table->foreign('alternatif_id')->references('id')->on('alternatifs')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('kriterias', function (Blueprint $table) {
            $table->dropForeign(['alternatif_id']);
            $table->dropColumn('alternatif_id');
        });
    }
}
