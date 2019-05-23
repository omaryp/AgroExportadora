<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChronogramVoucher extends Model
{
    //
    protected $fillable = ['nro_cuota',
    'fecha_cuota',
    'fecha_pago',
    'mora',
    'monto_cuota',
    'vouchers_id'];
}
