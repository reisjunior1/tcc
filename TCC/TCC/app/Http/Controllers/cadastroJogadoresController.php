<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class cadastroJogadoresController extends Controller
{
    //
    private $objUsuario;
    private $objTime;
    private $objJpgadores;


    public function __construct()
    {
        
        $this->objJogaores = new jogador();
        
    }
    public function index()
    {
        return view(view:'times.jogadors');

    }



    public function cadastrarJogador ()
    {
     
     return view(view:'times.jogadors');
 
 
    }

    public function store(JogadoresRequest $request)
    { 
        $cadastro=$this->objjogadores->create([
           
 
           'nome'=>$request->inNome,
           'cpf'=>$request->insCpf,
           'telefone'=>$request->inTelefone,
           'nacimento'=>$request->inData,
           'email'=>$request->inEmail,
          



 
 
            ]);
            if($cadastro){
                return redirect('jogadors');
            }
 
 
            //$event->save();
 
    }
 
 


}
