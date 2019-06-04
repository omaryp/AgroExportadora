@extends('layout')

@section('title_page')
{{ $title }}
@endsection

@section('content')
        <form action="@if(empty($pago)) {{ url('payments') }} @else {{ url("payments/{$pago->id}") }} @endif" @unless($activo) disabled @endunless method="POST">
            @unless(empty($pago)) 
                {{ method_field('PUT') }} 
            @endunless
            {!! csrf_field() !!}
            
            @if ($errors->any())
                @include('includes.error', ['errors' => $errors])
            @endif

            <input type="hidden" name="id" id="id" @unless(empty($pago)) value="{{ $pago->id}}" @else value="{{ old('id') }}" @endunless  >
            <div class="row">
                <div class="col-md-4 mb-3">
                    <label for="comp">Comprobante</label>
                    <div class="input-group input-group-sm">
                        <div class="input-group-prepend">
                            <button class="btn btn-primary form-control-sm" type="button" id="btn_buscar_voucher">Buscar</button>
                        </div>
                        <input type="text" class="form-control form-control-sm " disabled id="comp" name="comp" placeholder="Comprobante" @unless(empty($pago)) value="{{ $pago->tipo_comprobante}} - {{ $pago->serie_comprobante}} / {{ $pago->numero_comprobante}}" @else value="{{ old('comp') }}" @endunless aria-describedby="btn_buscar"/>
                        <input type="hidden" id="voucher_id" name="voucher_id"  @unless(empty($pago)) value="{{ $pago->voucher_id}}" @else value="{{ old('voucher_id') }}" @endunless />
                    </div>
                </div> 
                <div class="col-md-4 mb-3">
                    <label for="proveedor">Proveedor</label>
                    <input type="text" class="form-control form-control-sm " disabled id="proveedor" name="proveedor" placeholder="Proveedor" @unless(empty($pago)) value="{{ $pago->ruc_proveedor }} - {{ $pago->razon_social }}" @else value="{{ old('proveedor') }}" @endunless />
                    <input type="hidden" id="ruc_proveedor" name="ruc_proveedor" @unless(empty($pago)) value="{{ $pago->ruc_proveedor }}" @else value="{{ old('ruc_proveedor') }}" @endunless />
                    <input type="hidden" id="razon_social" name="razon_social" @unless(empty($pago)) value="{{ $pago->razon_social }}" @else value="{{ old('razon_social') }}" @endunless />
                </div>

                <div class="col-md-4 mb-3">
                    <label for="importe_vou">Importe Total</label>
                    <input type="text" class="form-control form-control-sm " disabled id="importe_vou" name="importe_vou" placeholder="Monto total del comprobante" @unless(empty($pago)) value="{{ $pago->importe_comprobante }}" @else value="{{ old('importe_vou') }}" @endunless />
                    <input type="hidden" id="importe_comprobante" name="importe_comprobante"  @unless(empty($pago)) value="{{ $pago->importe_comprobante }}" @else value="{{ old('importe_comprobante') }}" @endunless />
                </div>
            </div>
            <hr>
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="tipo">Tipo Pago</label>
                    <div class="input-group">
                        <select name="tipo_pago" @unless(empty($tipo_pago)) disabled @endunless id="tipo_pago" class="form-control form-control-sm" >
                            <option value="00">Tipo Pago</option>
                            @unless(empty($tipo_pago))
                                @foreach ($tipo_pago as $tipo)
                                <option value="{{ $tipo->codtab }}" @unless(empty($pago)) @if($pago->tipo_pago == $tipo->codtab ) selected @endif @endunless >{{ $tipo->descor }}</option>    
                                @endforeach
                            @endunless
                        </select>
                    </div>
                </div>
            </div>
            <div id="frm_pago">
                @unless(empty($pago))
                    @switch($pago->tipo_pago)
                        @case(1)
                            @include('payment.comprobante')
                            @break
                        @case(2)
                            @include('payment.detraccion')
                            @break
                        @case(3)
                            @include('payment.retencion')
                            @break
                        @break
                    @endswitch  
                @endunless 
            </div>
            @if ($activo)
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group mr-2">
                        <button type="submit" class="btn btn-sm btn-primary border">Guardar</button>
                        <a href="{{ route('payments') }}" class="btn btn-sm btn-primary border">Salir</a>
                    </div>
                </div>    
            @endif
            
        </form>
    @unless ($activo)
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <a href="{{ route('payments') }}" class="btn btn-sm btn-primary border">Salir</a>
            </div>
        </div>    
    @endunless
    @include('voucher.search')
@endsection

@section('script')
<script src="{{ asset('js/util.js') }}" ></script>
<script>
    $(document).ready(function(){
        $('#btn_buscar_voucher').click(function(){
            $( "#proveedor_name" ).val('');
            limpiarTabla();
            $('#md_search_voucher').modal('show');       
        });

        $( "#proveedor_name" ).keyup(function(e) {
            limpiarTabla();
            searchComprobante($( "#proveedor_name" ).val());
        });

        $( "tbody").on("click", "a.sel",function(){
            cargaDatosSel($(this));
            ajax_get("{{ url('payments/tipo') }}",$('#voucher_id').val());
            $('#md_search_voucher').modal('hide');
        });

        $('#tipo_pago').on('change', '', function (e) {
            mostrarFrm();
        });
    });
    
    function mostrarFrm(){
        var item = parseInt($('#tipo_pago').val());
        var url = '';
        if (item != 0){
            switch (item) {
                case 1:
                    url = '/payments/comprobante/'+$('#voucher_id').val();
                    break;
                case 2:
                    url = '/payments/detraccion/'+$('#voucher_id').val();
                    break;
                case 3:
                    url = '/payments/retencion/'+$('#voucher_id').val();
                    break;
            }
            $('#frm_pago').load(url);
        } else {
            $('#frm_pago').empty();
        }
    }

    function cargaDatosSel(seleccion){
        $('#voucher_id').val($(seleccion).attr('val_id'));
        $('#comp').val($(seleccion).attr('val_tipo')+' - '+$(seleccion).attr('val_serie')+' / '+$(seleccion).attr('val_numero'));
        $('#ruc_proveedor').val($(seleccion).attr('val_ruc'));
        $('#razon_social').val($(seleccion).attr('val_razon'));
        $('#proveedor').val($(seleccion).attr('val_ruc')+' - '+$(seleccion).attr('val_razon'));
        $('#importe_comprobante').val($(seleccion).attr('val_imp'));
        $('#importe_vou').val($(seleccion).attr('val_imp'));
    }

    function limpiarTabla(){
        $("#tabla_voucher tbody tr" ).remove();
    }

    function searchComprobante(valor){
        ajax_get("{{ url('vouchers/search') }}",valor);
    }

    function procesarDataGet(rpta){
        switch(rpta.id_data){
            case 1:
                rpta.data.forEach(voucher => {
                    $("#tabla_voucher tbody").append(
                    '<tr><td>'+voucher.ruc_proveedor+' - '+voucher.razon_social+'</td>'+ 
                    '<td>'+voucher.tipo+' - '+voucher.serie+' / '+voucher.numero+'</td>'+ 
                    '<td>'+voucher.fecha_emision+'</td>'+
                    '<td>'+voucher.importe+'</td>'+
                    '<td> <a class="sel badge badge-primary" href="#" '+ 
                        'val_imp = "'+voucher.importe+'" '+ 
                        'val_id = "'+voucher.id+'" '+ 
                        'val_ruc = "'+voucher.ruc_proveedor+'" '+
                        'val_tipo = "'+voucher.tipo+'" '+
                        'val_serie = "'+voucher.serie+'" '+ 
                        'val_numero = "'+voucher.numero+'" '+ 
                        'val_razon = "'+voucher.razon_social+'" >Seleccionar</a></td>'+
                    '</tr>');
                });
                break;
            case 2:
                rpta.data.forEach(parms => {
                    $('#tipo_pago').append(
                        '<option value="'+parms.codtab+'">'+parms.descor+'</option>'
                    );
                });
                break;
            case 3:
                rpta.data.forEach(parms => {
                    $('#tipo_pago').append(
                        '<option value="'+parms.codtab+'">'+parms.descor+'</option>'
                    );
                });
                break;
        }
       
    }
    
</script>

@endsection