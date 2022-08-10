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
        Schema::create('times_participantes', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_time');
            $table->foreign('id_time')-> references('id')->on('times');
            $table->unsignedBigInteger('id_campeonato');
            $table->foreign('id_campeonato')-> references('id')->on('campeonatos');
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
        //
    }
};
