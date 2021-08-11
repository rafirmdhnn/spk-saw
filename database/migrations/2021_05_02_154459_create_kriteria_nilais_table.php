<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateKriteriaNilaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('kriteria_nilais', function (Blueprint $table) {
            $table->Increments('id');
            $table->unsignedInteger('kriteria_id')->nullable();
            $table->foreign('kriteria_id')->references('id')->on('kriterias')->onDelete('cascade');
            $table->string('kn_keterangan', 150)->nullable();
            $table->integer('kn_nilai')->nullable();
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });

        Schema::create('alternatif_nilais', function (Blueprint $table) {
            $table->Increments('id');
            $table->unsignedInteger('alternatif_id')->nullable();
            $table->foreign('alternatif_id')->references('id')->on('alternatifs')->onDelete('cascade');
            $table->unsignedInteger('kriteria_id')->nullable();
            $table->foreign('kriteria_id')->references('id')->on('kriterias')->onDelete('cascade');
            $table->unsignedInteger('nilai_kriteria_id')->nullable();
            $table->foreign('nilai_kriteria_id')->references('id')->on('kriteria_nilais')->onDelete('cascade');
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('kriteria_nilais');
        Schema::dropIfExists('alternatif_nilais');
    }
}
