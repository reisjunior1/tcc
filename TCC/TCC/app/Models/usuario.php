<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class usuario extends Model
{
    use HasFactory;

    protected $fillable = ['nome' ,'cpf', 'telefone', 'tipo', 'email', 'senha'];

    public function usuario()
    {
        return $this->belongsTo(usuario::class);
    }

    public function lstUsuarioPorId($idUsuario)
    {
        return usuario::where('id', '=', $idUsuario)
            ->get();
    }

    public function lstUsuarioPorEmail($email)
    {
        return usuario::where('email', '=', $email)
            ->get()->toArray();
    }

    public function lstUsuarioPorTelefone($telefone)
    {
        return usuario::where('telefone', '=', $telefone)
            ->get()->toArray();
    }

    public function getSenha($usuario, $senha){
        $user = usuario::where('senha', '=', $senha)
        ->where('id', '=', $usuario)
        ->get()->toArray();

        if(empty($user)){
            return false;
        }else{
            return true;
        }
    }

    public function upUsuario($id, $nome, $cpf, $telefone, $email)
    {
        usuario::where(['id'=>$id])->update([
            'nome'=>$nome,
            'cpf'=>$cpf,
            'telefone' => $telefone,
            'email' => $email
        ]);
        return true;

    }
}
