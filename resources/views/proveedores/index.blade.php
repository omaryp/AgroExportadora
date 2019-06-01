@extends('layout')

@section('content')
    <fieldset class="form-group border p-3">

        <legend class="col-sm-3">{{ $title }}</legend>  

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2"></h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                    <a href="{{ route('proveedores.create') }}" class="btn btn-sm btn-primary border">Nuevo</a>
                </div>
            </div>
        </div>
    
        <div class="table-responsive">
            <table class="table table-striped table-sm">
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
    </fieldset>

@endsection