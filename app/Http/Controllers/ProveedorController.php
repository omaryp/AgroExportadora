<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Proveedor;
use Illuminate\Validation\Rule;

class ProveedorController extends Controller{

    public function index(){
        $provs = Proveedor::orderBy('razon_social', 'asc')->paginate(7);    
        $title = 'Listado de Proveedores';
        return view('proveedores.index',compact('provs','title'));
    }

    public function search($valor){
        $provs = Proveedor::where('razon_social', 'like',$valor.'%')
                            ->orWhere('ruc','like',$valor.'%')
                            ->take(5)
                            ->get(['id','ruc','razon_social']);
        return response()->json($provs);
    }

    public function show(Proveedor $prov){
        $title = 'Proveedor';
        $activo = FALSE;
        return view('proveedores.form',compact('prov','activo','title'));
    }

    public function edit(Proveedor $prov){
        $title = 'Proveedor';
        $activo = TRUE;
        return view('proveedores.form',compact('prov','activo','title'));
    }

    public function create(){
        $title = 'Proveedor';
        $activo = TRUE;
        return view('proveedores.form',compact('activo','title'));
    }

    public function store(){
        $data = request()->validate([
            'razon_social'=>'required|unique:proveedores,razon_social', 
            'ruc'=>'required|digits:11|unique:proveedores,ruc',
            'email'=>'required|email|unique:proveedores,email',
            'direccion'=>'nullable',
            'representante' => 'nullable',
            'telefono' => 'nullable',
            'referencias' => 'nullable',
        ]);
        Proveedor::create([
            'razon_social' => $data['razon_social'],
            'ruc' => $data['ruc'],
            'representante' => $data['representante'],
            'email' => $data['email'],
            'telefono' => $data['telefono'],
            'direccion' => $data['direccion'],
            'referencias' => $data['referencias'],
        ]);
        return redirect()->route('proveedores.create');
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
    }

}
