@extends('times.tela.telas')

@section('parte')
<title>Cadastro - Time</title>
</head>
<body>
    @if(session('mensagem'))
		<div class="alert alert-success text-center mt-4 mb-4 p-2">
			<p>{{session('mensagem')}}</p>
		</div>
    @endif
	<div class="text-left mt-3 mb-4" >
		<div class="col-8 m-auto">
            <h1>Gerenciar Equipe Arbritagem</h1>
        </div>
    </div>

    <div class="text-center col-8 m-auto">
        <a href="{{ route('arbrito.cadastrar') }}">
            <button class="btn btn-success">Cadastrar Novo</button>
        </a>
    </div>

    <div class="col-8 m-auto">
            <table class="table text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Situação</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($arbritos as $arbrito)
                        <?php
                            if ($arbrito['Eexcluido'] == 0) {
                                $texto = 'Desativar';
                                $cor = 'danger';
                                $rota = 'desativar';
                            } else {
                                $texto = 'Ativar';
                                $cor = 'success';
                                $rota = 'ativar';
                            }
                        ?>
                        <tr>
                            <td>{{$arbrito['nome']}}</td>
                            <td>{{$arbrito['Eexcluido'] == 0 ? 'Ativo' : 'Inativo'}}</td>
                            <td>
                                <div input-group>
                                    <a href="{{ route('arbrito.cadastrar',['id' => $arbrito['id']]) }}">
                                        <button class="btn btn-primary btn-size-120">Editar</button>
                                    </a>
                                    <a href="{{ route('arbrito.ativarDesativar',['idArbrito' => $arbrito['id']]) }}">
                                        <button class="btn btn-{{$cor}} btn-size-120">{{$texto}}</button>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

        
@endsection
