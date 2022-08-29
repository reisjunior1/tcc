<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class TimesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //id_usuario	sigla	nome	id_local	
        DB::table('times')->insert([
            'id_usuario' => rand(0,10),
            'sigla' => Str::random(3),
            'nome' => Str::random(10),
            'id_local' => rand(0,1),
            'Eexcluido' => rand(0,0)
        ]);
    }
}
