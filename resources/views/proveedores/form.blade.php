@extends('layout')


@section('content')
    <fieldset class="form-group border p-3" @unless($activo) disabled @endunless>
        <legend class="col-form-label col-sm-2 pt-0 ">{{ $title }}</legend>
        <form action="@if(empty($prov)) {{ url("proveedores") }} @else {{ url("proveedores/{$prov->id}") }} @endif" method="POST">
            @unless(empty($prov)) 
                {{ method_field('PUT') }} 
            @endunless
            {!! csrf_field() !!}
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="ruc">Ruc</label>
                    <input type="text" class="form-control form-control-sm" name = "ruc" id="ruc" placeholder="Ruc" @unless(empty($prov)) value="{{ $prov->ruc }}" @else value="{{ old('ruc') }}" @endunless/>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="telefono">Teléfono</label>
                    <input type="text" class="form-control form-control-sm" id="telefono" name ="telefono" placeholder="Teléfono" @unless(empty($prov)) value="{{ $prov->telefono }}" @else value="{{ old('telefono') }}" @endunless/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="raz_social">Razón Social</label>
                    <div class="input-group">
                        <input type="text" class="form-control form-control-sm" id="raz_social" name="razon_social" placeholder="Razón Social" @unless(empty($prov)) value="{{ $prov->razon_social }}" @else value="{{ old('razon_social') }}" @endunless/>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="representante">Representante</label>
                    <div class="input-group">
                        <input type="text" class="form-control form-control-sm" id="representante" name="representante" placeholder="Representante" @unless(empty($prov)) value="{{ $prov->representante }}" @else value="{{ old('representante') }}" @endunless/>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="email">Correo Electrónico</label>
                    <div class="input-group">
                        <input type="email" class="form-control form-control-sm" id="email" name="email" placeholder="you@example.com" @unless(empty($prov)) value="{{ $prov->email }}" @else value="{{ old('email') }}" @endunless/>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="direccion">Dirección</label>
                    <div class="input-group">
                        <input type="text" class="form-control form-control-sm" id="direccion" name ="direccion" placeholder="Dirección" @unless(empty($prov)) value="{{ $prov->direccion }}" @else value="{{ old('direccion') }}" @endunless/>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="refere">Referencias</label>
                <div class="input-group">
                    <textarea class="form-control form-control-sm"  name="referencias" id="refere" cols="20" rows="5">@unless(empty($prov)) {{ $prov->referencias }}  @else {{ old('referencias') }} @endunless</textarea>
                </div>
            </div> 

            @if ($activo)
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group mr-2">
                        <button type="submit" class="btn btn-primary border">Guardar</button>
                        <a href="{{ route('proveedores') }}" class="btn btn-primary border">Salir</a>
                    </div>
                </div>    
            @endif
            
        </form>
    </fieldset>
    @unless ($activo)
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <a href="{{ route('proveedores') }}" class="btn btn-primary border">Salir</a>
            </div>
        </div>    
    @endunless
@endsection