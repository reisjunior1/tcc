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
        Schema::table('joga_em', function (Blueprint $table) {
            $table->unsignedBigInteger('id_jogador')->after('id');
            $table->foreign('id_jogador')->references('id')->on('jogadores');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('joga_em', function (Blueprint $table) {
            //
        });
    }
};
