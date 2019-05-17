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

    public static function getTipoComprobante(){
        return Parametro::where('codigo','=',4)->where('codtab','<>','')->get();
    }

    public static function getMonedas(){
        return Parametro::where('codigo','=',5)->where('codtab','<>','')->get();
    }

    public static function getDetRet(){
        return Parametro::where('codigo','=',6)->where('codtab','<>','')->get();
    }





}
