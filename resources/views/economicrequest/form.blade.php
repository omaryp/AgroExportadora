@extends('layout')

@section('title',"Requerimiento Económico")

@section('title_page')
{{ $title }}
@endsection

@section('content')
        <form  action="@if(empty($request)) {{ url("economicrequests") }} @else {{ route('economicrequests.update',['codigo'=>str_pad($request->id,10,'0',STR_PAD_LEFT)]) }} @endif" method="POST">
            @unless(empty($request)) 
                {{ method_field('PUT') }} 
            @endunless
            {!! csrf_field() !!}

            @if ($errors->any())
                @include('includes.error', ['errors' => $errors])
            @endif
            
            <input type="hidden" name="numero" @unless(empty($request)) value="{{ $request->numero }}" @else value="{{ $request_codigo['numero'] }}"  @endunless/>
            <input type="hidden" name="anio" @unless(empty($request)) value="{{ $request->anio }}" @else  value="{{ $request_codigo['anio'] }}" @endunless />
            <div class="row">
                <div class="col-md-3 mb-3">
                    <label for="codigo" >Código de Requerimiento</label>
                    <input type="text" disabled class="form-control form-control-sm" name = "codigo" id="codigo" placeholder="Example 00000012018"
                           @unless(empty($request)) value="{{ str_pad($request->id,10,'0',STR_PAD_LEFT) }}" @else value="{{ str_pad($request_codigo['numero'],6,'0',STR_PAD_LEFT).$request_codigo['anio'] }}" @endunless/>
                </div>
                <div class="col-md-3 mb-3">
                    <label for="fecha">Fecha Emisión</label>
                    <input type="date" @if(! $activo) disabled @endif class="form-control form-control-sm" id="fecha_emision" name ="fecha_emision" placeholder="dd/mm/aaaa" @unless(empty($request)) value="{{ $request->fecha_emision }}" @else value="{{ old('fecha_emision') }}" @endunless/>
                </div>
            </div>
            
            <div class="row">
                <div class="col-md-6 mb-3">
                    <label for="solicitadopor">Solicitado por</label>
                    <div class="input-group">
                        <input type="text" @if(! $activo) disabled @endif class="form-control form-control-sm" id="solicitadopor" name ="solicitadopor" placeholder="Quién solicita?" @unless(empty($request)) value="{{ $request->solicitadopor }}" @else value="{{ old('solicitadopor') }}" @endunless/>
                    </div>
                </div>
                <div class="col-md-6 mb-3">
                    <label for="dirigidoa">Dirigido a</label>
                    <div class="input-group">
                        <input type="text" @if(! $activo) disabled @endif class="form-control form-control-sm" id="dirigidoa" name ="dirigidoa"  @unless(empty($request)) value="{{ $request->dirigidoa }}" @else value="{{ old('dirigidoa') }}" @endunless/>
                    </div>
                </div>
            </div>

            <div class="row align-items-end">
                <div class="col-md-11 mb-3">
                    <label for="concepto">Concepto</label>
                    <div class="input-group">
                        <input type="text" @if(! $activo) disabled @endif class="form-control form-control-sm" id="concepto" name ="concepto" placeholder="Concepto" @unless(empty($request)) value="{{ $request->concepto}}" @else value="{{ old('concepto') }}" @endunless/>
                    </div>
                </div>
                <div class="col-md-1 mb-3">
                    <div class="input-group">
                        <button type="button" @if(empty($request)) disabled @endif class="btn btn-sm btn-primary @if(! $activo) d-none @endif " id="btn_detalle">Detalle</button>
                    </div>
                </div>
            </div>
            <h1></h1>
            <div class="row">
                <div class="col-md-12 mb-3">
                    <div class="table-responsive">
                        <table class="table table-striped table-sm" id="tabla_erdetail">
                            <thead>
                                <tr>
                                <th scope="col">Item</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Descripción</th>
                                <th scope="col">Importe</th>
                                <th scope="col">Acciones</th>
                                </tr>
                            </thead>
                            <tbody>
                                @unless(empty($details))
                                    @forelse ($details as $det)
                                        <tr>d
                                            <td>{{ $det->numero_item }}</td>
                                            <td>{{ $det->cantidad }}</td>
                                            <td>{{ $det->descripcion }}</td>
                                            <td>{{ $det->importe}}</td>
                                            <td> 
                                                <a href="" class="sel badge badge-primary">eliminar</a>
                                            </td>   
                                        </tr>
                                    @empty 
                                        <tr>    
                                            <td colspan="6">
                                                <h6>No se ha registrado items.</h6>
                                            </td>
                                        </tr>
                                    @endforelse            
                                @else
                                    <tr>    
                                        <td colspan="6">
                                            <h6>No se ha registrado items.</h6>
                                        </td>
                                    </tr>
                                @endunless                      
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            
            @if ($activo)
                <div class="btn-toolbar mb-2 mb-md-0">
                    <div class="btn-group mr-2">
                        <button type="submit" class="btn btn-sm btn-primary brequest">Guardar</button>
                        <a href="{{ route('economicrequests') }}" class="btn btn-sm btn-primary brequest">Salir</a>
                    </div>
                </div>    
            @endif
            
        </form>
        @include('economicrequestdetail.form')
    @unless ($activo)
        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group mr-2">
                <a href="{{ route('economicrequests') }}" class="btn btn-primary brequest">Salir</a>
            </div>
        </div>    
    @endunless
@endsection

@section('script')
<script src="{{ asset('js/util.js') }}" ></script>
<script >
    var rpta_srv;
    $(document).ready(function(){
      
        $( "#btn_detalle" ).click(function() {
            $('#economic_request_id').val($('#codigo').val());
            limpiarformulario();   
            $('#md_erdetail').modal('show');
        });

        $( "tbody").on("click", "a.sel",function(){
            $( "#proveedor_id" ).val($(this).attr('val_id'));
            $( "#proveedor" ).val($(this).attr('val_ruc')+' - '+$(this).attr('val_razon'));
            $( "#md_search" ).modal('hide');
        });

        $("#frm_erdetail").submit(function(){
            ajax_post($("#frm_erdetail").attr('action'),$("#frm_erdetail").serialize());
            return false;
        });
    });

    function procesar_rpta(rpta){
        $('#error').addClass('d-none');
        if(rpta.success){
            $("#tabla_erdetail tbody" ).append(
                '<tr> <td> '+rpta.id+'</td>'+
                '<td>'+$('#cantidad').val()+'</td> '+ 
                '<td>'+$('#descripcion').val()+'</td>'+
                '<td>'+$('#importe').val()+'</td>'+
                '<td> <a class="sel badge badge-primary" href="#" id_item = "'+rpta.id+'" val_po="'+$('#economic_request_id').val()+'" >Eliminar</a></td>'+
                '</tr>');
        }   
        else{
            mensajes =  rpta.mensajes;
            $('#error').removeClass('d-none');
            mensajes.forEach(err => {
                $('#error ul').append('<li>'+err+'</li>');
            });
        }
    }

    function limpiarformulario(){
        $("#cantidad" ).val('');
        $("#descripcion" ).val('');
        $("#importe" ).val('');
    }
    
</script>
@endsection