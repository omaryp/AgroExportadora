@extends('layout')

@section('title_page')
{{ $title }}
@endsection


@section('css')
<link href="https://cdnjs.cloudflare.com/ajax/libs/datatables/1.10.19/css/dataTables.bootstrap.min.css" rel="stylesheet">
@endsection

@section('head_options')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Deudas</h1>
    <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus-circle fa-sm text-white-50"></i> Generar Reporte </a>
</div>
    
@endsection

@section('content')
   
        <div class="table-responsive">
            <table class="table table-striped table-sm" id="tbl_prov">
            <thead>
                <tr>
                <th>Nro</th>
                <th>Ruc</th>
                <th>Razón Social</th>
                <th>Compras MN</th>
                <th>Saldo MN</th>
                <th>Compras ME</th>
                <th>Saldo ME</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($cuentas as $deb)
                    <tr>
                        <td>{{ $p->item }}</td>
                        <td>{{ $p->ruc }}</td>
                        <td>{{ $p->razon_social }}</td>
                        <td>{{ $p->comprasmn }}</td>
                        <td>{{ $p->saldomn }}</td>
                        <td>{{ $p->comprasme }}</td>
                        <td>{{ $p->saldome }}</td>
                    </tr>
                @empty 
                    <tr>    
                        <td colspan="7">
                            <h6>No se encontraron elementos.</h6>
                        </td>
                    </tr>
                @endforelse       
            </tbody>
            </table>
        </div>
       
@endsection



