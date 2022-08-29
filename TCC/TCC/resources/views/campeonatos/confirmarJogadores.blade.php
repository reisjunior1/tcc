@extends('times.tela.telas')

@section('parte')
  <title>@if(isset($campeonato)) Editar @else Cadastrar @endif</title>
  </head>
  <body>

<form action={{route("campeonato.salvaTimesJogadoresCampeonato")}} method='PUT'>
    @csrf
    <div class="conterner py-4">
    @if(isset($errors) && count($errors)>0)
        <div class="alert alert-danger text-center mt-4 mb-4 p-2">
            @foreach($errors->all() as $erro)
                {{$erro}}<br>
            @endforeach
        </div>
    @endif
        <div class="mx-auto" style="width: 800px;">
            <div class="col-md-6">
                <input type="hidden" id="hdCampeonato" name="hdCampeonato" value="{{$campeonato[0]->id}}">
                <input type="hidden" id="hdTime" name="hdTime" value="{{$time[0]['id']}}">
                <input type="hidden" id="hdApagarDados" name="hdApagarDados" value="{{$apagarDados}}">
                <label 
                    for="slTime" class="form-label">Selecione os jogadores que iram disputar o campeonato 
                    <b>{{$campeonato[0]['nome']}}</b> pelo time <b>{{$time[0]['nome']}}</b>*
                </label>
                @foreach($jogadores as $jogador)
                    <input type="checkbox" checked id=ckJogador name=ckJogador[] value={{$jogador['id']}}>
                    <label for={{$jogador['id']}}> {{$jogador['nome']}} </label><br>
                @endforeach
            </div>
            <br>
            <div class="col-12">
                <button type="submit" class="btn btn-success">Confirmar</button>
            </div>
        </div>
    </div>
</form>

@endsection
