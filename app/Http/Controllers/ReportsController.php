<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class ReportsController extends Controller
{
    //
    //reporte de deudas por pagar
    public function deudasporpagar(){
        $cuentas = $this->total_deudas();
        $title = 'Deudas por Proveedor';  
        return view('reports.debts',compact('cuentas','title'));
    }

    public static function total_deudas(){
        DB::statement(DB::raw('set @row:=0'));
        return DB::table('proveedores')
        ->select(
            DB::raw(' @row:=@row+1,proveedores.ruc,proveedores.razon_social ,
            (SELECT SUM(importe) FROM vouchers WHERE ruc_proveedor = proveedores.ruc and moneda = 1) as comprasmn,
            (SELECT SUM(importe-total_pagado) FROM vouchers WHERE ruc_proveedor = proveedores.ruc and moneda = 1) as saldomn,
            (SELECT SUM(importe) FROM vouchers WHERE ruc_proveedor = proveedores.ruc and moneda = 2) as comprasme,
            (SELECT SUM(importe-total_pagado) FROM vouchers WHERE ruc_proveedor = proveedores.ruc and moneda = 2) as saldome'))
        ->get();
    } 
}
