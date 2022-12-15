@extends('times.tela.telas')

@section('parte')
<title>Cadastro - Time</title>
</head>
<body>

	<div class="text-left mt-3 mb-4" >
		<div class="col-8 m-auto">
			<form class="row g-3"  method="put"  action={(route("time.cadastrar"))}>
				<!--<form class="row g-3"  method="post"  action="{{url('times')}}"  >-->
				@csrf
				<label for="nometime" class="form-label">Nome do Time:</label>
				<input type="text" class="text45Left form-control" id="isnometime" placeholder="NomeTime">

				<label for="sigla" class="form-label">Sigla:</label>
				<input type="sigla" class="text45Left form-control" id="insigla"  placeholder=" Siglado Time">

				<label for="telefonetime" class="form-label">Telefone de Contato:</label>
				<input type="text" class="text45Left form-control" id="intelefonetime"  placeholder="( ) - ---- ----">

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
				</select>
			</div>


			<div class="col-8 m-auto"> <p></p>
				<button type="submit" class="btn btn-primary">Salvar</button>
				<button class="btn btn-danger">Cancelar</button>
			</div>

		</form>
	@endsection
