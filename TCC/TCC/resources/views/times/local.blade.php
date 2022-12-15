@extends('times.tela.telas')

@section('parte')
<title>Cadastro - Local</title>
</head>
<body>

	<div class="text-left mt-3 mb-4" >
		<div class="col-8 m-auto">

		<form class="row g-3"  method="put"  action={(route("time.local"))}>
		<form class="row g-3"  method="post"  action="{{url('local')}}"  >
			@csrf

				<label for="nome" class="form-label">Nome :</label>
				<input type="text" class="text45Left form-control" id="inNome" name='inNome'   placeholder="Nome">

				<label for="cep" class="form-label">CEP:</label>
				<input type="text" class="text45Left form-control" id="incep">

				<label for="endereco" class="form-label">Endereço:</label>
				<input type="text" class="text45Left form-control" id="inendereco" placeholder="Rua:..">

				<label for="complemento" class="form-label">Complemento:</label>
				<input type="text" class="text45Left form-control" id="incomplemento" placeholder="Apartamento, quadra...">

				<label for="cidade" class="form-label">Cidade:</label>
				<input type="text" class="text45Left form-control" id="incidade">

				<label for="estado" class="form-label">Estado:</label>
				<select id="slestado" class="text45Left form-select">
					<option selected>...</option>
					<option>...</option>
					<option>MG</option>
					<option>ES</option>
				</select>


			<div input-group>
				<button type="submit" class="btn btn-primary">Salvar</button>
				<button class="btn btn-danger">Cancelar</button>
			</div>
		</form>
	</div>
@endsection
