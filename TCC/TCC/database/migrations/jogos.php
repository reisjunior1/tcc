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
            $table->foreign('id_usuario')-> references('id')->on('usuario');
            $table->foreign('id_time')-> references('id')->on('time');
            $table->boolen('Eexcluido');
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
