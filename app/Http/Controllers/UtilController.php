<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DateTime;

class UtilController extends Controller
{
    //
    public static function formatoFecha($fecha,$formato){
        $fecha = DateTime::createFromFormat($formato, $fecha); 
        dd(DateTime::getLastErrors());
        return $fecha->format($formato);
    }
}
