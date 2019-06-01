<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChronogramVoucher extends Model
{
    //
    protected $fillable = ['nro_cuota',
    'estado',
    'fecha_cuota',
    'fecha_pago',
    'mora',
    'monto_cuota',
    'voucher_id'];

    protected $primaryKey = ['voucher_id', 'nro_cuota'];

    public $incrementing = false;

}
