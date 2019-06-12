<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\EconomicRequest;

class EconomicRequestController extends Controller
{
    //
    public function index(){   
        $requests = 
        EconomicRequest::select('economic_requests.id','economic_requests.solicitadopor',
                                'economic_requests.fecha_emision','economic_requests.total','parametros.descor')
                ->join('parametros', 'parametros.codtab','=','economic_requests.estado')
                ->where('parametros.codigo','=',3)
                ->where('parametros.codtab','<>',"''")
                ->orderBy('economic_requests.created_at', 'desc')
                ->paginate(7);
        $title = 'Listado de Requerimientos Económicos';  
        return view('economicrequest.index',compact('requests','title'));
    }

    public function create(){
        $title = 'Nuevo Requerimiento Económico';
        $activo = TRUE;
        $request_codigo = $this::getCodigoRequerimiento();
        $datos_vista = compact('activo','title','request_codigo');
        return view('economicrequest.form',$datos_vista);
    }

    public static function getCodigoRequerimiento(){
        $maximo = EconomicRequest::where('anio',date('Y'))->max('numero');
        $datos['numero'] = $maximo+1;
        $datos['anio'] = date('Y');
        return $datos;
    }

    public function store(){
        $data = request()->validate([
            'numero'=>'nullable',
            'anio'=>'nullable',
            'fecha_emision'=>'required|date_format:Y-m-d', 
            'solicitadopor'=>'required|string',
            'dirigidoa' => 'required|string',
            'concepto' => 'required|string',
        ]);
            
        $request = new EconomicRequest();
        $request->id = str_pad($data['numero'],6,"0",STR_PAD_LEFT).$data['anio'];
        $request->numero=$data['numero'];
        $request->anio=$data['anio'];
        $request->estado = 1;
        $request->fecha_emision=date_format(date_create($data['fecha_emision']), 'Y-m-d H:i:s');
        $request->dirigidoa=$data['dirigidoa'];
        $request->solicitadopor=$data['solicitadopor'];
        $request->concepto=$data['concepto'];
        $request->save();
        return redirect()->route('economicrequests.edit',['codigo' => str_pad($data['numero'],6,"0",STR_PAD_LEFT).$data['anio']]);
    }

    public function edit($codigo){
        $request = EconomicRequest::select(
            'economic_requests.id', 
            'economic_requests.numero', 
            'economic_requests.anio',
            'economic_requests.fecha_emision',
            'economic_requests.total',
            'economic_requests.dirigidoa',
            'economic_requests.solicitadopor',
            'economic_requests.concepto')
           ->where('economic_requests.id','=',$codigo)
           ->get()->first();
        $request->fecha_emision = date_format(date_create($request->fecha_emision), 'Y-m-d');
        $title = 'Actualizar Requerimiento Económico';
        $activo = TRUE;
        $details = EconomicRequestDetailController::getDetalleRequest($codigo);
        $datos_vista = compact('activo','title','request','details');
        return view('economicrequest.form',$datos_vista);
    }

    public function show($codigo){
        $request = EconomicRequest::select(
                 'economic_requests.id', 
                 'economic_requests.fecha_emision',
                 'economic_requests.total', 
                 'economic_requests.solicitadopor',
                 'economic_requests.dirigidoa',
                 'economic_requests.concepto',)
                ->where('economic_requests.id','=',$codigo)
                ->get()->first();

        $request->fecha_emision = date_format(date_create($request->fecha_emision), 'Y-m-d');
        $title = 'Consulta Requerimiento Económico';
        $details = EconomicRequestDetailController::getDetalleRequest($codigo);
        $activo = FALSE;
        return view('economicrequest.form',compact('request','activo','title','details'));
    }

    
    public static function actualizar_total($codigo,$monto){
        $request=EconomicRequest::where('id','=',$codigo)->get()->first();
        $request->total+=$monto;
        $request->save();
    }

    public function update($codigo){
        $data = request()->validate([
            'numero'=>'nullable',
            'anio'=>'nullable',
            'fecha_emision'=>'required|date_format:Y-m-d', 
            'solicitadopor'=>'required|string',
            'dirigidoa' => 'required|string',
            'concepto' => 'required|string',
        ]);    
        $request=EconomicRequest::where('id','=',$codigo)->get()->first();
        $request->update($data);
        return redirect()->route('economicrequests.edit',['codigo' =>$codigo]);
    }
}
