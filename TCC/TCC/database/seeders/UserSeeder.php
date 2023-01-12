<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'cpf' => '12345678999',
            'name' => 'Jean',
            'telefone' => '(31) 99898-8888',
            'email' => 'jean2@mail.com',
            'tipo' => '3',
            'password' => Hash::make('senha'),
        ])->roles()->attach(3);
    }
}
