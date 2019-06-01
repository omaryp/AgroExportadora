<div class="row">
        <div class="col-md-4 mb-3">
            <label for="codigo" >Fecha de Pago</label>
            <input type="date"  class="form-control form-control-sm" name = "fecha_pago" id="fecha_pago" placeholder="Fecha de pago"/>
        </div>
        <div class="col-md-4 mb-3">
            <label for="codigo_voucher_pago">Código Voucher</label>
            <input type="text" class="form-control form-control-sm"  id="codigo_voucher_pago" name="codigo_voucher_pago" placeholder="Código Voucher" @unless(empty($pago)) value="{{ $pago->codigo_voucher_pago }} " @else value="{{ old('codigo_voucher_pago') }}" @endunless/>    
        </div>
        <div class="col-md-4 mb-3">
            <label for="monto_pago">Importe</label>
            @if(empty($monto_cuota))
                <input type="text" class="form-control form-control-sm"  id="monto_pago" name="monto_pago" placeholder="Monto Pago" @unless(empty($pago)) value="{{ $pago->monto_pago }} " @else value="{{ old('monto_pago') }}" @endunless/>    
            @else
                <input type="text" class="form-control form-control-sm"  id="monto_pago" name="monto_pago" placeholder="Monto Pago" @unless(empty($pago)) value="{{ $pago->monto_pago }} " @else value="{{ $monto_cuota }}" @endunless />    
            @endif
        </div>
    </div>   
        
    <div class="row">
        <div class="col-md-12 mb-3">
            <label for="glosa">Glosa</label>
            <input type="text" class="form-control form-control-sm"  id="glosa" name="glosa" placeholder="Glosa" @unless(empty($pago)) value="{{ $pago->glosa }}" @else value="{{ old('glosa') }}" @endunless />    
        </div>
    </div>