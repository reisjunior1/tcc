@extends('times.tela.telas')

@section('parte')
<title>Lista Locais</title>
</head>
<body>

	<div class="text-left mt-3 mb-4" >
        <div class="text-center col-8 m-auto">
            <a href="{{ route('local.cadastrarLocal') }}">
                <button class="btn btn-success">Novo Local</button>
            </a>
        </div>

    <div class="col-8 m-auto">
            <table class="table text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Endereço</th>
                        <th scope="col">Situação</th>
                        <th scope="col">Ação</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($locais as $local)
                        <?php
                            if ($local['eExcluido'] == 0) {
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
                            <th scope="row">{{$local['nome']}}</th>
                            <td>{{$local['endereco']}}</td>
                            <td>{{$local['eExcluido'] == 0 ? 'Ativo' : 'Inativo'}}</td>
                            <td>
                                <div input-group>
                                    <a href="{{route('local.cadastrarLocal',['idLocal' => $local['id']])}}">
                                        <button class="btn btn-primary btn-size-120">Editar</button>
                                    </a>
                                    <a href="{{ route('local.ativarDesativar',['idTime' => $local['id']]) }}">
                                        <button class="btn btn-{{$cor}} btn-size-120">{{$texto}}</button>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>

	</div>
	@endsection
