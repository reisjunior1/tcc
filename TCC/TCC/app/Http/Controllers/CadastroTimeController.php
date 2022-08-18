<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\time;
class CadastroTimeController extends Controller
{
    //

    private $objUsuario;
    private $objTime;
    

    public function __construct()
    {
        //O erro está aqui
        $this->objTime = new time();
        
    }
    public function index()
    {
        return view(view:'times.time');

    }







   public function cadastrarTimes ()
   {
    //var_dump('entrou'); die();
    return view(view:'times.times');


   }


   public function store(TimeRequest $request)
   { //dd($request);
      // die();
       $cadastro=$this->objTime->create([
           'nome'=>$request->innome,
           'sigla'=>$request->insigla,
           'endereco'=>$request->inendereco,
           'cidade'=>$request->incidade,
           'bairro'=>$request->inbairro,
          'complemento'=>$request->incomplemento,
          'cep'=>$request->incep,
          'estado'=>$request->slestado

          //'id_usuario'=> $request->


           ]);
           if($cadastro){
               return redirect('time');
           }




   }




}
