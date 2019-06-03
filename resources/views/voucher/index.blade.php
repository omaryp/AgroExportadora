@extends('layout')


@section('title_page')
{{ $title }}
@endsection


@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/css/dataTables.bootstrap.min.css" rel="stylesheet">
@endsection

@section('content')
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 ">
            <h1 class="h2"></h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                    <a href="{{ route('vouchers.create') }}" class="btn btn-sm btn-primary border">Nuevo</a>
                </div>
            </div>
        </div>
    
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
                                    <a href="{{ route('vouchers.show',['id'=> $vou->id]) }}" class="btn btn-outline-secondary btn-sm">C</a>
                                    <a href="{{ route('vouchers.edit',['id'=> $vou->id]) }}" class="btn btn-outline-secondary btn-sm">U</a>
                                    <a href="{{ route('vouchers.delete',['id'=> $vou->id]) }}" class="btn btn-outline-secondary btn-sm">D</a>
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