@extends('layout')


@section('content')
    <fieldset class="form-group border p-3" @unless($activo) disabled @endunless>
        <legend class="col-sm-3">{{ $title }}</legend>
        <form action="@if(empty($voucher)) {{ url('vouchers') }} @else {{ url("vouchers/{$voucher->id}") }} @endif"  method="POST">
            @unless(empty($voucher)) 
                {{ method_field('PUT') }} 
            @endunless
            {!! csrf_field() !!}
            
            @if ($errors->any())
                @include('includes.error', ['errors' => $errors])
            @endif

            <div class="row">
                
                <div class="col-md-4 mb-3">
                    <label for="purchase_order_id">Orden de Compra</label>
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <button class="btn btn-primary form-control-sm" type="button" id="btn_buscar_orden">Buscar</button>
                        </div>
                        <input type="text" class="form-control form-control-sm " disabled id="purchase_order_id" name="purchase_order_id" placeholder="Código de Orden de Compra" @unless(empty($voucher)) value="{{ $voucher->purchase_order_id}}" @else value="{{ old('purchase_order_id') }}" @endunless aria-describedby="btn_buscar"/>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="proveedor">Proveedor</label>
                    <input type="text" class="form-control form-control-sm " disabled id="proveedor" name="proveedor" placeholder="Proveedor" @unless(empty($voucher)) value="{{ $voucher->ruc_proveedor }} - {{ $voucher->razon_social }}" @else value="{{ old('proveedor') }}" @endunless />
                    <input type="hidden" id="ruc_proveedor" name="ruc_proveedor" @unless(empty($voucher)) value="{{ $voucher->ruc_proveedor }}" @else value="{{ old('ruc_proveedor') }}" @endunless />
                    <input type="hidden" id="razon_social" name="razon_social" @unless(empty($voucher)) value="{{ $voucher->razon_social }}" @else value="{{ old('razon_social') }}" @endunless />
                </div>

                <div class="col-md-4 mb-3">
                    <label for="importe">Importe</label>
                    <input type="text" class="form-control form-control-sm " disabled id="importe" name="importe" placeholder="Monto del comprobante" @unless(empty($voucher)) value="{{ $voucher->importe }}" @else value="{{ old('importe') }}" @endunless />
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="tipo">Tipo Comprobante</label>
                    <div class="input-group">
                        @unless(empty($tipo_com))
                            <select name="tipo" id="tipo" class="form-control form-control-sm" >
                                <option value="0">Seleccionar Tipo Comprobante</option>
                                @foreach ($tipo_com as $parm)
                                    <option value="{{ $parm->codtab }}" @unless(empty($voucher)) @if( $voucher->tipo == $parm->codtab ) selected @endif @else @if(old('tipo') == $parm->codtab ) selected @endif @endif > {{ $parm->descor }}</option>    
                                @endforeach
                            </select>
                        @else
                            <input type="text" class="form-control form-control-sm " value="{{ $voucher->descor }}" />
                        @endunless
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="serie">Serie</label>
                    <input type="text" class="form-control form-control-sm" id="serie" name ="serie" placeholder="Serie del comprobante" @unless(empty($voucher)) value="{{ $voucher->serie }}" @else value="{{ old('serie') }}" @endunless/>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="numero">Número</label>
                    <input type="text" class="form-control form-control-sm" id="numero" name ="numero" placeholder="Número del comprobante" @unless(empty($voucher)) value="{{ $voucher->numero }}" @else value="{{ old('numero') }}" @endunless/>
                </div>
            </div>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="fecha">Fecha Emisión</label>
                    <input type="date" class="form-control form-control-sm" id="fecha_emision" name ="fecha_emision" placeholder="dd/mm/aaaa" @unless(empty($voucher)) value="{{ $voucher->fecha_emision }}" @else value="{{ old('fecha_emision') }}" @endunless/>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="moneda">Moneda</label>
                    <div class="input-group">
                        @unless(empty($monedas))
                            <select name="tipo" id="tipo" class="form-control form-control-sm" >
                                <option value="0">Seleccionar Moneda</option>
                                @foreach ($monedas as $parm)
                                    <option value="{{ $parm->codtab }}" @unless(empty($voucher)) @if( $voucher->moneda == $parm->codtab ) selected @endif @else @if(old('moneda') == $parm->codtab ) selected @endif @endif > {{ $parm->descor }}</option>    
                                @endforeach
                            </select>
                        @else
                            <input type="text" class="form-control form-control-sm " value="{{ $voucher->moneda }}" />
                        @endunless
                    </div>
                </div>
                
                <div class="col-md-3 mb-3">
                    <label for="forma_pago">Forma de Pago</label>
                    <input type="text" class="form-control form-control-sm" id="forma_pago" name="forma_pago" placeholder="Representante" @unless(empty($voucher)) value="{{ $voucher->forma_pago }}" @else value="{{ old('forma_pago') }}" @endunless/>
                </div>

                <div class="col-md-3 mb-3">
                    @if(empty($cronograma))
                        <button type="button" id="btn_calendarizar" class="btn btn-sm btn-primary border">Calendarizar</button>
                    @endif
                </div>

            </div>

            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="detret">Retención/Detracción</label>
                    <div class="input-group">
                        @unless(empty($redet))
                            <select name="detret" id="detret" class="form-control form-control-sm" >
                                <option value="0">Ninguno</option>
                                @foreach ($redet as $parm)
                                    <option value="{{ $parm->codtab }}" @unless(empty($voucher)) @if( $voucher->detret == $parm->codtab ) selected @endif @else @if(old('detret') == $parm->codtab ) selected @endif @endif > {{ $parm->descor }}</option>    
                                @endforeach
                            </select>
                        @else
                            <input type="text" class="form-control form-control-sm " value="{{ $voucher->detret }}" />
                        @endunless
                    </div>
                </div>
            </div>
            
            <div class="row">
                @if(!empty($cronograma))
                    <table class="table table-striped table-sm" id="tabla_prov">
                        <thead>
                            <tr>
                                <th scope="col">Nro. Cuota</th>
                                <th scope="col">Fecha Vencimiento</th>
                                <th scope="col">Fecha Pago</th>
                                <th scope="col">Monto Cuota</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cronograma as $cuota)
                                <tr>
                                    <td>{{ $cuota->nro_cuota }}</td>
                                    <td>{{ $cuota->fecha_cuota }}</td>
                                    <td>{{ $cuota->fecha_pago }}</td>
                                    <td>{{ $cuota->monto_cuota }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>     
                @endif
            </div>

            @if ($activo)
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group mr-2">
                        <button type="submit" class="btn btn-sm btn-primary border">Guardar</button>
                        <a href="{{ route('vouchers') }}" class="btn btn-sm btn-primary border">Salir</a>
                    </div>
                </div>    
            @endif
            
        </form>
    </fieldset>
    @unless ($activo)
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <a href="{{ route('vouchers') }}" class="btn btn-sm btn-primary border">Salir</a>
            </div>
        </div>    
    @endunless
@endsection