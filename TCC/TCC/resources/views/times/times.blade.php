@extends('times.tela.telas')

@section('parte')
<title>Cadastro - Time</title>
</head>
<body>

	<div class="text-left mt-3 mb-4" >
		<div class="col-8 m-auto">
			<form class="row g-7" name="formCadastro" id="formCadastro" method="post" action="{{url('time')}}">
				@csrf
				<label for="nometime" class="form-label">Nome do Time:</label>
				<input
					type="text"
					class="text45Left form-control"
					name="inNometime"
					id="inNometime"
					placeholder="Nome Time"
					required
				>

				<label for="sigla" class="form-label">Sigla:</label>
				<input
					type="text"
					class="text45Left form-control"
					id="inSigla"
					name = "inSigla"
					placeholder="Sigla do Time"
					required
				>

				<label for="telefone" class="form-label">Telefone:</label>
					<input
						type="text"
						class="text45Left form-control telefone"
						id="inTelefone"
						name='inTelefone'
						value="{{$usuario->telefone ?? ''}}"
						placeholder="( ) - ---- ----"
					>
				<!--
				<div class="col-md-6">
					<label for="emailtime" class="form-label">Email:</label>
					<input type="emailtime" class="form-control" id="inEmailtime"  placeholder="....@email.com">
				</div>

				<div class="col-md-6">
					<label for="responsavel" class="form-label">Responsável:</label>
					<input type="text" class="form-control" id="inresponsavel"  placeholder="Nome do Responsavel">
				</div>

				<div class="col-md-6">
					<label for="cpfresp" class="form-label">CPF:</label>
					<input type="cpfresp" class="form-control" id="incpfesp"  placeholder="***.***.***-**">
				</div>
				-->

				<label for="cep" class="form-label">CEP:</label>
				<input
					type="text"
					class="text45Left form-control cep"
					id="inCep"
					name= "inCep"
					placeholder="_____ - __"
					required
				>

				<label for="endereco" class="form-label">Endereço:</label>
				<input
					type="text"
					class="text45Left form-control"
					id="inEndereco"
					name="inEndereco"
					placeholder="Rua:"
					required
				>

				<label for="bairo" class="form-label">Bairro:</label>
				<input
					type="text"
					class="text45Left form-control"
					id="inBairro"
					name="inBairro"
					placeholder="Bairo:"
					required
				>

				<label for="complemento" class="form-label">Complemento:</label>
				<input
					type="text"
					class="text45Left form-control"
					id="inComplemento"
					name="inComplemento"
					placeholder="Apartamento, quadra..."
				>

				<label for="cidade" class="form-label">Cidade:</label>
				<input
					type="text"
					class="text45Left form-control"
					id="inCidade"
					name="inCidade"
					required
				>

				<label for="estado" class="form-label">Estado:</label>
				<select id="slEstado" name="slEstado" class="text45Left form-select">
					<option selected>Selecione</option>
					<option>MG</option>
				</select>
				
				<button type="submit" class="btn btn-success">Salvar</button>
				<!--<button class="btn btn-danger">Cancelar</button>-->
			</form>
		</div>
	</div>
	@endsection
