<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Proveedor extends Model{
    protected $fillable = ['razon_social','ruc','email','direccion','representante','telefono','referencias','estado'];
    public $table = "proveedores";
}