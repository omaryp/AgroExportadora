@extends('layout')

@section('title_page')
{{ $title }}
@endsection

@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/css/dataTables.bootstrap.min.css" rel="stylesheet">
@endsection

@section('head_options')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Ordenes de Compra</h1>
    <a href="{{ route('purchaseorders.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus-circle fa-sm text-white-50"></i> Nueva Orden de Compra </a>
  </div>
    
@endsection

@section('content')
    
        <div class="table-responsive">
            <table class="table table-striped table-sm">
            <thead>
                <tr>
                <th>Código</th>
                <th>Proveedor</th>
                <th>Fecha Emisión</th>
                <th>Monto</th>
                <th>Estado</th>
                <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                    @forelse ($orders as $order)
                    <tr>
                        <td>{{ str_pad($order->id,10,"0",STR_PAD_LEFT)}}</td>
                        <td>{{ $order->razon_social }}</td>
                        <td>{{ $order->fecha_emision}}</td>
                        <td>{{ $order->total }}</td>
                        <td>{{ $order->descor }}</td>
                        <td> 
                            <div class="btn-group mr-2">
                                <a href="{{ route('purchaseorders.show',['codigo'=> str_pad($order->id,10,"0",STR_PAD_LEFT)]) }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-fw fa-check-square"></i></a>
                                <a href="{{ route('purchaseorders.edit',['codigo'=> str_pad($order->id,10,"0",STR_PAD_LEFT)]) }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-fw fa-pen-square"></i></a>
                                <a class="btn btn-outline-secondary btn-sm"><i class="fas fa-fw fa-trash-alt"></i></a>
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
        @include('includes.pagination', ['paginator' => $orders])
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