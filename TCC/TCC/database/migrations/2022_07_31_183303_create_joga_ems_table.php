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
            $table->unsignedBigInteger('id_usuario');
            $table->foreign('id_jogador')-> references('id')->on('jogadores');
            $table->unsignedBigInteger('id_time');
            $table->foreign('id_time')-> references('id')->on('times');
            $table->integer('Eexcluido')->nullable(false);
            $table->timestamp('criado-em')->useCurrent();
            $table->timestamp('atualizado-em')->useCurrent();
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
