@extends('times.tela.telas')

@section('parte')
    <title>Cadastro</title>
    </head>
    <body>
        <div class="text-center col-8 m-auto">
            <hr>
            <h2 class="text-center">Partidas</h2>
            <hr>

            @if(session('mensagem'))
                <div class="alert alert-success text-center mt-4 mb-4 p-2">
                    <p>{{session('mensagem')}}</p>
                </div>
            @endif

            @if(isset($errors) && count($errors)>0)
                <div class="alert alert-danger text-center mt-4 mb-4 p-2">
                    @foreach($errors->all() as $erro)
                        {{$erro}}
                        <br>
                    @endforeach
                </div>
            @endif

            @if(!is_null(Auth::user()) && Auth::user()->hasAnyRole(['AdminCampeonato']))
                <a href="{{route("campeonato.criarPartida", ['idCampeonato' => $idCampeonato])}}">
                    <button class="btn btn-success">Adicionar Partida</button>
                </a>
            @endif
        </div>

        <!-- tabelas partidas -->
        <div class="col-8 m-auto" style="overflow-x:auto;">
            @foreach($partidas as $partida)
                <?php
                    if ($partida['status'] == 0) {
                        $status = 'Não Iniciada';
                        $golsTimeCasa = '-';
                        $golsTimeVisitante = '-';
                        $href = route("campeonato.encerraPartida", ['idPartida' => $partida['id']]);
                        $btn = 'Encerrar Partida';
                        $propriedade = 'danger';
                    } else {
                        $status = 'Encerrada';
                        $golsTimeCasa = $partida['gols_time_casa'];
                        $golsTimeVisitante = $partida['gols_time_visitante'];
                        $href = route("campeonato.editarResultado", ['idPartida' => $partida['id']]);
                        $btn = 'Editar Sumula';
                        $propriedade = 'success';
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
                        <tr style="width:150px">
                            <th style="width:80px" scope="row">{{$partida['timeCasa']}}</th>
                            <td style="width:80px">{{$partida['timeVisitante']}}</td>
                            <td style="width:100px">{{$partida['dataHora']}}</td>
                            <td style="width:120px">{{$partida['endereco']}}</td>
                            <td style="width:80px">{{$status}}</td>
                            <td style="width:80px">{{$golsTimeCasa . ' x '. $golsTimeVisitante}}</td>
                            <td style="width:80px">
                                <div input-group>
                                    <a href="{{route("campeonato.detalhesPartida", ['idPartida' => $partida['id']])}}">
                                        <button class="btn btn-secondary btn-size-160">Detalhes</button>
                                    </a>
                                    @if(!is_null(Auth::user()) && Auth::user()->hasAnyRole(['AdminCampeonato']))
                                        @if($partida['status'] == 0)
                                            <a href="{{
                                                route("campeonato.editarPartida", ['idCampeonato' => $partida['id']])
                                            }}">
                                                <button class="btn btn-primary btn-size-160">Editar</button>
                                            </a>
                                        @endif
                                        
                                        <a href="{{$href}}">
                                            <button class="btn btn-{{$propriedade}} btn-size-160">{{$btn}}</button>
                                        </a>
                                    @endif
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            @endforeach
            </div>
    @endsection
