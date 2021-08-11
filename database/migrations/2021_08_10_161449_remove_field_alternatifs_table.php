<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveFieldAlternatifsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('alternatifs', function (Blueprint $table) {
            $table->dropColumn(['alternatif_image','alternatif_harga','alternatif_ukuran_layar','alternatif_baterai','alternatif_storage','alternatif_kamera','alternatif_ram','alternatif_keterangan']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('alternatifs', function (Blueprint $table) {
            $table->string('alternatif_image')->after('alternatif_nama')->nullable();
            $table->string('alternatif_harga')->after('alternatif_image')->nullable();
            $table->string('alternatif_ukuran_layar')->after('alternatif_harga')->nullable();
            $table->string('alternatif_baterai')->after('alternatif_ukuran_layar')->nullable();
            $table->string('alternatif_storage')->after('alternatif_baterai')->nullable();
            $table->string('alternatif_kamera')->after('alternatif_storage')->nullable();
            $table->string('alternatif_ram')->after('alternatif_kamera')->nullable();
            $table->string('alternatif_keterangan')->after('alternatif_ram')->nullable();
        });
    }
}
