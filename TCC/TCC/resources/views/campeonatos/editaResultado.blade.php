@extends('times.tela.telas')

@section('parte')
	<title>Atualizar Senha</title>
  	</head>
  	<body>
		<form action={{route("campeonato.validaAlterarResultado")}} method='PUT'>
  			@csrf
			<div class="conterner py-4">
				@if(session('mensagem'))
					<div class="alert alert-danger text-center mt-4 mb-4 p-2">
						<p>{{session('mensagem')}}</p>
					</div>
				@endif

				<div class="mx-auto" style="width: 800px;">
					<div class="col-md-6 campo">
						<?php $i =0; ?>
						<input type="hidden" id="hdPartida" name="hdPartida" value="{{$idPartida}}">
						<input type="hidden" id="hdTimeCasa" name="hdTimeCasa" value="{{$times[0]['id']}}">
						<input type="hidden" id="hdTimeVisitante" name="hdTimeVisitante" value="{{$times[1]['id']}}">

                        @foreach($eventos as $evento)
                        <div class="enventoCadastrado{{$i}}" id="enventoCadastrado{{$i}}">
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
                            
                            <label for="inTempoExistente{{$i}}" class="form-label">Minutos*</label>
                            <input
                                type="text"
                                class="form-control minutos"
                                name="inTempoExistente{{$i}}"
                                id="inTempoExistente{{$i}}"
                                value="{{isset($evento['minutos']) ? $evento['minutos'] : null}}"
                                placeholder="Hora de início"
                                >
                                <br>
                                <button type="button" class="btn-remover-acao btn btn-danger" id="{{$i}}">x</button>
                                <br>
                                <br>
                                <?php $i++; ?>
                            </div>
                            @endforeach
                                
					</div>
					<div class="col-md-1">
						<label for="code" class="text-left"></label><br>
						<button type="button" class="btn btn-success add-campo" id="add-campo"> + </button>
					</div>
					<br>
					<div class="col-12">
						<button type="submit" class="btn btn-primary">Finalizar</button>
					</div>
				</div>
			</div>
		</form>

	@endsection
