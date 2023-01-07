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
            'cpf' => '12345678989',
            'name' => 'Janine',
            'telefone' => '(31) 99898-8888',
            'email' => 'janine@mail.com',
            'tipo' => '1',
            'password' => Hash::make('senha'),
        ])->roles()->attach(1);
    }
}
