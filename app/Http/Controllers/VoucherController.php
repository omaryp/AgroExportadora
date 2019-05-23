<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Voucher;
use Validator;

class VoucherController extends Controller
{
    //
    const DETRACCION = 1;
    const RETENCION = 2;

    public function index(){
        $vouchers = Voucher::orderBy('fecha_emision', 'desc')->paginate(7);    
        $title = 'Comprobantes';
        $datos_vista = compact('vouchers','title');
        return view('voucher.index',$datos_vista);
    }

    public function create(){
        $title = 'Comprobante';
        $tipo_com= ParametroController::getTipoComprobante();
        $monedas = ParametroController::getMonedas();
        $redet = ParametroController::getDetRet();
        $forma_pago = ParametroController::getFormaPago();
        $activo = TRUE;
        $datos_vista = compact('activo','title','tipo_com','monedas','redet','forma_pago');
        return view('voucher.form',$datos_vista);
    }

    public function store(){
        $data= request()->all();
        $detret = $data['detret']; 
        $reglas = [
            'id'=>'nullable',
            'key'=>'unique:vouchers',
            'tipo'=>'required|numeric',
            'serie'=>'required|size:4|string',
            'numero'=>'required|digits_between:1,8|numeric',
            'moneda'=>'required',
            'fecha_emision'=>'required|date',
            'importe'=>'required|numeric',
            'importe_orden'=>'required|numeric',
            'detret'=>'required',
            'estado'=>'nullable',
            'forma_pago'=>'required',
            'fecuencia_pago'=>'nullable',
            'nro_cuotas'=>'nullable',
            'fecha_vencimiento'=>'nullable',
            'fecha_primer_pago'=>'nullable',
            'ruc_proveedor'=>'required|numeric',
            'razon_social'=>'required|string',
            'purchase_order_id'=>'required|string'];
            
        switch ($detret) {
            case $this::DETRACCION:
                # code...
                $reglas['valordetret']='required|numeric';
                $reglas['porvalordetret']='required|numeric';
                $reglas['subtotal']='required|numeric';
                break;
            
            case $this::RETENCION:
                $reglas['valordetret']='nullable';
                $reglas['porvalordetret']='nullable';
                $reglas['subtotal']='nullable';
                
                break;
        }
        $data['key']=VoucherController::getKey($data['serie'],$data['numero'],$data['moneda'],$data['tipo']);
        $data['id']=VoucherController::getCorrelativo();
        $validar = Validator::make($data, $reglas);

        //$nro_item = 0;
        //$codigo_orden='';
        if ($validar->passes()) {
            if($detret == $this::RETENCION){
                $dataRet = VoucherController::calcularRetencion($data['importe']);
                $data['valordetret'] = $detret['monto_retencion'];
                $data['porvalordetret'] = $detret['porcentaje'];
                $data['subtotal']= $data['importe'] - $detret['porcentaje'];  
            }
            $data['purchase_order_id']=str_pad($data['purchase_order_id'],10,"0",STR_PAD_LEFT);
            Voucher::create($data);
            return redirect()->route('vouchers.edit',['id' => $data['id']]);
        }else{
            if ($validar->fails()) {
                return redirect('/vouchers/create')
                            ->withErrors($validar)
                            ->withInput();
            }
        }
        
    }

    public static function calcularRetencion($monto_comprobante){
        $datos = array();
        $parm = ParametroController::getPorcentajeRet();    
        $por = $parm->valdec;
        $datos['porcentaje'] = $por;
        $datos['monto_retencion'] = $monto_comprobante*$por;
        return $datos;
    }

    public static function getKey($serie,$numero,$moneda,$tipo){
        return str_pad($tipo,2,"0",STR_PAD_LEFT).str_pad($moneda,2,"0",STR_PAD_LEFT).
               str_pad($serie,4,"0",STR_PAD_LEFT).str_pad($numero,8,"0",STR_PAD_LEFT);
    }

    public static function getCorrelativo(){
        $maximo = Voucher::max('id');
        return $maximo+1;
    }

    
    public function edit($codigo){
        $voucher = Voucher::select('id',
            'vouchers.tipo',
            'vouchers.serie',
            'vouchers.numero',
            'vouchers.moneda',
            'vouchers.fecha_emision',
            'vouchers.importe',
            'vouchers.importe_orden',
            'vouchers.detret',
            'vouchers.valordetret',
            'vouchers.porvalordetret',
            'vouchers.subtotal',
            'vouchers.estado',
            'vouchers.forma_pago',
            'vouchers.ruc_proveedor',
            'vouchers.razon_social',
            'vouchers.purchase_order_id')
           ->where('vouchers.id','=',$codigo)
           ->get()->first();
        $voucher->fecha_emision = date_format(date_create($voucher->fecha_emision), 'Y-m-d');
        $title = 'Comprobante';
        $tipo_com= ParametroController::getTipoComprobante();
        $monedas = ParametroController::getMonedas();
        $redet = ParametroController::getDetRet();
        $forma_pago = ParametroController::getFormaPago();
        $cronograma = ChronogramVoucherController::getCronograma($codigo);

        $activo = TRUE;
        $datos_vista = compact('activo','title','tipo_com','monedas','redet','forma_pago','voucher','cronograma');
        return view('voucher.form',$datos_vista);
    }

}
