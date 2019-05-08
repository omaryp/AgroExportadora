<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Parametro;

class ParametroController extends Controller
{
    //
    public static function getDestinosRecursos(){
        return Parametro::where('codigo','=',1)->where('codtab','<>','')->get();
    }

    public static function getFormaPago(){
        return Parametro::where('codigo','=',2)->where('codtab','<>','')->get();
    }

}
