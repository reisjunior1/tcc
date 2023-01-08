<?php

if (!function_exists('montaTelefone')) {
    function montaTelefone($telefone)
    {
        $telefone = trim(str_replace('/', '', str_replace(' ', '', str_replace('-', '', str_replace(')', '', str_replace('(', '', $telefone))))));
        $telefone = '(' . substr($telefone,0,2) . ') ' . substr($telefone,2,5) .'-'.substr($telefone,7,4);
        return $telefone;
    }
}

