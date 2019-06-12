<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EconomicRequestDetail extends Model
{
   protected $fillable = [
        'numero_item', 'cantidad', 'descripcion', 'importe', 'economic_request_id'];

   protected $primaryKey = ['economic_request_id', 'numero_item'];

   public $incrementing = false;
}
