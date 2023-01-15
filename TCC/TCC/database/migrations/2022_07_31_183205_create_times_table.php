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
        Schema::create('times', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('id_usuario');
            $table->string('sigla',5);
            $table->string('nome',100);
            $table->string('endereco',100);
            $table->String('cidade',100);
            $table->String('bairro',100);
            $table->String('complemento',100);
            $table->String('cep',8);
            $table->String('estado',100);
            //$table->unsignedBigInteger('id_local');
            //$table->foreign('idLocal')->references('id')->on('local');
            $table->timestamp('created_at')->useCurrent();
            $table->timestamp('updated_at')->useCurrent();
        });

        Schema::table('times', function($table) {
            $table->foreign('id_usuario')->references('id')->on('users');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('times');
    }
};
