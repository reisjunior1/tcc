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
  <h3 class="text-center">Filtrar por</h3>
<div class="text-center mt-3 mb-4">
    <div class="col-4 m-auto">
        <label for="slFormato" class="form-label">Formato</label>
        <select id="slFormato" class="form-select">
            <option selected>Selecione...</option>
            <option value="PC">Pontos Corridos</option>
            <option value="CP">Copa</option>
            <option value="MM">Mata a mata</option>
        </select>
    </div>
    <a href="{{route('campeonato.pesquisar/slFormato')}}">
        <button class="btn btn-primary">Pesquisar</button>
    </a>
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
                        <button class="btn btn-dark">Times Participantes</button>
                    </a>
                    <a href="{{url("campeonato/$campeonato->id/edit")}}">
                        <button class="btn btn-primary">Editar</button>
                    </a>
                    
                    <a href="{{url("campeonato/$campeonato->id")}}" class="js-del">
                        <button class="btn btn-danger">Deletar</button>
                    </a>
                </td>
            </tr>
        @endforeach
        </tbody>
    </table>
</div>



   @endsection
