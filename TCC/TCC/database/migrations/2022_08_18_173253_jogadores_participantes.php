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
        Schema::create('jogadores_participantes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_time');
            $table->foreign('id_time')->references('id')->on('times');
            $table->unsignedBigInteger('id_campeonato');
            $table->foreign('id_campeonato')->references('id')->on('campeonatos')->onDelete('cascade');
            $table->unsignedBigInteger('id_jogador');
            $table->foreign('id_jogador')->references('id')->on('jogadores')->onDelete('cascade');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
};
