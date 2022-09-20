@extends('times.tela.telas')


@section('parte')
  <title>Cadastro</title>
  </head>
  <body>

  <hr> <h2 class="text-center">Campeonatos</h2> <hr>
  @if(session('mensagem'))
    <div class="alert alert-success text-center mt-4 mb-4 p-2">
        <p>{{session('mensagem')}}</p>
    </div>
  @endif
  <?php var_dump(session_status()); ?>
  <h3 class="text-center">Filtrar por</h3>
<div class="text-center mt-3 mb-4">
    <div class="col-4 m-auto">
        <form method = "POST" action="{{route('campeonato.pesquisar')}}" name="formBusca" placeholder="Filtrar por">
            @csrf
            <label for="slFormato" class="form-label">Formato</label>
            <select id="slFormato" name="slFormato" class="form-select">
                <option selected>Selecione...</option>
                <option value="PC" {{isset($formato) ? ($formato == 'PC' ? 'selected' : '') : ''}}>Pontos Corridos</option>
                <option value="CP" {{isset($formato) ? ($formato == 'CP' ? 'selected' : '') : ''}}>Copa</option>
                <option value="MM" {{isset($formato) ? ($formato == 'MM' ? 'selected' : '') : ''}}>Mata a mata</option>
            </select>
            <br>
            <div class="col-12">
            <label for="inDataInicio" class="form-label">Periodo</label>
            <div class="col-3">
                <input type="date" class="form-control" name="inDataInicio" id="inDataInicio" value="{{isset($dtInicio) ? $dtInicio : null}}" placeholder="DD/MM/AAAA">
                <label class="form-label">a</label>
                <input type="date" class="form-control" name="inDataFim" id="inDataFim" value="{{isset($dtFim) ? $dtFim : null}}" placeholder="DD/MM/AAAA">
            </div>
            </div>
            <br>
            <label for="slTime" class="form-label">Time:</label>
            <select name="slTime"  id="slTime" class="form-select">
                <option selected>Selecione...</option>
                @foreach($times as $time)
                    <option value= {{$time['id']}} {{isset($slTime) ? ($slTime == $time['id'] ? 'selected' : '') : ''}}>{{$time['nome']}}</option>
                @endforeach
            </select>
            <br>
            
            <button type="submit"class="btn btn-success">Pesquisar</button>
        </form>
    </div>
</div>
<div class="text-center mt-3 mb-4">
    <a href="{{route('campeonato.cadastrar')}}">
        <button class="btn btn-success">Cadastrar</button>
    </a>
</div>

<div class="col-8 m-auto">
    <table class="table text-center">
        <thead class="thead-dark">
        <tr>
            <th scope="col">Id</th>
            <th scope="col">Nome</th>
            <th scope="col">Formato</th>
            <th scope="col">Action</th>
        </tr>
        </thead>
        <tbody>

        @foreach($campeonatos as $campeonato)
            <tr>
                <th scope="row">{{$campeonato->id}}</th>
                <td>{{$campeonato->nome}}</td>
                <td>{{$campeonato->formato}}</td>
                <td>
                    <a href="{{url("campeonato/$campeonato->id")}}">
                        <button class="btn btn-dark">Informações</button>
                    </a>
                    <a href="{{url("campeonato/$campeonato->id/partidas")}}">
                        <button class="btn btn-dark">Partidas</button>
                    </a>
                    <a href="{{url("campeonato/$campeonato->id/edit")}}">
                        <button class="btn btn-primary">Editar</button>
                    </a>
                    
                    <form id="submit-form" action={{route("campeonato.criarPartida", ['idCampeonato'])}} method='PUT' class="hidden">
                        @csrf
                        @method('PUT')                         
                        <input type="hidden" id="hdCampeonato" name="hdCampeonato" value="{{$campeonato->id}}">
                        <button type="submit" class="btn btn-danger">Deletar</button>
                    </form>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>



   @endsection
