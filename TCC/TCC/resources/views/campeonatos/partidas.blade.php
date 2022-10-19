@extends('times.tela.telas')

@section('parte')
  <title>Cadastro</title>
  </head>
  <body>

  <hr> <h2 class="text-center">Partidas</h2> <hr>
  @if(session('mensagem'))
    <div class="alert alert-success text-center mt-4 mb-4 p-2">
        <p>{{session('mensagem')}}</p>
    </div>
  @endif
  @if(isset($errors) && count($errors)>0)
    <div class="alert alert-danger text-center mt-4 mb-4 p-2">
        @foreach($errors->all() as $erro)
            {{$erro}}<br>
        @endforeach
    </div>
    @endif

<div class="text-center mt-3 mb-4">
<a href="{{route("campeonato.criarPartida", ['idCampeonato' => $idCampeonato])}}">
    <button class="btn btn-dark">Adicionar Partida</button>
</a>
    <div class="col-4 m-auto">
        @foreach($partidas as $partida)
            <?php
                if ($partida['status'] == 0){
                    $status = 'Não Iniciada';
                    $golsTimeCasa = '-';
                    $golsTimeVisitante = '-';
                    $href = route("campeonato.encerraPartida", ['idPartida' => $partida['id']]);
                    $btn = 'Encerrar Partida';
                } else {
                    $status = 'Encerrada';
                    $golsTimeCasa = $partida['gols_time_casa'];
                    $golsTimeVisitante = $partida['gols_time_visitante'];
                    $href = route("campeonato.editarResultado", ['idPartida' => $partida['id']]);
                    $btn = 'Editar Resultado';
                }
            ?>
            <table class="table text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Time1</th>
                        <th scope="col">Time2</th>
                        <th scope="col">Data</th>
                        <th scope="col">Local</th>
                        <th scope="col">Status</th>
                        <th scope="col">Resultado</th>
                        <th scope="col">Opções</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">{{$partida['timeCasa']}}</th>
                        <td>{{$partida['timeVisitante']}}</td>
                        <td>{{$partida['dataHora']}}</td>
                        <td>{{$partida['endereco']}}</td>
                        <td>{{$status}}</td>
                        <td>{{$golsTimeCasa . ' x '. $golsTimeVisitante}}</td>
                        <td>
                            <a href="{{route("campeonato.detalhesPartida", ['idPartida' => $partida['id']])}}">
                                <button class="btn btn-dark">Detalhes</button>
                            </a>
                            
                            <a href="{{route("campeonato.editarPartida", ['idCampeonato' => $partida['id']])}}">
                                <button class="btn btn-dark">Editar</button>
                            </a>
                            
                            <a href="{{route("campeonato.excluirPartida", ['idCampeonato' => $partida['id']])}}">
                                <button class="btn btn-dark">Excluir</button>
                            </a>
                           
                            <a href="{{$href}}">
                                <button class="btn btn-dark">{{$btn}}</button>
                            </a>
                        </td>
                    </tr>
                </tbody>
            </table>
        @endforeach
    </div>
</div>

   @endsection
