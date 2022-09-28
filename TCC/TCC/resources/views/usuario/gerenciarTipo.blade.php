@extends('times.tela.telas')

@section('parte')
  <title>Atualizar Senha</title>
  </head>
  <body>
<form action={{route("usuario.validaTipoUsuario")}} method='PUT'>
  @csrf
<div class="conterner py-4">
@if(session('mensagem'))
    <div class="alert alert-danger text-center mt-4 mb-4 p-2">
        <p>{{session('mensagem')}}</p>
    </div>
@endif

  <div class="mx-auto" style="width: 800px;">
    <div class="col-md-6">
        <label for="slUsuario" class="form-label">Ação:</label>
        <select name="slUsuario"  id="slUsuario" class="form-select">
            <option selected>Selecione...</option>
            @foreach($usuarios as $usuario)
                <option value= {{$usuario['id']}}>{{$usuario['nome']}}</option>
            @endforeach
        </select>

        <label for="slTipo" class="form-label">Tipo:</label>
        <select name="slTipo"  id="slTipo" class="form-select">
            <option selected>Selecione...</option>
            <option value='UC'>Usuário Comum</option>
            <option value='AT'>Administrador Time</option>
            <option value='AC'>Administrador Campeonato</option>
        </select>

    </div>
    <br>
    <div class="col-12">
      <button type="submit" class="btn btn-primary">Finalizar</button>
    </div>
  </div>
</form>

   @endsection
