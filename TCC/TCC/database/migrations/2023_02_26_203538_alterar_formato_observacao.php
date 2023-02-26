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
        //Schema::table('local', function (Blueprint $table) {
        //    $table->string('cep', 9)->nullable(false)->change();

        Schema::table('partidas', function (Blueprint $table) {
            $table->string('observacao', 500)->nullable(true)->after('gols_time_visitante')->change();
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
