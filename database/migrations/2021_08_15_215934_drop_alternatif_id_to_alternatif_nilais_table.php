<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class DropAlternatifIdToAlternatifNilaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('alternatif_nilais', function (Blueprint $table) {
            $table->dropForeign(['alternatif_id']);
            $table->dropColumn('alternatif_id');

            $table->unsignedBigInteger('user_id')->after('id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alternatif_nilais', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');

            $table->unsignedInteger('alternatif_id')->nullable();
            $table->foreign('alternatif_id')->references('id')->on('alternatifs')->onDelete('cascade');
        });
    }
}
