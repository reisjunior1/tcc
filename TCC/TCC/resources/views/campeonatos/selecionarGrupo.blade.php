@extends('times.tela.telas')

@section('parte')
    <title>Selecione o Grupo</title>
    </head>
    <body>
    <form action={{route("campeonato.CriaPartidasGrupo")}} method='PUT'>
		@csrf
        <div class="text-center col-8 m-auto">
            <hr>
            <h2 class="text-center">Selecionar Grupo</h2>
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
        </div>

        <div class="col-10 m-auto">
            <div input-group class="card">
                <div class="card-header text-left">{{ 'Selecionar Grupo' }}</div>

                    <div class="col-6 mx-auto">
                        <input type="hidden" id="hdCampeonato" name="hdCampeonato" value="{{$idCampeonato}}">
                        <label for="slGrupo" class="form-label">Selecione o Grupo*</label>
                        <select name="slGrupo"  id="slGrupo" class="form-select" value="0">
                            <option selected>Selecione...</option>
                            @foreach($grupos as $grupo)
                            <option
                            value = {{
                                $grupo['id']}} {{isset($dados['nome'])
                                    ? ($dados['nome'] == $grupo['id'] ? 'selected' : '')
                                    : ''
                                }}>
                                {{$grupo['nome']}}
                            </option>
                            @endforeach
                        </select>
                    </div>

                    <div class="text-center mt-3 mb-4">
					    <button type="submit" class="btn btn-primary">Próximo</button>
				    </div>
                </div>
            </div>
    </form>

        
    @endsection
