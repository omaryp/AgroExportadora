<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EconomicRequestDetail;
use Validator;

class EconomicRequestDetailController extends Controller
{
    //
    public static function getDetalleRequest($codigo){
        $details = EconomicRequestDetail::select('numero_item', 'cantidad','descripcion','importe')
        ->where('economic_request_id','=',$codigo)
        ->orderBy('numero_item')->get();        
        return $details;
    }

    public function store(){
        $data= request()->all();
        $reglas = [
            'cantidad'=>'required|numeric',
            'descripcion'=>'required|string', 
            'importe' => 'required|numeric',
            'economic_request_id' => 'required',
        ];
        $validar = Validator::make($data, $reglas);
        $nro_item = 0;
        $codigo_request='';
        if ($validar->passes()) {
            $detail = new EconomicRequestDetail();
            $codigo_request = str_pad($data['economic_request_id'],10,"0",STR_PAD_LEFT);
            $detail->economic_request_id = $codigo_request;
            $nro_item = $this::getCodigoItem($detail->economic_request_id);
            $detail->numero_item= $nro_item;
            $detail->cantidad = $data['cantidad'];
            $detail->descripcion = $data['descripcion'];
            $detail->importe = $data['importe'];
            $detail->save();
            EconomicRequestController::actualizar_total($codigo_request,$data['importe']);
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

    public static function getCodigoItem($codigo_request){
        $maximo = EconomicRequestDetail::where('economic_request_id',$codigo_request)->max('numero_item');
        return $maximo+1;
    }
}
