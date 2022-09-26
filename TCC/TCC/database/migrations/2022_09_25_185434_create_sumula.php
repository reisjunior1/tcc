<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('sumula', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_partida');
            $table->foreign('id_partida')->references('id')->on('partidas');
            $table->unsignedBigInteger('id_acao');
            $table->foreign('id_acao')->references('id')->on('acao');
            $table->unsignedBigInteger('id_time');
            $table->foreign('id_time')->references('id')->on('times');
            $table->string('minutos', 6)->nullable(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('sumula');
    }
};
