@extends('layout')


@section('title_page')
{{ $title }}
@endsection


@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/css/dataTables.bootstrap.min.css" rel="stylesheet">
@endsection

@section('head_options')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Comprobantes</h1>
    <a href="{{ route('vouchers.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus-circle fa-sm text-white-50"></i> Nuevo Comprabante </a>
  </div>
    
@endsection

@section('content')
    
    
        <div class="table-responsive">
            <table class="table table-striped table-sm">
            <thead>
                <tr>
                <th>Ruc</th>
                <th>Razón Social</th>
                <th>Tipo</th>
                <th>Comprobante</th>
                <th>Moneda</th>
                <th>Monto</th>
                <th>Estado</th>
                <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($vouchers as $vou)
                    <tr>
                        <td>{{ $vou->ruc_proveedor }}</td>
                        <td>{{ $vou->razon_social }}</td>
                        <td>{{ $vou->tipo }}</td>
                        <td>{{ $vou->serie }}-{{ $vou->numero }}</td>
                        <td>{{ $vou->moneda }}</td>
                        <td>{{ $vou->importe }}</td>
                        <td>{{ $vou->estado }}</td>
                        <td> 
                            <!--<div class="btn-toolbar mb-2 mb-md-0">-->
                                <div class="btn-group mr-2">
                                    <a href="{{ route('vouchers.show',['id'=> $vou->id]) }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-fw fa-check-square"></i></a>
                                    <a href="{{ route('vouchers.edit',['id'=> $vou->id]) }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-fw fa-pen-square"></i></a>
                                    <a href="{{ route('vouchers.delete',['id'=> $vou->id]) }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-fw fa-trash-alt"></i></a>
                                </div>
                            <!--</div>-->
                        </td>   
                    </tr>
                @empty 
                    <tr>    
                        <td colspan="8">
                            <h6>No se encontraron elementos.</h6>
                        </td>
                    </tr>
                @endforelse       
            </tbody>
            </table>
        </div>
        @include('includes.pagination', ['paginator' => $vouchers])


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