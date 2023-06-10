@extends('times.tela.telas')

@section('parte')
	<title>Pesquisar Papeis</title>
	</head>
	<body>
    <div class="col-8 m-auto">
                <div input-group class="card">
                    <div class="card-header text-left">{{ __('Pesquisar') }}</div>
                    <form
                        method = "POST"
                        action="{{route('usuario.pesquisarPapel',['pesquisar' => '1'])}}"
                        name="formBusca"
                        placeholder="Filtrar por"
                    >
                        @csrf
                        <div class="col-6 mx-auto">
                            <label for="slUsuario" class="form-label">Usuario:</label>
                            <select name="slUsuario"  id="slUsuario" class="form-select">
                                <option value="0" selected>Selecione...</option>
                                @foreach($usuarios as $usuario)
                                <option
                                value= {{$usuario['id']}} {{isset($dados['slUsuario'])
                                    ? ($dados['slUsuario'] == $usuario['id'] ? 'selected' : '')
                                    : ''}}
                                    >
                                    {{$usuario['name']}}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="col-6 mx-auto">
                            <label for="slPapel" class="form-label">Papel:</label>
                            <select name="slPapel"  id="slPapel" class="form-select">
                                <option value="0" selected>Selecione...</option>
                                @foreach($papeis as $papel)
                                    <option
                                        value= {{$papel['name']}} {{isset($dados['slPapel'])
                                                    ? ($dados['slPapel'] == $papel['name'] ? 'selected' : '')
                                                    : ''
                                                }}
                                    >{{$papel['name']}}</option>
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
        
        <div class="text-center mt-3 mb-4">
            <a href="{{route('usuario.tipo')}}">
                <button class="btn btn-primary">Atribuir Papel</button>
            </a>
        </div>

        <div class="text-center mt-3 mb-4">
            <a href="{{route('usuario.cadastrar')}}">
                <button class="btn btn-success">Novo Usuário</button>
            </a>
        </div>
        @if (isset($arrayTabela))
            <div class="col-8 m-auto">
                <table class="table text-center">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Usuario</th>
                            <th scope="col">Papel</th>
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($arrayTabela as $tabela)
                            <tr>
                                <th scope="row">{{$tabela['usuario']}}</th>
                                <td>{{$tabela['papel']}}</td>
                                <td>
                                    <div input-group>
                                        <a href="{{
                                            route("usuario.removePapel",
                                            [
                                                'usuarioId' => $tabela['usuarioId'],
                                                'papel' => $tabela['papel'],
                                                'dados' => $arrayDados
                                            ]
                                            )}}">
                                            <button type="button" class="btn btn-danger btn-size-120">Excluir</button>
                                        </a>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        @endif

	@endsection
