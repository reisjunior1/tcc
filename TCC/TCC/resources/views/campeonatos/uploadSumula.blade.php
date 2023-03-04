@extends('times.tela.telas')

@section('parte')
	<title>Enviar Súmula</title>
	</head>
	<body>
		<form
            action={{route("campeonato.validaEnviarSumula", ['idPartida' => $idPartida])}}
            method="post" enctype="multipart/form-data"
        >
			@csrf
			
			<div class="col-4 m-auto campo">
                <input type="file" name="file" id="file">
            </div>
            <div class="text-center col-4 m-auto">
				<button type="submit" class="btn btn-primary btn-size-90-margin-top">Enviar</button>
			</div>
		</form>

	@endsection
