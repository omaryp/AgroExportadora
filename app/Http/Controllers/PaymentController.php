<?php

namespace App\Http\Controllers;
use View;
use Validator;
use Illuminate\Http\Request;
use App\Models\Payment;
use App\Models\Voucher;
use App\Models\ChronogramVoucher;

class PaymentController extends Controller
{
    const COMPROBANTE = 1;
    const DETRACCION = 2;
    const RETENCION = 3;

    public function index(){
        $pagos = Payment::orderBy('created_at', 'desc')->paginate(7);    
        $title = 'Pagos';
        $datos_vista = compact('pagos','title');
        return view('payment.index',$datos_vista);
    }

    public function create(){
        $title = 'Pago';
        $activo = TRUE;
        $datos_vista = compact('activo','title');
        return view('payment.form',$datos_vista);
    }


    public function tipo($codigo){
        $voucher = Voucher::where('id','=',$codigo)->where('estado_afectacion','=',0)->get(['detret'])->first();
        $parms = ParametroController::getCargaTipo($voucher->detret);
        $datos=['id_data'=>2,'data'=>$parms];
        return response()->json($datos);
    }

    public function comprobante($codigo) {
        $bancos = ParametroController::getBancos();
        $medios = ParametroController::getMedios();
        //estado 0 es por pagar // 1 es pagada.
        $cuotas = ChronogramVoucher::where('voucher_id','=',$codigo)->where('estado','=',0)->get(['nro_cuota']);
        $monto = ChronogramVoucher::where('voucher_id','=',$codigo)->get(['monto_cuota'])->first();
        $datos_vista = array('bancos'=>$bancos,'medios'=>$medios,'cuotas'=>$cuotas,'monto_cuota'=>$monto->monto_cuota);
        return View::make('payment.comprobante',$datos_vista);
    }

    public function detret($codigo) {
        $voucher = Voucher::find($codigo)->get(['detret','valordetret'])->first();
        $datos_vista = array('monto_cuota'=>$voucher->valordetret);
        switch ($voucher->detret+1) {
            case $this::RETENCION:
                return View::make('payment.retencion',$datos_vista);
            case $this::DETRACCION:
                return View::make('payment.detraccion',$datos_vista);
        }
    }

    public function store(){
        $data= request()->all();
        $tipo_pago = $data['tipo_pago']; 
        $reglas = [
            'moneda_comprobante'=>'nullable',
            'serie_comprobante'=>'nullable',
            'numero_comprobante'=>'nullable',
            'ruc_proveedor'=>'required|numeric',
            'razon_social'=>'required',
            'importe_comprobante'=>'required',
            'tipo_pago'=>'required|min:1',
            'fecha_pago'=>'required|date',
            'monto_pago'=>'required|numeric',
            'glosa'=>'nullable',
            'voucher_id'=>'required'];
        switch ($tipo_pago) {
            case $this::COMPROBANTE:
                $reglas['nro_cuota']='required|min:1';
                $reglas['medio_pago']='required';
                $reglas['codigo_banco']='required';
                $reglas['nro_doc_pago']='required';
                break;
            case $this::DETRACCION:
                $reglas['codigo_voucher_pago']='required';
                break;
            case $this::RETENCION:
                $reglas['serie_retencion']='required';
                $reglas['numero_retencion']='required';
                break;
        } 
        $validar = Validator::make($data, $reglas);
        if ($validar->passes()) {
            $voucher = Voucher::find($data['voucher_id']);
            $data['moneda_comprobante'] = $voucher->moneda;
            $data['serie_comprobante'] = $voucher->serie;
            $data['numero_comprobante'] = $voucher->numero;
            $data['serie_retencion'] = '0';
            $data['numero_retencion'] = '0';
            $pago = Payment::create($data);
            if ($tipo_pago == $this::COMPROBANTE)
                ChronogramVoucherController::actualizar_cuota($pago);
            return redirect()->route('payments.edit',['id' => $pago->id]);
        }else{
            if ($validar->fails()) {
                return redirect('/payments/create')
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
