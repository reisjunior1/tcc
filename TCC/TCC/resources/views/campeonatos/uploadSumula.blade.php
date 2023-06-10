@extends('times.tela.telas')

@section('parte')
	<title>Enviar Súmula</title>
	</head>
	<body>
	@if(session('mensagem'))
		<div class="alert alert-danger text-center mt-4 mb-4 p-2">
			<p>{{session('mensagem')}}</p>
		</div>
	@endif
		<form
            action={{route("campeonato.validaEnviarSumula", ['idPartida' => $idPartida])}}
            method="post" enctype="multipart/form-data"
        >
			@csrf
		<div>
			<hr>
			<div class="col-4 m-auto campo">
				<input type="file" name="file" id="file">
            </div>
            <div class="text-center col-4 m-auto">
				<button type="submit" class="btn btn-primary btn-size-90-margin-top">Enviar</button>
			</div>
		</form>
	</div>

	@endsection
