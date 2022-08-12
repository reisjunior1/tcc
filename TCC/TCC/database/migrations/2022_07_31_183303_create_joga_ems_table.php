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
        Schema::create('joga_em', function (Blueprint $table) {
            $table->id();
            //$table->unsignedBigInteger('id_jogador');
            //$table->foreign('idJogador')->references('id')->on('jogadores');
            $table->unsignedBigInteger('id_time');
            $table->tinyInteger('Eexcluido')->nullable(false);
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });

        Schema::table('joga_em', function($table) {
            //$table->foreign('id_jogador')->references('id')->on('jogador');
        });

        Schema::table('joga_em', function($table) {
            $table->foreign('id_time')->references('id')->on('times');
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('joga_em');
    }
};
