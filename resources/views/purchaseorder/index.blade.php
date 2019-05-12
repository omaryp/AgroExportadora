@extends('layout')

@section('content')
    <fieldset class="form-group border p-3">

        <legend class="col-sm-3">{{ $title }}</legend>  

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
            <h1 class="h2"></h1>
            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group mr-2">
                    <a href="{{ route('purchaseorders.create') }}" class="btn btn-sm btn-primary border">Nuevo</a>
                </div>
            </div>
        </div>
    
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
                                <a href="{{ route('purchaseorders.show',['codigo'=> str_pad($order->id,10,"0",STR_PAD_LEFT)]) }}" class="btn btn-outline-secondary btn-sm">C</a>
                                <a href="{{ route('purchaseorders.edit',['codigo'=> str_pad($order->id,10,"0",STR_PAD_LEFT)]) }}" class="btn btn-outline-secondary btn-sm">U</a>
                                <a class="btn btn-outline-secondary btn-sm">E</a>
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
    </fieldset>

@endsection