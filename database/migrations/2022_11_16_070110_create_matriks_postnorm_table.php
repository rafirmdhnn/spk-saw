<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMatriksPostnormTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('matriks_postnorm', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('user_id');
            $table->double('c1');
            $table->double('c2');
            $table->double('c3');
            $table->double('c4');
            $table->double('c5');
            $table->double('c6');
            $table->double('c7');
            $table->double('c8');
            $table->double('c9');
            $table->double('c10');
            $table->double('c11');
            $table->double('c12');
            $table->double('c13');
            $table->double('c14');
            $table->double('c15');
            $table->double('c16');
            $table->double('c17');
            $table->double('c18');
            $table->double('c19');
            $table->double('c20');
            $table->double('c21');
            $table->timestamps();

            $table->foreign('user_id')->references('id')->on('user')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('matriks_postnorm');
    }
}
