@extends('times.tela.telas')

@section('parte')
  	<title>Atualizar Senha</title>
  	</head>
  	<body>
		<form action={{route("usuario.validaAlterarSenha")}} method='PUT'>
  			@csrf
			<div class="conterner py-4">

				@if(session('mensagem'))
					<div class="alert alert-danger text-center mt-4 mb-4 p-2">
						<p>{{session('mensagem')}}</p>
					</div>
				@endif

  				<div class="mx-auto" style="width: 800px;">
    				<div class="col-md-6">
        				<input type="hidden" id="hdUsuario" name="hdUsuario" value="{{$usuario[0]['id']}}">
        				
						<label for="inSenhaAtual" class="form-label">Digite sua sennha atual:</label>
        				<input
							type="password"
							class="form-control"
							id="inSenhaAtual"
							name='inSenhaAtual'
							placeholder="Senha Atual"
						>

        				<label for="inNovaSenha" class="form-label">Digite uma nova senha:</label>
        				<input
							type="password"
							class="form-control"
							id="inNovaSenha"
							name='inNovaSenha'
							placeholder="Nova Senha"
						>

        				<label for="inConfirmaSenha" class="form-label">Confirme a nova senha:</label>
        				<input
							type="password"
							class="form-control"
							id="inConfirmaSenha"
							name='inConfirmaSenha'
							placeholder="Confirme a Senha"
						>
    
    				</div>
    				<br>
    				<div class="col-12">
      					<button type="submit" class="btn btn-primary">Alterar</button>
    				</div>
  				</div>
			</div>
		</form>

@endsection
