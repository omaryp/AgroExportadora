<div class="row">
    <div class="col-md-4 mb-3">
        <label for="fecha_pago" >Fecha de Pago</label>
        <input type="date"  class="form-control form-control-sm" name = "fecha_pago" id="fecha_pago" placeholder="Fecha de pago" @unless(empty($pago)) disabled value = "{{$pago->fecha_pago}}" @else value="" @endunless/>
    </div>
    <div class="col-md-4 mb-3">
        <label for="nro_cuota">Cuota</label>        
        <div class="input-group">
            @unless(empty($cuotas))
                <select name="nro_cuota" id="nro_cuota"  @unless(empty($pago)) disabled @endunless class="form-control form-control-sm" >
                    <option value="00">Seleccionar Cuota</option>
                    @foreach ($cuotas as $parm)
                        <option value="{{ $parm->nro_cuota }}" @unless(empty($pago))  @if( $pago->nro_cuota == $parm->nro_cuota ) selected @endif @endif > {{ $parm->nro_cuota }}</option>    
                    @endforeach
                </select>
            @endunless
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <label for="monto_pago">Importe</label>
        @if(empty($monto_cuota))
            <input type="text" class="form-control form-control-sm"  id="monto_pago" name="monto_pago" placeholder="Monto Pago" @unless(empty($pago))  disabled value="{{ $pago->monto_pago }} " @else value="{{ old('monto_pago') }}" @endunless />    
        @else
            <input type="text" class="form-control form-control-sm"  id="monto_pago" name="monto_pago" placeholder="Monto Pago" @unless(empty($pago)) disabled value="{{ $pago->monto_pago }} " @else value="{{ $monto_cuota }}" @endunless />    
        @endif
    </div>
</div>

<div class="row">
    <div class="col-md-4 mb-3">
        <label for="fecha">Banco</label>        
        <div class="input-group"> 
            @unless(empty($bancos))
                <select name="codigo_banco" @unless(empty($pago)) disabled @endunless id="codigo_banco" class="form-control form-control-sm" >
                    <option value="00">Seleccionar Banco</option>
                    @foreach ($bancos as $parm)
                        <option value="{{ $parm->codtab }}" @unless(empty($pago)) @if( $pago->codigo_banco == $parm->codtab ) selected @endif @else @if(old('codigo_banco') == $parm->codtab ) selected @endif @endif > {{ $parm->descor }}</option>    
                    @endforeach
                </select>
            @endunless
        </div>
    </div>
    <div class="col-md-4 mb-3">
        <label for="fecha">Medio de Pago</label>    
        @unless(empty($medios))
            <select name="medio_pago" @unless(empty($pago)) disabled @endunless id="medio_pago" class="form-control form-control-sm" >
                <option value="00">Seleccionar Medio Pago</option>
                @foreach ($medios as $parm)
                    <option value="{{ $parm->codtab }}" @unless(empty($pago)) disabled @if( $pago->medio_pago == $parm->codtab ) selected @endif @else @if(old('medio_pago') == $parm->codtab ) selected @endif @endif > {{ $parm->descor }}</option>    
                @endforeach
            </select>
        @endunless    
    </div>
    <div class="col-md-4 mb-3">
        <label for="nro_doc_pago">Nro. Doc Pago</label>
        <input type="text" class="form-control form-control-sm"   id="nro_doc_pago" name="nro_doc_pago" placeholder="Documento Pago" @unless(empty($pago)) disabled value="{{ $pago->nro_doc_pago }}" @else value="{{ old('nro_doc_pago') }}" @endunless aria-describedby="btn_buscar"/>    
    </div>
</div>

<div class="row">
    <div class="col-md-12 mb-3">
        <label for="glosa">Glosa</label>
        <input type="text" class="form-control form-control-sm"  id="glosa" name="glosa" placeholder="Glosa" @unless(empty($pago)) disabled value="{{ $pago->glosa }}" @else value="{{ old('glosa') }}" @endunless aria-describedby="btn_buscar"/>    
    </div>
</div>