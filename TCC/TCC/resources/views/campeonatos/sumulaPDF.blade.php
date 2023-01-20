<!DOCTYPE html>
<html lang="pt-BR" dir="ltr">
<head>
    <meta charset="uft-8">
    <title>Sumula PDF</title>
    <style>
        *{
            font-family: 'Gill Sans', 'Gill Sans MT', Calibri, 'Trebuchet MS', sans-serif;
        }
        h1, h2 {
            text-align:center;
        }

        table {
            width: 700px;
            margin:50px auto;
            padding: 15px;
        }
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th{
            background-color: #d3d3d3;
        }

        .tableitem
        {
            padding: 5px;
        }
    </style>
</head>
<body>
    <hr>
    <h1>Liga Monlevadense de Futebol</h1>
    <h2>Súmula e Relatório de Partida</h2>
    <hr>

    <table>
        <thead>
            <tr>
                <th colspan="4" class="tableitem">Ficha Técnica</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="1" style="width: 15%;" class="tableitem">Campeonato</td>
                <td colspan="3" class="tableitem">{{$partida[0]['nome']}}</td>
            </tr>
            <tr>
                <td colspan="1" class="tableitem">Jogo</td>
                <td colspan="3"class="tableitem">{{$partida[0]['timeCasa']}} x {{$partida[0]['timeVisitante']}}</td>
            </tr>
            <tr>
                <td colspan="1" class="tableitem">Data</td>
                <td colspan="1" class="tableitem">{{substr($partida[0]['dataHora'], 0, 10)}}</td>
                <td colspan="1" style="width: 15%;" class="tableitem">Hora</td>
                <td colspan="1" class="tableitem">{{substr($partida[0]['dataHora'], 10)}}</td>
            </tr>
            <tr>
                <td colspan="1" class="tableitem">Local</td>
                <td colspan="3" class="tableitem">{{$partida[0]['endereco']}}</td>
            </tr>
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th colspan="4" class="tableitem">Equipe de Arbritagem</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="1" style="width: 15%;" class="tableitem">Função</td>
                <td colspan="3" class="tableitem">Nome</td>
            </tr>
            <tr>
                <td colspan="1" class="tableitem">Arbrito</td>
                <td colspan="3"class="tableitem"></td>
            </tr>
            <tr>
                <td colspan="1" class="tableitem">Assistente 1</td>
                <td colspan="3" class="tableitem"></td>
            </tr>
            <tr>
                <td colspan="1" class="tableitem">Assistente 2</td>
                <td colspan="3" class="tableitem"></td>
            </tr>
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th colspan="4" class="tableitem">Gols</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="1" style="width: 15%;" class="tableitem">Tempo</td>
                <td colspan="1" class="tableitem">1T/2T</td>
                <td colspan="1" class="tableitem">Tipo</td>
                <td colspan="1" class="tableitem">Time</td>
            </tr>
            @foreach($dadosSumula as $dado)
                <tr>
                    <td colspan="1" class="tableitem">{{$dado['minutos']}}</td>
                    <td colspan="1"class="tableitem"></td>
                    <td colspan="1"class="tableitem">{{$dado['descricao']}}</td>
                    <td colspan="1"class="tableitem">{{$dado['time']}}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
</body>
</html>