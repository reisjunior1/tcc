@extends('times.tela.telas')

@section('parte')

    <title>Cadastro</title>
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

        <div class="col-4 m-auto">
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
                <label for="slTimeCasa" class="form-label">Selecione o Time mandante*</label>
                <select name="slTimeCasa"  id="slTimeCasa" class="form-select">
                    <option selected>Selecione...</option>
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

                <label for="slTimeVizitante" class="form-label">Selecione o Time visitante*</label>
                <select name="slTimeVizitante"  id="slTimeVizitante" class="form-select">
                    <option selected>Selecione...</option>
                    @foreach($times as $time)
                        <option value= {{
                            $time['id']}} {{isset($dados['slTimeVizitante'])
                                ?($dados['slTimeVizitante'] == $time['id'] ? 'selected' : '')
                                : ''
                            }}>{{$time['nome']}}
                        </option>
                    @endforeach
                </select>

                <label for="slLocal" class="form-label">Selecione o Local*</label>
                <select name="slLocal"  id="slLocal" class="form-select">
                    <option selected>Selecione...</option>
                    @foreach($locais as $local)
                        <option value= {{$local['id']}} {{isset($dados['slLocal'])
                            ? ($dados['slLocal'] == $local['id'] ? 'selected' : '')
                            : ''}}
                        >
                            {{$local['endereco']}}
                        </option>
                    @endforeach
                </select>

                <label for="inData" class="form-label">Data*</label>
                <input
                    type="date"
                    class="form-control"
                    name="inData"
                    id="inData"
                    value="{{isset($dados['inData']) ? $dados['inData'] : null}}"
                    placeholder="DD/MM/AAAA"
                >

                <label for="inHora" class="form-label">Hora*</label>
                <input
                    type="text"
                    class="form-control hora"
                    name="inHora"
                    id="inHora"
                    value="{{isset($dados['inHora']) ? $dados['inHora'] : null}}"
                    placeholder="Hora de início"
                >
        
                <input type="hidden" id="hdIdCampeonato" name="hdIdCampeonato" value={{$idCampeonato}}>
        </div>
        <div input-group class="col-4 m-auto">
            <?php $botao = 'Cadastrar'; ?>
            @if(isset($partida) && $partida[0]['status'] == 0)
            <?php $botao = 'Salvar'; ?>
            <a href="{{route("campeonato.excluirPartida", ['idCampeonato' => $partida[0]['id']])}}">
                <button type="button" class="btn btn-danger btn-size-90-margin-top">Excluir</button>
            </a>
            @endif
            <button type="submit" class="btn btn-success btn-size-90-margin-top">{{$botao}}</button>
        </div>
    </form>

@endsection