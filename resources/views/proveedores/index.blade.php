@extends('layout')

@section('title_page')
{{ $title }}
@endsection


@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/css/dataTables.bootstrap.min.css" rel="stylesheet">
@endsection

@section('content')
   

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3">
            <h1 class="h2"></h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                    <a href="{{ route('proveedores.create') }}" class="btn btn-sm btn-primary border">Nuevo</a>
                </div>
            </div>
        </div>
    
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
                                    <a href="{{ route('proveedores.show',['prov'=> $p->id]) }}" class="btn btn-outline-secondary btn-sm">C</a>
                                    <a href="{{ route('proveedores.edit',['prov'=> $p->id]) }}" class="btn btn-outline-secondary btn-sm">U</a>
                                    <a href="{{ route('proveedores.edit',['prov'=> $p->id]) }}" class="btn btn-outline-secondary btn-sm">E</a>
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

