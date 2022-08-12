<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\usuario;





class CadastroUsuario extends Controller
{ 
    private $objUsuario;
    private $objTime;
    private $objCampeonato;


    public function __construct()
    {
        $this->objUsuario = new usuario();
        
    }

    //

    public function cadastrar()
    {
        return view(view:'times.cadastrar');

    }

    public function store(UsuarioRequest $request)
    {
        $cadastro=$this->objUsuario->create([
            'nome'=>$request->innome,
            'cpf'=>$request->incpf,
            'email' => $request->inemail,
            'telefone' => $request->intelefone,
            'tipo'=>$request->intipo,
            'senha'=>$request->insenha
            ]);
            if($cadastro){
                return redirect('usuario');
            }




    }

}

