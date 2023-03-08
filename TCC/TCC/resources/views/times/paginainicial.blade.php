@extends('times.tela.telas')
<title>Home</title>

@section('parte')

<div id="myCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-indicators">
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="1" aria-label="Slide 2"></button>
      <button type="button" data-bs-target="#myCarousel" data-bs-slide-to="2" aria-label="Slide 3"></button>
    </div>
    <div class="carousel-inner">
      <div class="carousel-item active">
        <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"/></svg>

        <div class="container">
          <div class="carousel-caption text-start">
            <h1>Campeonatos</h1>
            <p>Clique para ver os campeonatos.</p>
            <p><a class="btn btn-lg btn-primary btn-size-90-10-margin" href="{{route("campeonato.index")}}">Ir</a></p>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"/></svg>

        <div class="container">
          <div class="carousel-caption">
            <h1>Liga Monlevadense de Futebol.</h1>
            <!--<p>Some representative placeholder content for the second slide of the carousel.</p>
            <p><a class="btn btn-lg btn-primary" href="#">Learn more</a></p>-->
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <svg class="bd-placeholder-img" width="100%" height="100%" xmlns="http://www.w3.org/2000/svg" aria-hidden="true" preserveAspectRatio="xMidYMid slice" focusable="false"><rect width="100%" height="100%" fill="#777"/></svg>

        <div class="container">
          <div class="carousel-caption text-end">
            <h1>Amistoso</h1>
            <p>Vejas os amistosos realizados pela LMF</p>
            <p><a class="btn btn-lg btn-primary btn-size-90-10-margin" href="#">Ir</a></p>
          </div>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#myCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#myCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon" aria-hidden="true"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>


  <!-- Marketing messaging and featurettes
  ================================================== -->
  <!-- Wrap the rest of the page in another container to center all the content. -->

  <div class="container marketing">

    <!-- Three columns of text below the carousel -->
    <!--
    <div class="row">
      <div class="col-lg-4">
        <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"/><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text></svg>

        <h2 class="fw-normal">Campeonato</h2>
        <p>Some representative placeholder content for the three columns of text below the carousel. This is the first column.</p>
        <p><a class="btn btn-secondary" href="#">View details &raquo;</a></p>
      </div>
      <div class="col-lg-4">
        <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"/><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text></svg>

        <h2 class="fw-normal">Cadastro</h2>
        <p>Another exciting bit of representative placeholder content. This time, we've moved on to the second column.</p>
        <p><a class="btn btn-secondary" href="#">View details &raquo;</a></p>
      </div>
      <div class="col-lg-4">
        <svg class="bd-placeholder-img rounded-circle" width="140" height="140" xmlns="http://www.w3.org/2000/svg" role="img" aria-label="Placeholder: 140x140" preserveAspectRatio="xMidYMid slice" focusable="false"><title>Placeholder</title><rect width="100%" height="100%" fill="#777"/><text x="50%" y="50%" fill="#777" dy=".3em">140x140</text></svg>

        <h2 class="fw-normal">Seleção</h2>
        <p>And lastly this, the third column of representative placeholder content.</p>
        <p><a class="btn btn-secondary" href="#">View details &raquo;</a></p>
      </div>
    </div>
-->


    <!-- START THE FEATURETTES -->

    <hr class="featurette-divider">

    <div class="row featurette">
      <div class="col-md-12">
      <div class="grid-container m-auto">
				<div class="grid-child list-group">
          <ul>
              <li class="list-group-item list-group-item-primary text-center"> Últimas Partidas</li>
              @foreach($ultimasPartidas as $ultima)
                <li class="list-group-item">
                  {{$ultima['timeCasa']}} <b>{{$ultima['gols_time_casa']}}
                  X {{$ultima['gols_time_visitante']}} </b> {{$ultima['timeVisitante']}}
                </li>
              @endforeach
              </ul>
        </div>
        <div class="grid-child list-group">
          <ul>
              <li class="list-group-item list-group-item-primary text-center"> Próximas Partidas</li>
              @foreach($proximasPartidas as $ultima)
                <li class="list-group-item">
                  {{$ultima['timeCasa']}} <b>{{$ultima['gols_time_casa']}}
                  X {{$ultima['gols_time_visitante']}} </b> {{$ultima['timeVisitante']}}
                </li>
              @endforeach
              </ul>
        </div>
      </div>
    </div>

    <hr class="featurette-divider">

    <div class="row featurette">
    <h2 class="featurette-heading fw-normal lh-1">Campeonatos</h2>
    <div class="col-md-12">
        <table class="table text-center">
                <thead class="thead-dark">
                    <tr>
                        <th scope="col">Nome</th>
                        <th scope="col">Formato</th>
                        <th scope="col">Ver</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($campeonatos as $campeonato)
                      <?php $id = $campeonato['id']; ?>
                        <tr>
                            <td>{{$campeonato['nome']}}</td>
                            <td>{{getFormato($campeonato['formato'])}}</td>
                            <td>
                              <a href="{{url("campeonato/$id")}}">
                                <button class="btn btn-dark btn-size-120">Informações</button>
                              </a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
      </div>
    </div>

    <!-- /END THE FEATURETTES -->

  </div><!-- /.container -->


@endsection