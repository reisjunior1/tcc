@extends('times.tela.telas')


@section('parte')
  <title>Visualizar Campeonato</title>
  </head>
  <body>

<div class="conterner py-4">

<form class="row g-7">
  <div class="mx-auto" style="width: 800px; height: 500px;">
    <div class="col-md-6">
        <label for="inNomeCampeonato" class="form-label">Nome: </label> {{$campeonato->nome}}
        <br>
        <label for="slFormato" class="form-label">Formato: </label> {{$campeonato->formato}}
    </div>
    <div class="mx-auto" style="width: 800px; height: 500px;">
    <div class="col-md-12">
        <label for="inNomeCampeonato" class="form-label">Times Participantes: </label>
        <br>
        <table class="table text-center">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Time</th>
            <th scope="col">Nº de Jogadores</th>
            <th scope="col">Ação</th>
        </tr>
        </thead>
        <tbody>
        </tbody>
        </table>
    </div>
    <br>

</form>



   @endsection
