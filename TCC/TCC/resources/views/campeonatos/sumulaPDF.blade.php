<!DOCTYPE html>
<html lang="pt-BR" dir="ltr">
<head>
    <meta charset="uft-8">
    <title>Sumula PDF</title>
    <style>
        *{
            font-family: 'Gill Sans', 'Gill Sans MT', 'Calibri', 'Trebuchet MS', sans-serif;
        }
        h1, h2 {
            text-align:center;
        }

        h1{
            font-size: 20px;
        }

        h2 {
            font-size: 15px;
        }

        table {
            width: 700px;
            margin:1px auto;
            padding: 3px;
        }
        table, th, td {
            border: 1px solid black;
            border-collapse: collapse;
        }

        th{
            background-color: #d3d3d3;
            font-size: 14px;
        }

        td{
            font-size: 12px;
        }

        .tableitem
        {
            padding: 3px;
        }

    </style>
</head>
<body>

    <table>
        <thead>
            <tr>
                <th colspan="3" class="tableitem">{{strtoupper($partida[0]['nome'])}}</th>
            </tr>
        </thead>
        <tbody>
            <tr>
                <td colspan="1" class="tableitem">Data: {{date( 'd/m/Y' , strtotime($partida[0]['dataHora']))}}</td>
                <td colspan="1" class="tableitem">Hora: {{substr($partida[0]['dataHora'], 10)}}</td>
                <td colspan="1" class="tableitem">Fase:</td>
                <tr>
                <td colspan="1" class="tableitem">Arbrito: {{$partida[0]['arbritoNome']}}</td>
                <td colspan="1" class="tableitem">Auxiliar 1: {{$partida[0]['aux1Nome']}}</td>
                <td colspan="1" class="tableitem">Auxiliar 2: {{$partida[0]['aux2Nome']}}</td>
            </tr>
            <tr>
                <td colspan="3" class="tableitem">Mesário: {{$partida[0]['mesarioNome']}}</td>
            </tr>
            <tr>
                <td colspan="1" class="tableitem">Horário de Início:</td>
                <td colspan="1" class="tableitem">Intervalo:</td>
                <td colspan="1" class="tableitem">Horário de Termino:</td>
            </tr>
            <tr>
                <td colspan="1" class="tableitem">Tempo Extra Inicial:</td>
                <td colspan="1" class="tableitem">Intervalo:</td>
                <td colspan="1" class="tableitem">Tempo Extra Final:</td>
            </tr>
        </tbody>
    </table>

    <table>
        <thead>
            <tr>
                <th colspan="15" class="tableitem">{{$partida[0]['timeCasa']}}</th>
                <th colspan="15" class="tableitem">{{$partida[0]['timeVisitante']}}</th>
            </tr>
        </thead>
        <tbody>
            @for ($i=0; $i < 28; $i = $i+2)
            <?php $j = $i + 1; ?>
            <tr>
                <td colspan="6">{{isset($jogadoresTimeCasa[$i]) ? $jogadoresTimeCasa[$i]['apelido'] : ''}}</td>
                <td colspan="1" class="tableitem">&nbsp;</td>
                <td colspan="7">{{isset($jogadoresTimeCasa[$j]) ? $jogadoresTimeCasa[$j]['apelido'] : ''}}</td>
                <td colspan="1" class="tableitem">&nbsp;</td>
                
                <td colspan="6">{{isset($jogadoresTimeVisitante[$i]) ? $jogadoresTimeVisitante[$i]['apelido'] : ''}}</td>
                <td colspan="1" class="tableitem">&nbsp;</td>
                <td colspan="7">{{isset($jogadoresTimeVisitante[$j]) ? $jogadoresTimeVisitante[$j]['apelido'] : ''}}</td>
                <td colspan="1" class="tableitem">&nbsp;</td>
            </tr>
            @endfor
        
            <tr>
                <td colspan="4" class="tableitem">Titular</td>
                @for($i=0; $i<=10;$i++)
                    <td colspan="1"class="tableitem">&nbsp;</td>
                @endfor
                <td colspan="4" class="tableitem">Titular</td>
                @for($i=0; $i<=10;$i++)
                    <td colspan="1"class="tableitem">&nbsp;</td>
                @endfor
            </tr>
            <tr>
                <td colspan="4" class="tableitem">Subst.</td>
                @for($i=0; $i<=10;$i++)
                    <td colspan="1"class="tableitem">&nbsp;</td>
                @endfor
                <td colspan="4" class="tableitem">Subst.</td>
                @for($i=0; $i<=10;$i++)
                    <td colspan="1"class="tableitem">&nbsp;</td>
                @endfor
            </tr>
            
            <tr>
                <th colspan="15" class="tableitem">Comissão Técnica</th>
                <th colspan="15" class="tableitem">Comissão Técnica</th>
            </tr>
            <tr>
                <td colspan="15" class="tableitem">Técnico:</td>
                <td colspan="15"class="tableitem">Técnico:</td>
            </tr>
            <tr>
                <td colspan="15" class="tableitem">Auxiliar Técnico:</td>
                <td colspan="15"class="tableitem"> Auxiliar Técnico:</td>
            </tr>
            <tr>
                <td colspan="15" class="tableitem">Massagista:</td>
                <td colspan="15"class="tableitem">Massagista:</td>
            </tr>
            <tr>
                <td colspan="15" class="tableitem">Preparador Físico:</td>
                <td colspan="15"class="tableitem">Preparador Físico:</td>
            </tr>

            <tr>
                <th colspan="15" class="tableitem">Gols</th>
                <th colspan="15" class="tableitem">Gols</th>
            </tr>
                <tr>
                    @for($i=0; $i<=29;$i++)
                    <td colspan="1"class="tableitem">&nbsp;</td>
                    @endfor
                </tr>
                <tr>
                    @for($i=0; $i<=29;$i++)
                    <td colspan="1"class="tableitem">&nbsp;</td>
                    @endfor
                </tr>

            <tr>
                <th colspan="15" class="tableitem">Cartões Amarelos</th>
                <th colspan="15" class="tableitem">Cartões Amarelos</th>
            </tr>
            <tr>
                @for($i=0; $i<=29;$i++)
                    <td colspan="1"class="tableitem">&nbsp;</td>
                @endfor
            </tr>
            <tr>
                @for($i=0; $i<=29;$i++)
                    <td colspan="1"class="tableitem">&nbsp;</td>
                @endfor
            </tr>

            <tr>
                <th colspan="15" class="tableitem">Cartões Vermelhos</th>
                <th colspan="15" class="tableitem">Cartões Vermelhos</th>
            </tr>
            <tr>
                @for($i=0; $i<=29;$i++)
                    <td colspan="1"class="tableitem">&nbsp;</td>
                @endfor
            </tr>

            <tr>
                <th colspan="30" class="tableitem">Relatório Final da Partida</th>
            </tr>
            @for($i=0; $i < 9;$i++)
            <tr>
                <td colspan="30" class="tableitem">&nbsp;</td>
            </tr>
            @endfor
        </body>
    </table>

</html>