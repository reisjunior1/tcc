@extends('times.tela.telas')

@section('parte')
	<title>Editar Sumula</title>
    </head>
    <body>
		<form action={{route("campeonato.validaAlterarResultado")}} method='PUT'>
            @csrf
			<div class="text-left mt-3 mb-4">
				@if(session('mensagem'))
					<div class="alert alert-danger text-center mt-4 mb-4 p-2">
						<p>{{session('mensagem')}}</p>
					</div>
				@endif

                <?php $i =0; ?>
                <input type="hidden" id="hdPartida" name="hdPartida" value="{{$idPartida}}">
                <input type="hidden" id="hdTimeCasa" name="hdTimeCasa" value="{{$times[0]['id']}}">
                <input type="hidden" id="hdTimeVisitante" name="hdTimeVisitante" value="{{$times[1]['id']}}">

                @foreach($eventos as $evento)
                    <div class="text-left col-6 m-auto campo enventoCadastrado{{$i}}" id="enventoCadastrado{{$i}}">
                        <input
                            type="hidden"
                            id="hdidSumula{{$i}}"
                            name="hdidSumula{{$i}}"
                            value="{{$evento['idAcao']}}"
                        >
                        <label for="slAcaoExistente{{$i}}" class="form-label">Ação:</label>
                        <select name="slAcaoExistente{{$i}}"  id="slAcaoExistente{{$i}}" class="form-select">
                            <option selected>Selecione...</option>
                            @foreach($acoes as $acao)
                            <option value= {{
                                $acao['id']}} {{isset($evento['id_acao'])
                                    ?($evento['id_acao'] == $acao['id'] ? 'selected' : '')
                                    : ''
                                }}>{{$acao['descricao']}}
                            </option>
                            @endforeach
                        </select>
                            
                        <label for="slTimeExistente{{$i}}" class="form-label">Time:</label>
                        <select name="slTimeExistente{{$i}}"  id="slTimeExistente{{$i}}" class="form-select">
                            <option selected>Selecione...</option>
                            @foreach($times as $time)
                            <option value= {{
                                $time['id']}} {{isset($evento['id_time'])
                                    ?($evento['id_time'] == $time['id'] ? 'selected' : '')
                                    : ''
                                }}>{{$time['nome']}}
                            </option>
                            @endforeach
                        </select>

                        <label for="inNumeroExistente{{$i}}" class="form-label">Número Camisa*</label>
                        <input
                            type="number"
                            class="form-control minutos"
                            name="inNumeroExistente{{$i}}"
                            id="inNumeroExistente{{$i}}"
                            value="{{isset($evento['numero_camisa']) ? $evento['numero_camisa'] : null}}"
                            placeholder="00"
                        >
                        
                        <label for="inTempoExistente{{$i}}" class="form-label">Minutos*</label>
                        <input
                            type="text"
                            class="form-control minutos"
                            name="inTempoExistente{{$i}}"
                            id="inTempoExistente{{$i}}"
                            value="{{isset($evento['minutos']) ? $evento['minutos'] : null}}"
                            placeholder="Hora de início"
                            >
                        <button type="button" class="btn-remover-acao btn btn-danger btn-margin-top" id="{{$i}}">
                            x
                        </button>
                        <?php $i++; ?>
                    </div>
            @endforeach
            <div class="text-left col-4 m-auto">
				<label for="code" class="text-left"></label><br>
				<button type="button" class="btn btn-success add-campo" id="add-campo"> + </button>
			</div>
            <div class="text-center col-4 m-auto">
				<label for="inObservacao">Observações*</label></p>
				<textarea id="inObservacao" name="inObservacao" rows="4" cols="50" >{{isset($observacao) ? $observacao : null}}</textarea>
			</div>
			<div class="text-center col-4 m-auto">
				<button type="submit" class="btn btn-primary btn-size-90-margin-top">Finalizar</button>
			</div>
		</form>

	@endsection
