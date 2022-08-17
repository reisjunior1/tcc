<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\usuario;
use App\Http\Requests\UsuarioRequest;




class CadastroUsuario extends Controller

{ 
    private $objUsuario;
    private $objTime;
    private $objCampeonato;


    public function __construct()
    {
        $this->objUsuario = new usuario();
        
    }



    public function index()
    {
        return view(view:'times.cadastrar');

    }

    public function cadastrar()
    {
        return view(view:'times.cadastrar');

    }
   





    public function store(UsuarioRequest $request)
    { //dd($request);
       // die();

        $cadastro=$this->objUsuario->create([
            'nome'=>$request->inNome,
            'cpf'=>$request->incpf,
            'email' => $request->inemail,
            'telefone' => $request->inTelefone,
            'tipo'=>$request->inTipo,
            'senha'=>$request->insenha
            ]);
            if($cadastro){
                return redirect('usuario');
            }




    }

}

