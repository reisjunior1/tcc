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
        Schema::table('partidas', function (Blueprint $table) {
            $table->integer('id_arbrito')->nullable(true)->after('gols_time_visitante');
            $table->integer('id_auxiliar1')->nullable(true)->after('id_arbrito');
            $table->integer('id_auxiliar2')->nullable(true)->after('id_auxiliar1');
            $table->integer('id_mesario')->nullable(true)->after('id_auxiliar2');
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
