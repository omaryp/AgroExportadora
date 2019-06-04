@extends('layout')

@section('title_page')
{{ $title }}
@endsection


@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/css/dataTables.bootstrap.min.css" rel="stylesheet">
@endsection

@section('head_options')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Proveedores</h1>
    <a href="{{ route('proveedores.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus-circle fa-sm text-white-50"></i> Nuevo Proveedor </a>
  </div>
    
@endsection

@section('content')
   

    
        <div class="table-responsive">
            <table class="table table-striped table-sm" id="tbl_prov">
            <thead>
                <tr>
                <th>Ruc</th>
                <th>Razón Social</th>
                <th>Dirección</th>
                <th>Estado</th>
                <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($provs as $p)
                    <tr>
                        <td>{{ $p->ruc }}</td>
                        <td>{{ $p->razon_social }}</td>
                        <td>{{ $p->direccion }}</td>
                        <td>{{ $p->estado }}</td>
                        <td> 
                            <!--<div class="btn-toolbar mb-2 mb-md-0">-->
                                <div class="btn-group mr-2">
                                    <a href="{{ route('proveedores.show',['prov'=> $p->id]) }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-fw fa-check-square"></i></a>
                                    <a href="{{ route('proveedores.edit',['prov'=> $p->id]) }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-fw fa-pen-square"></i></a>
                                    <a href="{{ route('proveedores.edit',['prov'=> $p->id]) }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-fw fa-trash-alt"></i></a>
                                </div>
                            <!--</div>-->
                        </td>   
                    </tr>
                @empty 
                    <tr>    
                        <td colspan="5">
                            <h6>No se encontraron elementos.</h6>
                        </td>
                    </tr>
                @endforelse       
            </tbody>
            </table>
        </div>
        @include('includes.pagination', ['paginator' => $provs])
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

