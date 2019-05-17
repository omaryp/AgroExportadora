<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voucher;

class VoucherController extends Controller
{
    //
    public function index(){
        $vouchers = Voucher::orderBy('fecha_emision', 'desc')->paginate(7);    
        $title = 'Comprobantes';
        $tipo_com= ParametroController.getTipoComprobante();
        $monedas = ParametroController.getMonedas();
        $redet = ParametroController.getDetRet();

        $datos_vista = compact('vouchers','title','tipo_com','monedas','redet');

        return view('voucher.index',$datos_vista);
    }

    public function create(){
        $title = 'Comprobante';
        $activo = TRUE;
        return view('voucher.form',compact('activo','title'));
    }
}
