@extends('times.tela.telas')

@section('parte')
<title>Cadastro - Time</title>
</head>
<body>

	<div class="text-left mt-3 mb-4" >
		<div class="col-8 m-auto">
            <h1>Gerenciar Times</h1>
        </div>
    </div>

    <div class="text-center col-8 m-auto">
        <a href="{{ route('time.cadastrar',['idUsuario' => Auth::user()->id]) }}">
            <button class="btn btn-success">Criar Novo Time</button>
        </a>
    </div>

    <div class="col-8 m-auto">
            <table class="table text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Sigla</th>
                        <th scope="col">Nome</th>
                        <th scope="col">Situação</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($times as $time)
                        <tr>
                            <th scope="row">{{$time['sigla']}}</th>
                            <td>{{$time['nome']}}</td>
                            <td>{{$time['Eexcluido'] == 0 ? 'Ativo' : 'Inativo'}}</td>
                            <td>
                                <div input-group>
                                    <a href="{{ route('time.gerenciar',['idTime' => $time['id']]) }}">
                                        <button class="btn btn-primary btn-size-120">Gerenciar</button>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        
@endsection
