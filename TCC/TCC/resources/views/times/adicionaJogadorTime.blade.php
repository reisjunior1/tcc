@extends('times.tela.telas')

@section('parte')
	<title>Pesquisar Jogadores</title>
	</head>
	<body>
    <div class="col-8 m-auto">
                <div input-group class="card">
                    <div class="card-header text-left">{{ __('Pesquisar') }}</div>
                    <form
                        method = "PUT"
                        action="{{route('time.validaAdicionarJogador',['idTime' => $idTime])}}"
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
                                @foreach($arrayJogadores as $key => $value)
                                <option
                                value= {{$key}} {{isset($dados)
                                    ? (in_array($jogador['id'], $dados['mlJogador']) ? 'selected' : '')
                                    : ''}}
                                    >
                                    {{$value}}
                                </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="text-center mt-3 mb-4">
                            <button type="submit"class="btn btn-success">Adicionar</button>
                        </div>
                    </form>
                </div>
            </div>
        <div>
        


	@endsection
