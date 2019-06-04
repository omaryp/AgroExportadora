<div class="modal fade" id="md_calendario" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-sm" role="document">
        <div class="modal-content"> 
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Calendarizar</h5>
                <button type="button " class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frm_calendar" action="{{ url('chronogramvoucher') }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="voucher_id" id="voucher_id" value="">
                    <div id="error" class="d-none alert alert-danger">
                        <ul>
                            
                        </ul>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="nro_cuotas">Nro cuotas</label>
                            <input type="text" class="form-control form-control-sm" id="nro_cuotas" name ="nro_cuotas" placeholder="Número de cuotas"/>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12 mb-3">
                            <label for="frecuencia_pago">Frecuencia de Pagos</label>
                            <input type="text" class="form-control form-control-sm" id="frecuencia_pago" name ="frecuencia_pago" placeholder="Frecuencia de Pagos (días)" />
                        </div>
                    </div>
                    <input type="hidden" name="fecha_emision" id="fecha_emision_d" value="">
                    <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="fecha_primer_pago">Fecha Primer Pago</label>
                                <input type="date" class="form-control form-control-sm" id="fecha_primer_pago" name ="fecha_primer_pago" placeholder="dd/mm/aaaa" value=""/>
                            </div>
                        </div>
                    <div class="row justify-content-end">
                        <div class="btn-toolbar mb-2 mb-md-2">
                            <div class="btn-group mr-3">
                                <button class="btn btn-sm btn-primary border" type="submit">Generar</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>