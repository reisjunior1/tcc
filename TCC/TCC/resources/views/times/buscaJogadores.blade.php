@extends('times.tela.telas')

@section('parte')
	<title>Pesquisar Jogadores</title>
	</head>
	<body>
    @if(session('mensagem'))
		<div class="alert alert-danger text-center mt-4 mb-4 p-2">
			<p>{{session('mensagem')}}</p>
		</div>
	@endif
    <div class="col-8 m-auto">
                <div input-group class="card">
                    <div class="card-header text-left">{{ __('Pesquisar') }}</div>
                    <form
                        method = "PUT"
                        action="{{route('jogador.pesquisar',['pesquisar' => '1'])}}"
                        name="formBusca"
                        placeholder="Filtrar por"
                    >
                        @csrf
                        <div class="col-6 mx-auto">
                            <label for="mlJogador" class="form-label">Jogadores:</label>
                            <select
                                name="mlJogador[]"
                                id="mlJogador"
                                class="form-select"
                                multiple size="15"
                                style="height: 25%;"
                            >
                                @foreach($jogadores as $jogador)
                                <option
                                value= {{$jogador['id']}} {{isset($dados)
                                    ? (in_array($jogador['id'], $dados['mlJogador']) ? 'selected' : '')
                                    : ''}}
                                    >
                                    {{$jogador['apelido']}}
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
        
        <div class="text-center mt-3 mb-4">
            <a href="{{route('jogador.cadastrar')}}">
                <button class="btn btn-success">Adicionar</button>
            </a>
        </div>
        @if (isset($arrayJogadores))
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
                        @foreach($arrayJogadores as $jogador)
                        <?php
                            if ($jogador['Eexcluido'] == 0) {
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
                                <th scope="row">{{$jogador['nome']}}</th>
                                <th scope="row">{{$jogador['apelido']}}</th>
                                <td>
                                    <div input-group>
                                        <a href="{{route('jogador.cadastrar',['idJogador' => $jogador['id']])}}">
                                            <button type="button" class="btn btn-primary btn-size-120">Editar</button>
                                        </a>
                                        <a href="{{
                                            route('jogador.ativarDesativar',
                                            [
                                                'idJogador' => $jogador['id'],
                                                'dados' => $arrayDados
                                            ])
                                        }}">
                                            <button type="button" class="btn btn-{{$cor}} btn-size-120">{{$texto}}</button>
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
