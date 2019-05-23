<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\ChronogramVoucher;
use App\Models\Voucher;
use Validator;

class ChronogramVoucherController extends Controller
{
    //
    public function store(){
        $data= request()->all();
        $reglas = [
            'voucher_id'=>'nullable',
            'nro_cuotas'=>'required|numeric',
            'frecuencia_pago'=>'required|numeric',
            'fecha_primer_pago'=>'required|date',
        ];
        $validar = Validator::make($data, $reglas);
        if ($validar->passes()) {
            $this::generar_cronograma($data['voucher_id'],$data['nro_cuotas'],$data['frecuencia_pago'],$data['fecha_primer_pago']);
            return response()->json([
                'success' => true,
            ], 200);
        }else {
            return response()->json([
                'success' => false,
                'mensajes' => $validar->errors()->all(),
            ], 200);
        }
    }

    public static function generar_cronograma($voucher_id,$nro_cuotas,$frecuencia,$fecha_primer_pago){
        $voucher = Voucher::find($voucher_id);
        $monto = $voucher->importe;
        $cuota = 1;
        $fecha_cuota =  date($fecha_primer_pago);
        $monto_cuota = $voucher->importe/$nro_cuotas;
        while($cuota<=$nro_cuotas){
            $cuota_cronograma = new ChronogramVoucher();
            $cuota_cronograma->fecha_cuota=$fecha_cuota;
            $cuota_cronograma->nro_cuota = $cuota;
            $cuota_cronograma->monto_cuota = $monto_cuota;
            $cuota_cronograma->vouchers_id = $voucher_id;
            $fecha_cuota = date("Y-m-d",strtotime($fecha_cuota."+ {$frecuencia} days"));
            $cuota += 1;
            $cuota_cronograma->save();
        }
        $voucher->fecuencia_pago = $frecuencia;
        $voucher->nro_cuotas = $nro_cuotas;
        $voucher->fecha_vencimiento = $fecha_cuota;
        $voucher->save();
    }

    public static function getCronograma($voucher_id){
        $cronograma = ChronogramVoucher::select('nro_cuota',
        'fecha_cuota',
        'fecha_pago',
        'mora',
        'monto_cuota',
        'vouchers_id')
        ->where('vouchers_id','=',$voucher_id)
        ->orderBy('nro_cuota')->get();        
        return $cronograma;
    }
}
