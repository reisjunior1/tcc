@extends('times.tela.telas')

@section('parte')

    <title>@if(isset($partida)) Editar Partida @else Cadastrar Partida @endif</title>
    </head>
    <body>
        <div class="text-center mt-3 mb-4">
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
        </div>

        <div class="col-10 m-auto">
            @if(isset($partida))
                <form
                    method = "PUT"
                    action="{{ route("campeonato.editaPartida", ['idPartida' => $partida[0]['id']]) }}" name="formBusca"
                    placeholder="Filtrar por"
                >
            @else
                <form
                    method = "PUT"
                    action="{{ route("campeonato.salvaPartida", ['idCampeonato' => $idCampeonato]) }}" name="formBusca"
                    placeholder="Filtrar por"
                >
            @endif

                @csrf
                <div class="col-10 m-auto">
                    <div input-group class="card">
                        <div class="card-header text-left">{{ isset($partida) ? 'Editar Partida' : 'Cadastrar Partida' }}</div>

                            <div class="col-6 mx-auto">
                                <label for="slTimeCasa" class="form-label">Selecione o Time mandante*</label>
                                <select
                                    name="slTimeCasa"
                                    id="slTimeCasa"
                                    class="form-select"
                                    required
                                >
                                <?php if(isset($idTime)){
                                    
                                    $dados['slTimeCasa']=$idTime;

                                    
                                }
                                
                                ?>
                                    <option value="">Selecione...</option> 
                                   
                                    @foreach($times as $time)
                                    <option
                                    value = {{
                                        $time['id']}} {{isset($dados['slTimeCasa'])
                                            ? ($dados['slTimeCasa'] == $time['id'] ? 'selected' : '')
                                            : ''
                                        }}>
                                        {{$time['nome']}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-6 mx-auto">
                                <label for="slTimeVizitante" class="form-label">Selecione o Time visitante*</label>
                                <select
                                    name="slTimeVizitante"
                                    id="slTimeVizitante"
                                    class="form-select"
                                    required
                                >
                                    <option value="">Selecione...</option>
                                @foreach($times as $time)
                                    <option value= {{
                                        $time['id']}} {{isset($dados['slTimeVizitante'])
                                            ?($dados['slTimeVizitante'] == $time['id'] ? 'selected' : '')
                                            : ''
                                        }}>{{$time['nome']}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                                
                            <div class="col-6 mx-auto">
                                <label for="slLocal" class="form-label">Selecione o Local*</label>
                                <select
                                    name="slLocal"
                                    id="slLocal"
                                    class="form-select"
                                    required
                                >
                                    <option value="" selected>Selecione...</option>
                                    @foreach($locais as $local)
                                        <option value= {{$local['id']}} {{isset($dados['slLocal'])
                                            ? ($dados['slLocal'] == $local['id'] ? 'selected' : '')
                                            : ''}}
                                        >
                                            {{$local['nome']}}
                                        </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-6 mx-auto">
                                <label for="inData" class="form-label">Data*</label>
                                <input
                                type="date"
                                class="form-control"
                                name="inData"
                                id="inData"
                                value="{{isset($dados['inData']) ? $dados['inData'] : null}}"
                                placeholder="DD/MM/AAAA"
                                required
                                >
                            </div>

                            <div class="col-6 mx-auto">
                                <label for="inHora" class="form-label">Hora*</label>
                                <input
                                    type="text"
                                    class="form-control hora"
                                    name="inHora"
                                    id="inHora"
                                    value="{{isset($dados['inHora']) ? $dados['inHora'] : null}}"
                                    placeholder="Hora de início"
                                    required
                                >
                            </div>

                            <div class="col-6 mx-auto">
                                <label for="slArbrito" class="form-label">Selecione o Arbrito</label>
                                <select name="slArbrito"  id="slArbrito" class="form-select">
                                    <option value="0" selected>Selecione...</option>
                                @foreach($arbritos as $arbrito)
                                    <option value= {{
                                        $arbrito['id']}} {{isset($dados['slArbrito'])
                                            ?($dados['slArbrito'] == $arbrito['id'] ? 'selected' : '')
                                            : ''
                                        }}>{{$arbrito['nome']}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-6 mx-auto">
                                <label for="slAuxiliar1" class="form-label">Selecione o Primeiro Auxiliar</label>
                                <select name="slAuxiliar1"  id="slAuxiliar1" class="form-select">
                                    <option value="0" selected>Selecione...</option>
                                @foreach($arbritos as $arbrito)
                                    <option value= {{
                                        $arbrito['id']}} {{isset($dados['slAuxiliar1'])
                                            ?($dados['slAuxiliar1'] == $arbrito['id'] ? 'selected' : '')
                                            : ''
                                        }}>{{$arbrito['nome']}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-6 mx-auto">
                                <label for="slAuxiliar2" class="form-label">Selecione o Segundo Auxiliar</label>
                                <select name="slAuxiliar2"  id="slAuxiliar2" class="form-select">
                                    <option value="0" selected>Selecione...</option>
                                @foreach($arbritos as $arbrito)
                                    <option value= {{
                                        $arbrito['id']}} {{isset($dados['slAuxiliar2'])
                                            ?($dados['slAuxiliar2'] == $arbrito['id'] ? 'selected' : '')
                                            : ''
                                        }}>{{$arbrito['nome']}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-6 mx-auto">
                                <label for="slMesario" class="form-label">Selecione o Mesário</label>
                                <select name="slMesario"  id="slMesario" class="form-select">
                                    <option value="0" selected>Selecione...</option>
                                @foreach($arbritos as $arbrito)
                                    <option value= {{
                                        $arbrito['id']}} {{isset($dados['slMesario'])
                                            ?($dados['slMesario'] == $arbrito['id'] ? 'selected' : '')
                                            : ''
                                        }}>{{$arbrito['nome']}}
                                    </option>
                                    @endforeach
                                </select>
                            </div>
                    
                            <input type="hidden" id="hdIdCampeonato" name="hdIdCampeonato" value={{$idCampeonato}}>
                            <input type="hidden" id="hdFormato" name="hdFormato" value={{$formato}}>
                            <input type="hidden" id="hdGrupo" name="hdGrupo" value={{$grupo}}>

                            
                            <div input-group class="my-auto mx-auto">
                                <?php $botao = 'Cadastrar'; ?>
                                @if(isset($partida) && $partida[0]['status'] == 0)
                                <?php $botao = 'Salvar'; ?>
                                <a href="{{route("campeonato.excluirPartida", ['idPartida' => $partida[0]['id']])}}">
                                    <button type="button" class="btn btn-danger btn-size-90-10-margin">Excluir</button>
                                </a>
                                @endif
                                <button type="submit" class="btn btn-success btn-margin-top-botton">{{$botao}}</button>
                            </div>
                    </div>
                </div>
            </form>
        </div>

@endsection