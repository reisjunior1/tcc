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
        Schema::create('jogos_amistosos', function (Blueprint $table) {
           /* $table->id();

            $table->unsignedBigInteger('id_time_visitante');
            $table->foreign('id_time_visitante')->references('id')->on('times');
            $table->unsignedBigInteger('id_time_casa');
            $table->foreign('id_time_casa')->references('id')->on('times');
            $table->timestamp('dataHora');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
            $table->unsignedBigInteger('id_local');
            $table->foreign('id_local')->references('id')->on('local');


            $table->timestamps();*/

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('jogos_amistosos');
    }
};
