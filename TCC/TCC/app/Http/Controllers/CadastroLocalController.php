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
        $this->objLocal = new local();
        $this->middleware('auth');
        $this->middleware(['role:AdminTime|AdminGeral']);
    }

    public function index()
    {
        $modelLocal = new local();
        $locais = $modelLocal->lstLocais();
        return view('times/listaLocais', compact('locais'));
    }

    public function cadastrarLocal($idLocal = null)
    {
        $modelLocal = new local();
        $local = $modelLocal->lstLocalPorid($idLocal);
        $id = null;
        if (!empty($local)) {
            $id = $local[0]['id'];
        }
        return view('times/local', compact('local', 'id'));
    }

    public function store(LocalRequest $request)
    {
        dd($request);
        $cadastro=$this->objLocal->create([
            'nome'=>$request->inNome,
            'endereco'=>$request->inEndereco,
            'cidade'=>$request->inCidade,
            'bairro'=>$request->inBairro,
            'complemento'=>$request->inComplemento,
            'numero'=>$request->inNumero,
            'cep'=>$request->inCep,
            'estado'=>$request->slEstado,
            'Eexcluido'=>0
        ]);
        if($cadastro){
            return redirect('local');
        }
    }

    public function update(LocalRequest $request, $id)
    {
        $this->objLocal->where(['id'=>$id])->update([
            'nome'=>$request->inNome,
            'endereco'=>$request->inEndereco,
            'cidade'=>$request->inCidade,
            'bairro'=>$request->inBairro,
            'complemento'=>$request->inComplemento,
            'numero'=>$request->inNumero,
            'cep'=>$request->inCep,
            'estado'=>$request->slEstado,
            'Eexcluido'=>0
        ]);
        session()->flash('mensagem', "O local $request->inNome foi editado!");
        return redirect('local');
    }

    public function ativarDesativar($idLocal)
    {
        $modelLocal = new local();
        $local = $modelLocal->lstLocalPorid([$idLocal]);
        //dd($local);
        $nomeLocal = $local[0]['nome'];
        if ($local[0]['Eexcluido'] == 0) {
            $this->objLocal->where(['id'=>$idLocal])->update([
                'Eexcluido' => 1,
            ]);
            session()->flash('mensagem', "O $nomeLocal foi desativado!");
            return redirect('local');
        } else {
            $this->objLocal->where(['id'=>$idLocal])->update([
                'Eexcluido' => 0,
            ]);
            session()->flash('mensagem', "O $nomeLocal foi ativado!");
            return redirect('local');
        }
    }

}
