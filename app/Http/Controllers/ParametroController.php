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

    public static function getTipoAfectacion(){
        return Parametro::where('codigo','=',6)->where('codtab','<>','')->get();
    }

    public static function getPorcentajeRet(){
        return Parametro::where('codigo','=',7)->where('codtab','=','01')->get()->first();
    }

    public static function getMontoRetencion(){
        return Parametro::where('codigo','=',7)->where('codtab','=','02')->get()->first();
    }

    public static function getMontoDetraccion(){
        return Parametro::where('codigo','=',7)->where('codtab','=','03')->get()->first();
    }
    
    public static function getTipoPago(){
        return Parametro::where('codigo','=',8)->where('codtab','<>','')->get();
    }

    public static function getBancos(){
        return Parametro::where('codigo','=',9)->where('codtab','<>','')->get();
    }

    public static function getMedios(){
        return Parametro::where('codigo','=',10)->where('codtab','<>','')->get();
    }

    public static function getCargaTipo($detret){
        return  Parametro::where('codigo','=',8)->wherein('codtab',['01',str_pad($detret+1,2,"0",STR_PAD_LEFT)])->get(['codtab','descor']);
    }
}
