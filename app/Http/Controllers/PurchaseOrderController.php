<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PurchaseOrder;
use DateTime;

class PurchaseOrderController extends Controller
{
    public function index(){
        //$provs= Proveedor::all();
        //$orders = PurchaseOrder::orderBy('created_at', 'desc')->paginate(7);    
        $orders = PurchaseOrder::select('purchase_orders.id', 'proveedores.razon_social','purchase_orders.fecha_emision','purchase_orders.total','parametros.descor')
                ->join('proveedores', 'purchase_orders.proveedor_id', '=', 'proveedores.id')
                ->join('parametros', 'parametros.codtab','=','purchase_orders.estado')
                ->where('parametros.codigo','=',3)
                ->where('parametros.codtab','<>',"''")
                ->orderBy('purchase_orders.created_at', 'desc')
                ->paginate(7);
        $title = 'Ordernes de Compra';  
        return view('purchaseorder.index',compact('orders','title'));
    }

    public function create(){
        $title = 'Orden de Compra';
        $activo = TRUE;
        $forma_pago = ParametroController::getFormaPago();
        $des_recurso = ParametroController::getDestinosRecursos();
        $orden_codigo = Static::getCodigoOrden();
        $datos_vista = compact('activo','title','forma_pago','des_recurso','orden_codigo');
        return view('purchaseorder.form',$datos_vista);
    }

    public static function getCodigoOrden(){
        $maximo = PurchaseOrder::where('anio',date('Y'))->max('numero');
        $datos['numero'] = $maximo+1;
        $datos['anio'] = date('Y');
        return $datos;
    }

    public function store(){
        $data = request()->validate([
            'numero'=>'nullable',
            'anio'=>'nullable',
            'fecha_emision'=>'required|date_format:Y-m-d', 
            'destino'=>'required',
            'condicion_pago' => 'required',
            'plazo_dias' => 'required|numeric',
            'almacen' => 'required',
            'direccion' => 'required',
            'condiciones_entrega' => 'nullable',
            'proveedor_id' => 'required|numeric',
        ]);
            
        $ordenCompra = new PurchaseOrder();
        $ordenCompra->id = str_pad($data['numero'],6,"0",STR_PAD_LEFT).$data['anio'];
        $ordenCompra->numero=$data['numero'];
        $ordenCompra->anio=$data['anio'];
        $ordenCompra->fecha_emision=date_format(date_create($data['fecha_emision']), 'Y-m-d H:i:s');
        $ordenCompra->destino=$data['destino'];
        $ordenCompra->condicion_pago=$data['condicion_pago'];
        $ordenCompra->plazo_dias=$data['plazo_dias'];
        $ordenCompra->almacen=$data['almacen'];
        $ordenCompra->direccion=$data['direccion'];
        $ordenCompra->condiciones_entrega=$data['condiciones_entrega'];
        $ordenCompra->proveedor_id=$data['proveedor_id'];
        $ordenCompra->save();
        return redirect()->route('purchaseorders.edit',['codigo' => str_pad($data['numero'],6,"0",STR_PAD_LEFT).$data['anio']]);
    }
 
    public function show($codigo){
        $order = PurchaseOrder::select(
                 'purchase_orders.id', 
                 'proveedores.ruc', 
                 'proveedores.razon_social',
                 'purchase_orders.fecha_emision',
                 'purchase_orders.total', 
                 'purchase_orders.condicion_pago',
                 'purchase_orders.almacen',
                 'purchase_orders.direccion',
                 'purchase_orders.condiciones_entrega',
                 'parametros.descor')
                ->join('proveedores', 'purchase_orders.proveedor_id', '=', 'proveedores.id')
                ->join('parametros', 'parametros.codtab','=','purchase_orders.estado')
                ->where('parametros.codigo','=',1)
                ->where('parametros.codtab','<>',"''")
                ->where('purchase_orders.id','=',$codigo)
                ->get()->first();
        $title = 'Orden de Compra';
        $activo = FALSE;
        return view('purchaseorder.form',compact('order','activo','title'));
    }

    public function formatoFecha($fecha,$formato){
        
    }

    public function edit($codigo){
        $order = PurchaseOrder::select(
            'purchase_orders.id', 
            'proveedores.ruc', 
            'proveedores.razon_social',
            'purchase_orders.fecha_emision',
            'purchase_orders.total',
            'purchase_orders.condicion_pago',
            'purchase_orders.destino',
            'purchase_orders.almacen',
            'purchase_orders.direccion',
            'purchase_orders.condiciones_entrega')
           ->join('proveedores', 'purchase_orders.proveedor_id', '=', 'proveedores.id')
           ->where('purchase_orders.id','=',$codigo)
           ->get()->first();
        $order->fecha_emision = date_format(date_create($order->fecha_emision), 'Y-m-d');
        $title = 'Orden de Compra';
        $activo = TRUE;
        $forma_pago = ParametroController::getFormaPago();
        $des_recurso = ParametroController::getDestinosRecursos();
        $datos_vista = compact('activo','title','forma_pago','des_recurso','order');
        return view('purchaseorder.form',$datos_vista);
    }

   /*

    

    public function update(Proveedor $prov){
        $data = request()->validate([
            'razon_social'=>['required',Rule::unique('proveedores','razon_social')->ignore($prov->id)], 
            'ruc'=>['required','digits:11',Rule::unique('proveedores','ruc')->ignore($prov->id)],
            'email'=>['required','email',Rule::unique('proveedores','email')->ignore($prov->id)],
            'direccion'=>['required',Rule::unique('proveedores','email')->ignore($prov->id)],
            'representante' => 'nullable',
            'telefono' => 'nullable',
            'referencias' => 'nullable',
        ]);
        $prov->update($data);

        return redirect()->route('proveedores.edit',['prov'=>$prov]);
    }

    public function destroy(Proveedor $prov){
        $data = request()->all();
        $data['estado']= '2';
        $prov->update($data);

        return redirect()->route('proveedores');
    }*/
}
