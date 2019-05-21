<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\PurchaseOrderDetail;
use Validator;

class PurchaseOrderDetailController extends Controller
{
    public function store(){
        $data= request()->all();
        $reglas = [
            'cantidad'=>'required|numeric',
            'unidad_medida'=>'required|numeric',
            'descripcion'=>'required', 
            'precio_unitario'=>'required|numeric',
            'total' => 'required|numeric',
            'purchase_order_id' => 'required',
        ];
        $validar = Validator::make($data, $reglas);
        $nro_item = 0;
        $codigo_orden='';
        if ($validar->passes()) {
            $detail = new PurchaseOrderDetail();
            $codigo_orden = str_pad($data['purchase_order_id'],10,"0",STR_PAD_LEFT);
            $detail->purchase_order_id = $codigo_orden;
            $nro_item = PurchaseOrderDetailController::getCodigoItem($detail->purchase_order_id);
            $detail->numero_item= $nro_item;
            $detail->cantidad = $data['cantidad'];
            $detail->unidad_medida = $data['unidad_medida'];
            $detail->descripcion = $data['descripcion'];
            $detail->precio_unitario = $data['precio_unitario'];
            $detail->total = $data['total'];
            $detail->save();
            PurchaseOrderController::actualizar_total($codigo_orden,$data['total']);
            return response()->json([
                'success' => true,
                'id' => $nro_item,
            ], 200);
        }else {
            return response()->json([
                'success' => false,
                'mensajes' => $validar->errors()->all(),
            ], 200);
        }
    }

    public static function getDetalleOrden($codigo){
        $details = PurchaseOrderDetail::select('numero_item', 'cantidad','unidad_medida','descripcion','precio_unitario','total')
        ->where('purchase_order_id','=',$codigo)
        ->orderBy('numero_item')->get();        
        return $details;
    }

    public static function getCodigoItem($codigo_orden){
        $maximo = PurchaseOrderDetail::where('purchase_order_id',$codigo_orden)->max('numero_item');
        return $maximo+1;
    }
}
