@extends('times.tela.telas')

@section('parte')
	<title>Cadastro</title>
	</head>
  	<body>
  	<hr>
		<h2 class="text-center">Detalhes</h2>
	<hr>
  	
	@if(session('mensagem'))
    	<div class="alert alert-success text-center mt-4 mb-4 p-2">
        	<p>{{session('mensagem')}}</p>
    	</div>
  	@endif
  
	@if(isset($errors) && count($errors)>0)
    	<div class="alert alert-danger text-center mt-4 mb-4 p-2">
        	@foreach($errors->all() as $erro)
            	{{$erro}}
				<br>
        	@endforeach
    	</div>
	@endif

	<div class="col-6 m-auto">
		<div class="container">
  			<div class="row">
    			<div class="col">
      				<h2 class="text-center">{{$partida[0]['timeCasa']}}</h2>
      				<h3 class="text-center">{{$partida[0]['gols_time_casa']}}</h3>
      				<hr>
					@foreach($eventos as $valor)
						@if($valor['id_time'] == $partida[0]['idTimeCasa'])
							<p>{{$valor['descricao']}} - {{$valor['minutos']}}</p>
						@endif
					@endforeach
    			</div>
    			<div class="col">
        			<h2 class="text-center">{{$partida[0]['timeVisitante']}}</h2>
        			<h3 class="text-center">{{$partida[0]['gols_time_visitante']}}</h3>
        			<hr>
					@foreach($eventos as $valor)
						@if($valor['id_time'] == $partida[0]['idTimeVisitante'])
							<p>{{$valor['descricao']}} - {{$valor['minutos']}}</p>
						@endif
					@endforeach
				</div>
  			</div>
		</div>
	</div>

@endsection
