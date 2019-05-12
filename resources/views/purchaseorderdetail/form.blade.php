<div class="modal fade" id="md_detail" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Detalle Orden de Compra</h5>
                <button type="button " class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form id="frm_detail" action="{{ url('purchaseordersdetail') }}" method="POST">
                    {{ csrf_field() }}
                    <input type="hidden" name="purchase_order_id" id="purchase_order_id" value="">
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
                                <label for="unidad_medida">Unidad de medida</label>
                                <input type="text" 
                                       class="form-control form-control-sm" 
                                       id="unidad_medida" 
                                       name ="unidad_medida" 
                                       placeholder="Ejemplo Kg." />
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12 mb-3">
                                <label for="descripcion" >Descripción</label>
                                <input type="text" 
                                       class="form-control form-control-sm" 
                                       name = "descripcion" 
                                       id="descripcion" 
                                       placeholder="Descripcion"/>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-6 mb-3">
                                <label for="precio_unitario" >Precio Unitario</label>
                                <input type="text" 
                                       class="form-control form-control-sm" 
                                       name = "precio_unitario" 
                                       id="precio_unitario" 
                                       placeholder="precio_unitario"/>
                            </div>
                            <div class="col-md-6 mb-3">
                                <label for="total" >Total</label>
                                <input type="text" 
                                       disabled
                                       class="form-control form-control-sm" 
                                       name = "total" 
                                       id="total" 
                                       placeholder="Total"/>
                                <input type="hidden" name="total" id="h_total" value="">
                            </div>
                        </div>
                        <div class="row justify-content-end">
                            <div class="btn-toolbar mb-2 mb-md-2">
                                <div class="btn-group mr-3">
                                    <button class="btn btn-sm btn-primary border" type="submit">Agregar</button>
                                    <button class="btn btn-sm btn-primary border" type="button">Salir</button>
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