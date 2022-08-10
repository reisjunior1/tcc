@extends('times.tela.telas')


@section('parte')
  <title>Visualizar Campeonato</title>
  </head>
  <body>
<?php var_dump($campeonato[0]["id"]); //die();?>
<div class="conterner py-4">
<form class="row g-7">
  <div class="mx-auto" style="width: 800px; height: 500px;">
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
          <a href="{{route('campeonato.adicionarTime', ['id' => $campeonato[0]['id']])}}">
            <button class="btn btn-success">Adicionar Time</button>
          </a>
        </div>
        @if(!empty($times))
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
                  <td>qtd</td>
                  <td>acao</td>
                  <td>
                </tr>
            @endforeach
            </tbody>
            </table>
        @else
          <br><label class="text-center">Não há times participando deste campeonato</label>
        @endif
    </div>
</form>


   @endsection
