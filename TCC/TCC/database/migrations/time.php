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
        Schema::create('time', function (Blueprint $table) {
            $table->id();
            $table->foreign('id_usuario')->references('id')->on('usuario');
            $table->string('nome',100);
            $table->boolen('Eexcluido');
            $table->date('nacimento');
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
        Schema::dropIfExists('failed_jobs');
    }
};
