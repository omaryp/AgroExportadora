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
            <input type="hidden" name="id" id="id" @unless(empty($voucher)) value="{{ $voucher->id}}" @else value="{{ old('id') }}" @endunless  >
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="purchase_order">Orden de Compra</label>
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <button class="btn btn-primary form-control-sm" type="button" id="btn_buscar_orden">Buscar</button>
                        </div>
                        <input type="text" class="form-control form-control-sm " disabled id="purchase_order" name="purchase_order" placeholder="Código de Orden de Compra" @unless(empty($voucher)) value="{{ $voucher->purchase_order_id}}" @else value="{{ old('purchase_order_id') }}" @endunless aria-describedby="btn_buscar"/>
                        <input type="hidden" id="purchase_order_id" name="purchase_order_id"  @unless(empty($voucher)) value="{{ $voucher->purchase_order_id}}" @else value="{{ old('purchase_order_id') }}" @endunless />
                    </div>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="proveedor">Proveedor</label>
                    <input type="text" class="form-control form-control-sm " disabled id="proveedor" name="proveedor" placeholder="Proveedor" @unless(empty($voucher)) value="{{ $voucher->ruc_proveedor }} - {{ $voucher->razon_social }}" @else value="{{ old('proveedor') }}" @endunless />
                    <input type="hidden" id="ruc_proveedor" name="ruc_proveedor" @unless(empty($voucher)) value="{{ $voucher->ruc_proveedor }}" @else value="{{ old('ruc_proveedor') }}" @endunless />
                    <input type="hidden" id="razon_social" name="razon_social" @unless(empty($voucher)) value="{{ $voucher->razon_social }}" @else value="{{ old('razon_social') }}" @endunless />
                </div>

                <div class="col-md-4 mb-3">
                    <label for="importe_or">Importe Orden de Compra</label>
                    <input type="text" class="form-control form-control-sm " disabled id="importe_or" name="importe_or" placeholder="Monto de la orden de compra" @unless(empty($voucher)) value="{{ $voucher->importe_orden }}" @else value="{{ old('importe_orden') }}" @endunless />
                    <input type="hidden" id="importe_orden" name="importe_orden"  @unless(empty($voucher)) value="{{ $voucher->importe_orden }}" @else value="{{ old('importe_orden') }}" @endunless />
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-3 mb-3">
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
                <div class="col-md-3 mb-3">
                    <label for="serie">Serie</label>
                    <input type="text" class="form-control form-control-sm" id="serie" name ="serie" placeholder="Serie del comprobante" @unless(empty($voucher)) value="{{ $voucher->serie }}" @else value="{{ old('serie') }}" @endunless/>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="numero">Número</label>
                    <input type="text" class="form-control form-control-sm" id="numero" name ="numero" placeholder="Número del comprobante" @unless(empty($voucher)) value="{{ $voucher->numero }}" @else value="{{ old('numero') }}" @endunless/>
                </div>

                <div class="col-md-3 mb-3">
                    <label for="importe">Importe</label>
                    <input type="text" class="form-control form-control-sm" id="importe" name ="importe" placeholder="Importe del comprobante" @unless(empty($voucher)) value="{{ $voucher->importe }}" @else value="{{ old('importe') }}" @endunless/>
                </div>

            </div>
            <div class="row align-items-end">
                <div class="col-md-2 mb-3">
                    <label for="fecha">Fecha Emisión</label>
                    <input type="date" class="form-control form-control-sm" id="fecha_emision" name ="fecha_emision" placeholder="dd/mm/aaaa" @unless(empty($voucher)) value="{{ $voucher->fecha_emision }}" @else value="{{ old('fecha_emision') }}" @endunless/>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="moneda">Moneda</label>
                    <div class="input-group">
                        @unless(empty($monedas))
                            <select name="moneda" id="moneda" class="form-control form-control-sm" >
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
                    <div class="input-group">
                        @unless(empty($forma_pago))
                            <select name="forma_pago" id="forma_pago" class="form-control form-control-sm" >
                                <option value="0">Seleccionar Forma de pago</option>
                                @foreach ($forma_pago as $parm)
                                    <option value="{{ $parm->codtab }}" @unless(empty($voucher)) @if( $voucher->moneda == $parm->codtab ) selected @endif @else @if(old('moneda') == $parm->codtab ) selected @endif @endif > {{ $parm->descor }}</option>    
                                @endforeach
                            </select>
                        @else
                            <input type="text" class="form-control form-control-sm " value="{{ $voucher->moneda }}" />
                        @endunless
                    </div>
                </div>

                <div class="col-md-2 mb-3">
                    @if(empty($cronograma))
                        <button type="button" id="btn_calendarizar" @if(empty($voucher)) disabled @endif  class="btn btn-sm btn-primary border">Calendarizar</button>
                    @endif
                </div>

                <div class="col-md-2 mb-3">
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

            <hr id="sep" class="d-none">
            <div class="row d-none" id='det'>
                <div class="col-md-4 mb-3">
                    <label for="porvalordetret">Tasa Detracción</label>
                    <input type="text" class="form-control form-control-sm " id="porvalordetret" name="porvalordetret" placeholder="Tasa detracción" @unless(empty($voucher)) value="{{ $voucher->porvalordetret}}" @else value="{{ old('porvalordetret') }}" @endunless aria-describedby="btn_buscar"/>
                </div>
                <div class="col-md-4 mb-3">
                    <label for="valordetret">Detracción</label>
                    <input type="text" class="form-control form-control-sm "  id="valordetret" name="valordetret" placeholder="Monto detracción" @unless(empty($voucher)) value="{{ $voucher->valordetret }}" @else value="{{ old('valordetret') }}" @endunless />
                </div>
                <div class="col-md-4 mb-3">
                    <label for="subtotal">Subtotal</label>
                    <input type="text" class="form-control form-control-sm "  id="subtotal" name="subtotal" placeholder="Subtotal del comprobante" @unless(empty($voucher)) value="{{ $voucher->subtotal }}" @else value="{{ old('subtotal') }}" @endunless />
                </div>
            </div>
            <hr>
            <div class="row">
                @if(!empty($cronograma))
                    <div class="col-md-12 mb-3">
                        <div class="table-responsive">
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
                        </div>
                    </div>  
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
    @include('purchaseorder.search')
    @include('voucher.calendar')
@endsection

@section('script')
<script src="{{ asset('js/util.js') }}" ></script>
<script>
    $(document).ready(function(){
        $('#btn_buscar_orden').click(function(){
            $( "#proveedor_name" ).val('');
            limpiarTabla();
            $('#md_search_order').modal('show');       
        });

        $('#btn_calendarizar').click(function(){
            $( "#nro_cuotas" ).val('');
            $( "#voucher_id" ).val($( "#id" ).val());
            $( "#frecuencia_pago" ).val('');
            $( "#fecha_primer_pago" ).val('');
            $('#md_calendario').modal('show');       
        });

        $('#frm_calendar').submit(function(){
            ajax_post($("#frm_calendar").attr('action'),$("#frm_calendar").serialize());
            return false;
        });
        
        $( "#proveedor_name" ).keyup(function(e) {
            limpiarTabla();
            searchOrdenCompra($( "#proveedor_name" ).val());
        });

        $( "tbody").on("click", "a.sel",function(){
            $( "#purchase_order_id" ).val($(this).attr('val_id'));
            $( "#purchase_order" ).val($(this).attr('val_id'));
            $( "#proveedor" ).val($(this).attr('val_ruc')+' - '+$(this).attr('val_razon'));
            $( "#ruc_proveedor" ).val($(this).attr('val_ruc'));
            $( "#razon_social" ).val($(this).attr('val_razon'));
            $( "#importe_or" ).val($(this).attr('val_total'));
            $( "#importe_orden" ).val($(this).attr('val_total'));
            $( "#md_search_order" ).modal('hide');
        });

        $('#detret').on('change', '', function (e) {
            var item_select = parseInt($(this).val());
            switch (item_select) {
                case 1:
                    $('#det').removeClass('d-none');
                    $('#sep').removeClass('d-none');
                    break;
                default:
                    $('#det').addClass('d-none');
                    $('#sep').addClass('d-none');
                    break;
            }
        });    
        
        $( "#porvalordetret" ).keyup(function(e) {
            porcentaje = $('#porvalordetret').val();
            importe = $('#importe').val();
            if (filterFloat(e,porcentaje))
                asignarValores(porcentaje,importe);
            else
                this.value = (this.value + '').replace(/[^0-9]/g, '');
                return false;
        });
    });

    function procesar_rpta(rpta){
        $('#error').addClass('d-none');
        if(rpta.success){
            location.reload();
        }   
        else{
            mensajes =  rpta.mensajes;
            $('#error').removeClass('d-none');
            mensajes.forEach(err => {
                $('#error ul').append('<li>'+err+'</li>');
            });
        }
    }
    
    function asignarValores(porcentaje,importe){
        detraccion = calcularDetraccion(porcentaje,importe);
        subtotal = importe-detraccion;
        $('#subtotal').val(subtotal);
        $('#valordetret').val(detraccion);
    }    

    function limpiarTabla(){
        $("#tabla_order tbody tr" ).remove();
    }

    function searchOrdenCompra(valor){
        ajax_get("{{ url('purchaseorders/search') }}",valor);
    }

    function ajax_get(ruta,data){
        $.getJSON( ruta+='/'+data , {_token: '{!! csrf_token() !!}'})
        .done(function( data, textStatus, jqXHR ) {
            data.forEach(order => {
                $("#tabla_order tbody").append(
                    '<tr> <td>'+ order.id+'</td>'+
                    '<td>'+order.ruc+' - '+order.razon_social+'</td>'+ 
                    '<td>'+order.fecha_emision+'</td>'+
                    '<td>'+order.total+'</td>'+
                    '<td> <a class="sel badge badge-primary" href="#" val_total = "'+order.total+'" val_ruc = "'+order.ruc+'" val_id="'+order.id+'" val_razon="'+order.razon_social+'" >Seleccionar</a></td>'+
                    '</tr>');
            });
        })
        .fail(function( jqXHR, textStatus, errorThrown ) {
            if ( console && console.log ) {
                console.log( "Algo ha fallado: " +  textStatus);
            }
        });
    } 
    
</script>

@endsection