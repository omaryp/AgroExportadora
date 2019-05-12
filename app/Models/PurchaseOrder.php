<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrder extends Model
{
    protected $fillable = [
        'id', 'numero', 'anio', 'destino', 'condicion_pago', 
        'plazo_dias','fecha_emision','estado', 'subtotal', 'igv', 'flete', 'total', 
        'usuario_crea', 'usuario_aprueba', 'condiciones_entrega','almacen',
        'direccion', 'referencia_destino','proveedor_id'];
}
