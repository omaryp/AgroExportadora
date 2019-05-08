@extends('layout')

@section('title',"Crear usuario")

@section('content')
    <fieldset class="form-group border p-3" @unless($activo) disabled @endunless>
        <legend class="col-form-label col-sm-3 pt-0 ">{{ $title }}</legend>
        <form action="@if(empty($order)) {{ url("purchaseorders") }} @else {{ url("purchaseorders/{$order->codigo}") }} @endif" method="POST">
            @unless(empty($order)) 
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
            <input type="hidden" name="numero" value  = "{{ $codigo['numero'] }}"/>
            <input type="hidden" name="anio" value  = "{{ $codigo['anio'] }}"/>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="codigo" >Código de Orden</label>
                    <input type="text" disabled class="form-control form-control-sm" name = "codigo" id="codigo" placeholder="Example 00000012018" @unless(empty($order)) value="{{ $order->codigo }}" @else value="{{ str_pad($codigo['numero'],6,"0",STR_PAD_LEFT).$codigo['anio'] }}" @endunless/>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="fecha">Fecha Emisión</label>
                    <input type="date" class="form-control form-control-sm" id="fecha_emision" name ="fecha_emision" placeholder="dd/mm/aaaa" @unless(empty($order)) value="{{ $order->created_at }}" @else value="{{ old('fecha') }}" @endunless/>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="proveedor">Proveedor</label>
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <button class="btn btn-primary form-control-sm" type="button" id="btn_buscar">Buscar</button>
                        </div>
                        <input type="text" class="form-control form-control-sm " disabled id="proveedor" name="proveedor" placeholder="Proveedor" @unless(empty($order)) value="{{ $prov->ruc }} - {{ $prov->razon_social }}" @else value="{{ old('proveedor') }}" @endunless aria-describedby="btn_buscar"/>
                        <input type="hidden" id="proveedor_id" name="proveedor_id" @unless(empty($order)) value="{{ $order->proveedor_id }}" @else value="{{ old('proveedor_id') }}" @endunless />
                    </div>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="destino">Destino</label>
                    <div class="input-group">
                        <select name="destino" id="destino" class="form-control form-control-sm" >
                            <option value="0">Seleccionar Destino</option>
                            @foreach ($des_recurso as $des)
                                <option value="{{ $des->codtab }}" @unless(empty($order)) @if($order->destino == $des->codtab ) selected @endif @else @if(old('destino') == $des->codtab ) selected @endif @endif >{{ $des->descor }}</option>    
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="condicion_pago">Forma de pago</label>
                    <div class="input-group">
                        <select name="condicion_pago" id="condicion_pago" class="form-control form-control-sm">
                            <option value="0">Forma de Pago</option>
                            @foreach ($forma_pago as $forma)
                                <option value="{{ $forma->codtab }}" @unless(empty($order)) @if($order->destino == $des->codtab ) selected @endif @else @if(old('destino') == $des->codtab ) selected @endif @endif>{{ $forma->descor }}</option>    
                            @endforeach
                        </select>
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="plazo_dias">Plazo de Entrega</label>
                    <div class="input-group">
                        <input type="text" class="form-control form-control-sm" id="plazo_dias" name ="plazo_dias" placeholder="Plazo" @unless(empty($order)) value="{{ $order->plazo_dias }}" @else value="{{ old('plazo_dias') }}" @endunless/>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="almacen">Almacen</label>
                    <div class="input-group">
                        <input type="text" class="form-control form-control-sm" id="almacen" name ="almacen" placeholder="Almacen" @unless(empty($order)) value="{{ $order->almacen}}" @else value="{{ old('almacen') }}" @endunless/>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="direccion">Dirección</label>
                    <div class="input-group">
                        <input type="text" class="form-control form-control-sm" id="direccion" name ="direccion" placeholder="Dirección" @unless(empty($order)) value="{{ $order->direccion}}" @else value="{{ old('direccion') }}" @endunless/>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="condiciones">Condiciones de entrega</label>
                <div class="input-group">
                    <input type="text" class="form-control form-control-sm" id="condiciones" name ="condiciones_entrega" placeholder="Condiciones de entrega" @unless(empty($order)) value="{{ $order->condiciones_entrega }}"  @else value="{{ old('condiciones_entrega') }}" @endunless/>
                </div>
            </div> 

            @if ($activo)
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group mr-2">
                        <button type="submit" class="btn btn-primary border">Guardar</button>
                        <button type="button" class="btn btn-primary border" data-toggle="modal" data-target="#exampleModal">
                                Detalle
                        </button>
                        <a href="{{ route('purchaseorders') }}" class="btn btn-primary border">Salir</a>
                    </div>
                </div>    
            @endif
            
        </form>
    </fieldset>
    @include('proveedores.search')
    @unless ($activo)
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <a href="{{ route('purchaseorders') }}" class="btn btn-primary border">Salir</a>
            </div>
        </div>    
    @endunless
@endsection

@section('script')
<script >
    $(document).ready(function(){
        $( "#proveedor_name" ).keyup(function(e) {
            limpiarTabla();
            searchProveedor($( "#proveedor_name" ).val());
        });

        $( "#btn_buscar" ).click(function() {
            $( "#proveedor_name" ).val('');
            limpiarTabla();
            $('#md_search').modal('show');
        });

        $( "#btn_buscar" ).click(function() {
            $( "#proveedor_name" ).val('');
            limpiarTabla();
            $('#md_search').modal('show');
        });

        $( "tbody").on("click", "a.sel",function(){
            $( "#proveedor_id" ).val($(this).attr('val_id'));
            $( "#proveedor" ).val($(this).attr('val_ruc')+' - '+$(this).attr('val_razon'));
            $( "#md_search" ).modal('hide');
        });
    });

    function searchProveedor(valor){
        ajax("{{ url('proveedores/search') }}",valor);
    }

    function ajax(ruta,data){
        $.getJSON( ruta+='/'+data , {_token: '{!! csrf_token() !!}'})
        .done(function( data, textStatus, jqXHR ) {
            data.forEach(prov => {
                $("#tabla_prov tbody" ).append(
                    '<tr> <td> '+prov.id+'</td>'+
                    '<td> '+prov.ruc+'</td> '+ 
                    '<td>'+prov.razon_social+'</td>'+
                    '<td> <a class="sel badge badge-primary" href="#" val_ruc = "'+prov.ruc+'" val_id="'+prov.id+'" val_razon="'+prov.razon_social+'" >Seleccionar</a></td>'+
                    '</tr>');
            });
        })
        .fail(function( jqXHR, textStatus, errorThrown ) {
            if ( console && console.log ) {
                console.log( "Algo ha fallado: " +  textStatus);
            }
        });
    }   

    function limpiarTabla(){
        $("#tabla_prov tbody tr" ).remove();
    }
    
</script>
@endsection