<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\local;
use App\Http\Requests\LocalRequest;



class CadastroLocalController extends Controller
{
    //
 //

 private $objUsuario;
 private $objLocal;
 

 public function __construct()
 {
     //O erro 
     $this->objLocal = new local();
     
 }
 public function index()
 {
     return view(view:'times.local');

 }







public function cadastrarLocal ()
{
 //var_dump('entrou'); die();
 return view(view:'times.local');


}


public function store(LocalRequest $request)
{ //dd($request);
   // die();
    $cadastro=$this->objTime->create([
        'nome'=>$request->innome,
        'endereco'=>$request->inendereco,
        'cidade'=>$request->incidade,
        'bairro'=>$request->inbairro,
       'complemento'=>$request->incomplemento,
       'cep'=>$request->incep,
       'estado'=>$request->slestado

       //'id_usuario'=> $request->


        ]);
        if($cadastro){
            return redirect('local');
        }


        //$event->save();

}






}
