<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Excel;

class ExcelController extends Controller
{
    //

    public static function reporteDeuda($deudas){
        $sheet->row(1, [
            'Item', 'RUC', 'RAZON SOCIAL', 'COMPRAS MN', 'SALDO MN','COMPRAS MN', 'SALDO MN'
        ]);
    }
}
