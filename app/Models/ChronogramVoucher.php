<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ChronogramVoucher extends Model
{
    //
    protected $fillable = ['nro_cuota',
    'fecha_cuota',
    'fecha_pago',
    'mora',
    'monto_cuota',
    'voucher_id'];
}
