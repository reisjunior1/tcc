@extends('times.tela.telas')


@section('parte')
<?php 
  $style = ($numeroTimes[0]['total']) >= $campeonato[0]['numeroTimes'] ? "pointer-events: none" : null;
  $disabled = ($numeroTimes[0]['total']) >= $campeonato[0]['numeroTimes'] ? "disabled" : null;
?>
  <title>Visualizar Campeonato</title>
  </head>
  <body>

<div class="conterner py-4">
@if(session('mensagem'))
    <div class="alert alert-danger text-center mt-4 mb-4 p-2 col-8 m-auto">
        <p>{{session('mensagem')}}</p>
    </div>
@endif
  <div class="mx-auto col-8 m-auto" style="width: 800px; height: 500px;">
    <div class="col-md-6">
        <label class="form-label">Nome: </label> {{$campeonato[0]['nome']}}
        <br>
        <label class="form-label">Formato: </label> {{$campeonato[0]['formato']}}
    </div>
    <div class="mx-auto" style="width: 800px; height: 500px;">
    <div class="col-md-12">
        <label class="form-label">Times Participantes: </label> {{$campeonato[0]['numeroTimes']}}
        <br>
        <label class="form-label">Perído: </label> {{$campeonato[0]['dataInicio']}} <label> a </label> {{$campeonato[0]['dataFim']}}
        <div class="text-center mt-3 mb-4">
          <a style= "<?php echo $style ?>" href="{{ route("campeonato.adicionarTime", ['idCampeonato' => $campeonato[0]['id']]) }}">
            <button type="button " class="btn btn-success" <?php echo $disabled ?>>Adicionar Time</button>
          </a>
        </div>
        @if(!empty($times))
          <div class="col-8 m-auto">
            <table class="table text-center">
              <thead class="thead-dark">
                <tr>
                  <th scope="col">Time</th>
                  <th scope="col">Nº de Jogadores</th>
                  <th scope="col">Ação</th>
                </tr>
              </thead>
              <tbody>
                @foreach($times as $time)
                  <tr>
                    <th scope="row">{{$time['nome']}}</th>
                    <?php var_dump($numeroJogadores, $time) ?>
                    <td>{{$numeroJogadores[$time['id']]}}</td>
                    <td>
                      <form id="submit-form" action={{route("campeonato.buscaJogadores")}} method='PUT' class="hidden">
                        @csrf
                        @method('PUT')                         
                        <input type="hidden" id="hdCampeonato" name="hdCampeonato" value="{{$campeonato[0]['id']}}">
                        <input type="hidden" id="slTime" name="slTime" value="{{$time['id']}}">
                        <input type="hidden" id="hdApagarDados" name="hdApagarDados" value="1">
                        <button type="submit" class="btn btn-primary">Editar</button>
                      </form>
                      <form id="submit-form" action={{route("campeonato.apagaTimesCampeonato")}} method='PUT' class="hidden">
                        @csrf
                        @method('PUT')                         
                        <input type="hidden" id="hdCampeonato" name="hdCampeonato" value="{{$campeonato[0]['id']}}">
                        <input type="hidden" id="slTime" name="slTime" value="{{$time['id']}}">
                        <input type="hidden" id="hdApagarDados" name="hdApagarDados" value="1">
                        <button type="submit" class="btn btn-danger">Deletar</button>
                      </form>

                    </td>
                  </tr>
                @endforeach
              </tbody>
            </table>
          </div>
        @else
          <br><label class="text-center">Não há times participando deste campeonato</label>
        @endif
    </div>

   @endsection
