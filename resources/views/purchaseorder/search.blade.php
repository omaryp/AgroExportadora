<div class="modal fade" id="md_search_order" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content"> 
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Buscar Orden de Compra</h5>
                <button type="button " class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <form>
                    <div class="form-group">
                        <input type="text" class="form-control form-control-sm" id="proveedor_name"  placeholder="Ruc / Razón Social">
                    </div>
                    <div class="form-group">
                        <table class="table table-striped table-sm" id="tabla_order">
                            <thead>
                                <tr>
                                    <th scope="col">Id</th>
                                    <th scope="col">Proveedor</th>
                                    <th scope="col">Fecha Orden</th>
                                    <th scope="col">Total</th>
                                    <th scope="col"></th>
                                </tr>
                            </thead>
                            <tbody>
                                <tr>
                                    <td colspan="4">No hay coincidencias</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                </form>
            </div>
            <div class="modal-footer"></div>
        </div>
    </div>
</div>