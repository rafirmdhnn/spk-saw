<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyAtributKriteriaColumnNameTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('atribut_kriteria', function(Blueprint $table) {
            $table->renameColumn('attribut_kriteria', 'atribut_kriteria');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('atribut_kriteria', function(Blueprint $table) {
            $table->renameColumn('atribut_kriteria', 'attribut_kriteria');
        });
    }
}
