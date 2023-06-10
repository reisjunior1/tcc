@extends('times.tela.telas')

@section('parte')
	<title>Pesquisar Jogadores</title>
	</head>
	<body>
    <div class="col-8 m-auto">
        <div class="text-center mt-3 mb-4">
            <a href="{{route('time.adicionaJogador',['idTime' => $idTime])}}">
                <button class="btn btn-outline-dark">Adicionar Jogador</button>
                </a>
                <a href="{{route('time.amistoso', ['idTime' => $idTime])}} ">
                
                <button class="btn btn-outline-primary">Adicionar Partida Amistosa</button>
            </a>
        </div>
        @if (isset($jogadores))
            <div class="col-8 m-auto">
                <table class="table text-center">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">Jogador</th>
                            <th scope="col">Apelido</th>
                            <th scope="col">Ação</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($jogadores as $jogador)
                            <tr>
                                <th scope="row">{{$jogador['nome']}}</th>
                                <th scope="row">{{$jogador['apelido']}}</th>
                                <td>
                                    <div input-group>
                                        <a href="{{route('jogador.cadastrar',
                                            ['idJogador' => $jogador['id'], 'time' => $idTime]
                                            )}}"
                                        >
                                            <button type="button" class="btn btn-primary btn-size-120">Editar</button>
                                        </a>

                                        <a href="{{
                                            route('time.removeJogador',
                                            [
                                                'idTime' => $idTime,
                                                'id' => $jogador['idJogaEm']
                                            ])
                                        }}">

                                        <button type="button" class="btn btn-danger btn-size-120">Remover</button>
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
