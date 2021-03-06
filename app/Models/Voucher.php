<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Voucher extends Model
{
    //
    protected $fillable = ['id',
    'tipo',
    'key',
    'serie',
    'numero',
    'moneda',
    'fecha_emision',
    'importe',
    'importe_orden',
    'detret',
    'valordetret',
    'porvalordetret',
    'subtotal',
    'estado',
    'forma_pago',
    'fecuencia_pago',
    'nro_cuotas',
    'fecha_vencimiento',
    'fecha_primer_pago',
    'ruc_proveedor',
    'razon_social',
    'purchase_order_id'];
}
