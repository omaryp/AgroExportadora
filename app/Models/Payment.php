<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    protected $fillable = ['id','moneda_comprobante','serie_comprobante',
    'numero_comprobante','ruc_proveedor','razon_social','importe_comprobante',
    'tipo_pago','fecha_pago','monto_pago','nro_cuota','medio_pago','codigo_banco',
    'serie_retencion','numero_retencion','codigo_voucher_pago','nro_doc_pago','glosa','voucher_id'];
}
