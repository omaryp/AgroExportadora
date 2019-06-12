<div class="modal fade" id="md_erdetail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalle Requerimiento Económico</h5>
                <button type="button " class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frm_erdetail" action="{{ url('economicrequestdetail') }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="economic_request_id" id="economic_request_id" value="">
                    <div id="error" class="d-none alert alert-danger">
                        <ul>
                            
                        </ul>
                    </div>
                    <div class="form-group">
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="cantidad" >Cantidad</label>
                                <input type="text" 
                                       class="form-control form-control-sm" 
                                       name = "cantidad" 
                                       id="cantidad" 
                                       placeholder="Cantidad"/>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="importe" >Importe</label>
                                <input type="text" 
                                       class="form-control form-control-sm" 
                                       name = "importe" 
                                       id="importe" 
                                       placeholder="Importe"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="descripcion" >Detalle</label>
                                <input type="text" 
                                       class="form-control form-control-sm" 
                                       name = "descripcion" 
                                       id="descripcion" 
                                       placeholder="Detalle"/>
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="btn-toolbar mb-2 mb-md-2">
                                <div class="btn-group mr-3">
                                    <button class="btn btn-sm btn-primary border" type="submit">Agregar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
            <div class="modal-footer">
                
            </div>
        </div>
    </div>
</div>