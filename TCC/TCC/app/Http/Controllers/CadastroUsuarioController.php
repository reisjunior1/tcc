<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\usuario;
use App\Http\Requests\UsuarioRequest;




class CadastroUsuarioController extends Controller

{ 
    private $objUsuario;



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
            'cpf'=>$request->inCpf,
            'email' => $request->inEmail,
            'telefone' => $request->inTelefone,
            'tipo'=>$request->inTipo,
            'senha'=>$request->inSenha
            ]);
            if($cadastro){
                return redirect('usuario');
            }
    }

    public function update(Request $request, $id)
    {
        if (session_status() !== PHP_SESSION_ACTIVE ){
            session_start();
        }
        
        $modelUsuario = new usuario();
        $modelUsuario->upUsuario(
            $id,
            $request->inNome,
            $request->inCpf,
            $request->inTelefone,
            $request->inEmail
        );
        
        $usuario = $this->objUsuario->find($_SESSION['dados']['id']);
        session()->flash('mensagem', "Os dados do usuário foram atualizados!");
        return view('times/cadastrar', compact('usuario'));
        //return redirect('usuario');
    }

}

