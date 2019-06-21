@extends('layout')


@section('title_page')
{{ $title }}
@endsection

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/css/dataTables.bootstrap.min.css" rel="stylesheet">
@endsection

@section('head_options')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Pago de comprobantes</h1>
    <a href="{{ route('payments.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus-circle fa-sm text-white-50"></i> Nuevo Pago </a>
  </div>
    
@endsection

@section('content')
    
        <div class="table-responsive">
            <table class="table table-striped table-sm">
            <thead>
                <tr>
                <th>Id</th>
                <th>Proveedor</th>
                <th>Comprobante</th>
                <th>Fecha Pago</th>
                <th>Importe</th>
                <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($pagos as $pag)
                    <tr>
                        <td>{{ $pag->id }}</td>
                        <td>{{ $pag->ruc_proveedor }} - {{ $pag->razon_social }}</td>
                        <td>{{ $pag->moneda_comprobante }} - {{ $pag->serie_comprobante }} / {{ $pag->numero_comprobante }} </td>
                        <td>{{ $pag->fecha_pago }}</td>
                        <td>{{ $pag->monto_pago }}</td>
                        <td> 
                            <div class="btn-group mr-2">
                                <a href="{{ route('payments.show',['id'=> $pag->id]) }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-fw fa-check-square"></i></a>
                                <a href="{{ route('payments.delete',['id'=> $pag->id]) }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-fw fa-trash-alt"></i></a>
                            </div>
                        </td>   
                    </tr>
                @empty 
                    <tr>    
                        <td colspan="6">
                            <h6>No se encontraron elementos.</h6>
                        </td>
                    </tr>
                @endforelse       
            </tbody>
            </table>
        </div>
        @include('includes.pagination', ['paginator' => $pagos])
    </fieldset>

@endsection

@section('script')
 
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap.min.js"></script>
  
<script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>  

<script>

$(document).ready(function() {
  $('#tbl_prov').DataTable();
});
    </script>
@endsection