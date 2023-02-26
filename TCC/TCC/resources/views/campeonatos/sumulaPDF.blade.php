<!DOCTYPE html>
<html lang="pt-BR" dir="ltr">
<head>
    <meta charset="uft-8">
    <title>Sumula PDF</title>
    <style>
        *{
            font-family: 'Gill Sans', 'Gill Sans MT', 'Calibri', 'Trebuchet MS', sans-serif;
            font-size: 14;
        }
        h1, h2 {
            text-align:center;
        }

        h1{
            font-size: 30px;
        }

        h2 {
            font-size: 20px;
        }

        table {
            width: 700px;
            margin:5px auto;
            padding: 15px;
        }
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th{
            background-color: #d3d3d3;
            font-size: 18px;
        }

        td{
            font-size: 14px;
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
                <td colspan="1" class="tableitem">{{date( 'd/m/Y' , strtotime($partida[0]['dataHora']))}}</td>
                <td colspan="1" style="width: 15%;" class="tableitem">Hora</td>
                <td colspan="1" class="tableitem">{{substr($partida[0]['dataHora'], 10)}}</td>
            </tr>
            <tr>
                <td colspan="1" class="tableitem">Local</td>
                <td colspan="3" class="tableitem">{{$partida[0]['endereco']}}</td>
            </tr>
            <tr>
                <td colspan="4">&nbsp;</td>
            </tr>
            <tr>
                <th colspan="4" class="tableitem">Equipe de Arbritagem</th>
            </tr>
            <tr>
                <td colspan="1" style="width: 15%;" class="tableitem">Função</td>
                <td colspan="3" class="tableitem">Nome</td>
            </tr>
            <tr>
                <td colspan="1" class="tableitem">Arbrito</td>
                <td colspan="3"class="tableitem"></td>
            </tr>
            <tr>
                <td colspan="1" class="tableitem">Auxiliar 1</td>
                <td colspan="3" class="tableitem"></td>
            </tr>
            <tr>
                <td colspan="1" class="tableitem">Auxiliar 2</td>
                <td colspan="3" class="tableitem"></td>
            </tr>
            <tr>
                <td colspan="1" class="tableitem">Mesário</td>
                <td colspan="3" class="tableitem"></td>
            </tr>
            <tr>
                <td colspan="4">&nbsp;</td>
            </tr>
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th colspan="2" class="tableitem">{{$partida[0]['timeCasa']}}</th>
                <th colspan="2" class="tableitem">{{$partida[0]['timeVisitante']}}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <th colspan="2" class="tableitem">Gols</th>
                <th colspan="2" class="tableitem">Gols</th>
            </tr>
            @for($i = 0; $i < $gols; $i++)
                <tr>
                    <td colspan="2"class="tableitem">{{isset($golsCasa[$i]) ? $golsCasa[$i]['numero_camisa'] : ''}}</td>
                    <td colspan="2"class="tableitem">{{isset($golsVisitante[$i]) ? $golsVisitante[$i]['numero_camisa'] : ''}}</td>
                </tr>
            @endfor
            @for($i = 0; $i < $golsContra; $i++)
                <tr>
                    <td colspan="2"class="tableitem">{{isset($golsContraCasa[$i]) ? $golsContraCasa[$i]['numero_camisa'] . ' (Contra)'  : ''}}</td>
                    <td colspan="2"class="tableitem">{{isset($golsContraVisitante[$i]) ? $golsContraVisitante[$i]['numero_camisa'] . ' (Contra)'  : ''}}</td>
                </tr>
            @endfor
            <tr>
                <td colspan="4">&nbsp;</td>
            </tr>

            <tr>
                <th colspan="2" class="tableitem">Cartões Vermelhos</th>
                <th colspan="2" class="tableitem">Cartões Vermelhos</th>
            </tr>

            @for($i = 0; $i < $cartoesVermelhos; $i++)
                <tr>
                    <td colspan="2"class="tableitem">{{isset($cartaoVermelhoCasa[$i]) ? $cartaoVermelhoCasa[$i]['numero_camisa'] : ''}}</td>
                    <td colspan="2"class="tableitem">{{isset($cartaoVermelhoVisitante[$i]) ? $cartaoVermelhoVisitante[$i]['numero_camisa'] : ''}}</td>
                </tr>
            @endfor
            <tr>
                <td colspan="4">&nbsp;</td>
            </tr>

            <tr>
                <th colspan="2" class="tableitem">Cartões Amarelos</th>
                <th colspan="2" class="tableitem">Cartões Amarelos</th>
            </tr>
            @for($i = 0; $i < $cartoesAmarelos; $i++)
                <tr>
                    <td colspan="2"class="tableitem">{{isset($cartaoAmareloCasa[$i]) ? $cartaoAmareloCasa[$i]['numero_camisa'] : ''}}</td>
                    <td colspan="2"class="tableitem">{{isset($cartaoAmareloVisitante[$i]) ? $cartaoAmareloVisitante[$i]['numero_camisa'] : ''}}</td>
                </tr>
            @endfor

            <tr>
                <td colspan="4">&nbsp;</td>
            </tr>
            <tr>
                <th colspan="2" class="tableitem">Comissão Técnica</th>
                <th colspan="2" class="tableitem">Comissão Técnica</th>
            </tr>
            <tr>
                <td colspan="2" class="tableitem">Técnico:</td>
                <td colspan="2"class="tableitem">Técnico:</td>
            </tr>
            <tr>
                <td colspan="2" class="tableitem">Auxiliar Técnico:</td>
                <td colspan="2"class="tableitem"> Auxiliar Técnico:</td>
            </tr>
            <tr>
                <td colspan="2" class="tableitem">Massagista:</td>
                <td colspan="2"class="tableitem">Massagista:</td>
            </tr>
            <tr>
                <td colspan="2" class="tableitem">Preparador Físico:</td>
                <td colspan="2"class="tableitem">Preparador Físico:</td>
            </tr>
        </body>
    </table>

    <table>
        <thead>
            <tr>
                <th colspan="4" class="tableitem">Relatório Final da Partida</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="4" class="tableitem">{{$partida[0]['observacao']}}</td>
            </tr>
        </tbody>
    </table>
</html>