@extends('times.tela.telas')

@section('parte')
  <title>Atualizar Senha</title>
  </head>
  <body>
<form action={{route("campeonato.validaEncerrarPartida")}} method='PUT'>
  @csrf
<div class="conterner py-4">
@if(session('mensagem'))
    <div class="alert alert-danger text-center mt-4 mb-4 p-2">
        <p>{{session('mensagem')}}</p>
    </div>
@endif

  <div class="mx-auto" style="width: 800px;">
    <div class="col-md-6">
        <?php $i =0; ?>
        <input type="hidden" id="hdPartida" name="hdPartida" value="{{$idPartida}}">

        <label for="slAcao{{$i}}" class="form-label">Ação:</label>
        <select name="slAcao{{$i}}"  id="slAcao{{$i}}" class="form-select">
            <option selected>Selecione...</option>
            @foreach($acoes as $acao)
                <option value= {{$acao['id']}}>{{$acao['descricao']}}</option>
            @endforeach
        </select>

        <label for="slTime{{$i}}" class="form-label">Time:</label>
        <select name="slTime{{$i}}"  id="slTime{{$i}}" class="form-select">
            <option selected>Selecione...</option>
            @foreach($times as $time)
                <option value= {{$time['id']}}>{{$time['nome']}}</option>
            @endforeach
        </select>
    </div>
    <br>
    <div class="col-12">
      <button type="submit" class="btn btn-primary">Finalizar</button>
    </div>
  </div>
</form>

   @endsection
