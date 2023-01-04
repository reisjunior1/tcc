<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\Permission\Traits\HasRoles;

class usuario extends Model
{
    use HasFactory;
    use HasRoles;

    protected $fillable = ['nome' ,'cpf', 'telefone', 'tipo', 'email', 'senha'];

    public function usuario()
    {
        return $this->belongsTo(usuario::class);
    }

    public function lstUsuario()
    {
        return usuario::get()->toArray();
    }

    public function lstUsuarioPorId($idUsuario)
    {
        return usuario::where('id', '=', $idUsuario)
            ->get()->toArray();
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

    public function upSenha($idUsuario, $novaSenha)
    {
        usuario::where(['id'=>$idUsuario])->update([
            'senha'=>$novaSenha
        ]);
        return true;
    }

    public function upTipo($idUsuario, $tipo)
    {
        usuario::where(['id'=>$idUsuario])->update([
            'tipo'=>$tipo
        ]);
        return true;
    }
}
