@extends('times.tela.telas')
@section('parte')
    <title>Campeonatos</title>
    </head>
    <body>
        <hr>
        <h2 class="text-center">Campeonatos</h2>
        @if(session('mensagem'))
            <div class="alert alert-success text-center mt-4 mb-4 p-2">
                <p>{{session('mensagem')}}</p>
            </div>
        @endif

        <div class="mt-3 mb-4">
            
            <div class="col-8 m-auto">
                <div input-group class="card">
                    <div class="card-header text-left">{{ __('Pesquisar') }}</div>
                    <form
                        method = "POST"
                        action="{{route('campeonato.pesquisar')}}"
                        name="formBusca"
                        placeholder="Filtrar por"
                    >
                        @csrf
                        <div class="col-6 mx-auto">
                            <label for="slFormato" class="form-label">Formato</label>
                            <select id="slFormato" name="slFormato" class="form-select">
                                <option selected>Selecione...</option>
                                <option
                                value="PC" {{isset($formato)
                                    ? ($formato == 'PC' ? 'selected' : '')
                                    : ''}}
                                    >
                                    Pontos Corridos
                                </option>
                                <option value="CP" {{isset($formato) ? ($formato == 'CP' ? 'selected' : '') : ''}}>
                                    Copa
                                </option>
                                <option value="MM" {{isset($formato) ? ($formato == 'MM' ? 'selected' : '') : ''}}>
                                    Mata a mata
                                </option>
                            </select>
                        </div>

                        <div class="col-6 mx-auto">
                            <label for="inDataInicio" class="form-label">Periodo</label>
                            <div class="col-3 input-group">
                                <input
                                    type="date"
                                    class="form-control"
                                    name="inDataInicio"
                                    id="inDataInicio"
                                    value="{{isset($dtInicio) ? $dtInicio : null}}"
                                    placeholder="DD/MM/AAAA"
                                >
                                <label class="form-label">&nbsp&nbsp&nbsp&nbsp A &nbsp&nbsp&nbsp&nbsp</label>
                                <input
                                    type="date"
                                    class="form-control"
                                    name="inDataFim" id="inDataFim"
                                    value="{{isset($dtFim) ? $dtFim : null}}"
                                    placeholder="DD/MM/AAAA"
                                >
                            </div>
                        </div>
                        
                        <div class="col-6 mx-auto">
                            <label for="slTime" class="form-label">Time:</label>
                            <select name="slTime"  id="slTime" class="form-select">
                                <option selected>Selecione...</option>
                                @foreach($times as $time)
                                <option
                                value= {{$time['id']}} {{isset($slTime)
                                    ? ($slTime == $time['id'] ? 'selected' : '')
                                    : ''}}
                                    >
                                    {{$time['nome']}}
                                </option>
                                @endforeach
                            </select>
                        </div>
                        <div class="text-center mt-3 mb-4">
                            <button type="submit"class="btn btn-success">Pesquisar</button>
                        </div>
                    </form>
                </div>
            </div>
        <div>

        @if(!is_null(Auth::user()) && Auth::user()->hasAnyRole(['AdminCampeonato']))
            <div class="text-center mt-3 mb-4">
                <a href="{{route('campeonato.cadastrar')}}">
                    <button class="btn btn-success">Cadastrar</button>
                </a>
            </div>
        @endif

        <div class="col-8 m-auto">
            <table class="table text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Id</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Formato</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($campeonatos as $campeonato)
                        <tr>
                            <th scope="row">{{$campeonato->id}}</th>
                            <td>{{$campeonato->nome}}</td>
                            <td>{{$campeonato->formato}}</td>
                            <td>
                                <div input-group>
                                    <a href="{{url("campeonato/$campeonato->id")}}">
                                        <button class="btn btn-dark btn-size-120">Informações</button>
                                    </a>
                                    
                                    <a href="{{url("campeonato/$campeonato->id/partidas")}}">
                                        <button class="btn btn-dark btn-size-120">Partidas</button>
                                    </a>
                                </div>
                                
                                @if(!is_null(Auth::user()) && Auth::user()->hasAnyRole(['AdminCampeonato']))
                                    <div input-group>
                                        <a href="{{url("campeonato/$campeonato->id/edit")}}">
                                            <button class="btn btn-primary btn-size-120">Editar</button>
                                        </a>
                                
                                        <a href="{{url("#")}}">
                                            <button type="button" class="btn btn-danger btn-size-120">Excluir</button>
                                        </a>
                                    </div>
                                @endif
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    @endsection
