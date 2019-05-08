<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PurchaseOrder;
use DateTime;

class PurchaseOrderController extends Controller
{
    public function index(){
        //$provs= Proveedor::all();
        $orders = PurchaseOrder::orderBy('created_at', 'desc')->paginate(7);    
        $title = 'Ordernes de Compra';
        return view('purchaseorder.index',compact('orders','title'));
    }

    public function create(){
        $title = 'Orden de Compra';
        $activo = TRUE;
        $forma_pago = ParametroController::getFormaPago();
        $des_recurso = ParametroController::getDestinosRecursos();
        $codigo = Static::getCodigoOrden();
        
        $datos_vista = compact('activo','title','forma_pago','des_recurso','codigo');
        
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

        $data['id'] = str_pad($data['numero'],6,"0",STR_PAD_LEFT).$data['anio'];
        $data['fecha_emision'] = $data['fecha_emision'].' 00:00:00';
        $fecha = DateTime::createFromFormat('Y-m-d H:i:s', $data['fecha_emision']); 
        $data['fecha_emision'] = $fecha->format('Y-m-d H:i:s');
        PurchaseOrder::create($data);
        return redirect()->route('purchaseorders.create');
    }

   
    /*public function show(Proveedor $prov){
        $title = 'Proveedor';
        $activo = FALSE;
        return view('proveedores.form',compact('prov','activo','title'));
    }

    public function edit(Proveedor $prov){
        $title = 'Proveedor';
        $activo = TRUE;
        return view('proveedores.form',compact('prov','activo','title'));
    }

   

    

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
