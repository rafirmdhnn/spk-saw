<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterTableAlternatifNilaisForeignKey extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('alternatif_nilais', function (Blueprint $table){
            $table->foreign('nilai_kriteria_id')->references('id')->on('kriteria_nilais')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alternatif_nilais', function (Blueprint $table){
            $table->dropForeign('alternatif_nilais_nilai_kriteria_id_foreign');
        });
    }
}
