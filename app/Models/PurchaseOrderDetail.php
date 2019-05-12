<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseOrderDetail extends Model
{
    protected $fillable = ['numero_item','
                           cantidad','
                           unidad_medida','
                           descripcion','
                           precio_unitario','
                           total','
                           purchase_order_id'];

}
