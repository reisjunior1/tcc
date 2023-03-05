<?php

if (!function_exists('montaTelefone')) {
    function montaTelefone($telefone)
    {
        $telefone = trim(str_replace('/', '', str_replace(' ', '', str_replace('-', '', str_replace(')', '', str_replace('(', '', $telefone))))));
        $telefone = '(' . substr($telefone,0,2) . ') ' . substr($telefone,2,5) .'-'.substr($telefone,7,4);
        return $telefone;
    }
}

if (!function_exists('getFormato')) {
    
    function getFormato($formato)
    {
        switch($formato) {
            case 'MM':
                return 'Mata a Mata';
            case 'PC':
                return 'Pontos Corridos';
            case 'CP':
                return 'Copa';
        }
    }
}

