<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EconomicRequest extends Model
{
    protected $fillable = ['id', 'numero', 'anio', 'dirigidoa', 'solicitadopor', 
        'concepto','total','estado', 'fecha_emision'];

    protected $primaryKey = ['id'];

    public $incrementing = false;      
}
