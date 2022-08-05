<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaginaInicial extends Controller
{
    //

    public function index ()
    {
        return view(view:'times.paginainicial');
    }
 

}
