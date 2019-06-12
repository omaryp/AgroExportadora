@extends('layout')

@section('title_page')
{{ $title }}
@endsection

@section('head_options')

<div class="d-sm-flex align-items-center justify-content-between mb-4">
    <h1 class="h3 mb-0 text-gray-800">Requerimiento Económico</h1>
    <a href="{{ route('economicrequests.create') }}" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm"><i class="fas fa-plus-circle fa-sm text-white-50"></i> Nuevo Requerimiento Económico</a>
  </div>
    
@endsection

@section('content')
    
        <div class="table-responsive">
            <table class="table table-striped table-sm" id="tbl_request">
            <thead>
                <tr>
                <th>Código</th>
                <th>Solicitado por</th>
                <th>Fecha Emisión</th>
                <th>Monto</th>
                <th>Estado</th>
                <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                    @forelse ($requests as $request)
                    <tr>
                        <td>{{ str_pad($request->id,10,"0",STR_PAD_LEFT)}}</td>
                        <td>{{ $request->solicitadopor }}</td>
                        <td>{{ $request->fecha_emision}}</td>
                        <td>{{ $request->total }}</td>
                        <td>{{ $request->descor }}</td>
                        <td> 
                            <div class="btn-group mr-2">
                                <a href="{{ route('economicrequests.show',['codigo'=> str_pad($request->id,10,"0",STR_PAD_LEFT)]) }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-fw fa-check-square"></i></a>
                                <a href="{{ route('economicrequests.edit',['codigo'=> str_pad($request->id,10,"0",STR_PAD_LEFT)]) }}" class="btn btn-outline-secondary btn-sm"><i class="fas fa-fw fa-pen-square"></i></a>
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
        @include('includes.pagination', ['paginator' => $requests])
@endsection
