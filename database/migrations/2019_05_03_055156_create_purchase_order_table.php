<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseOrderTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_orders', function (Blueprint $table) {
            $table->string('id',10);
            $table->primary('id');
            $table->unsignedDecimal('numero',6,0)->default(0);
            $table->unsignedDecimal('anio',4,0)->default(0);
            $table->unsignedDecimal('destino',2,0)->default(0);
            $table->unsignedDecimal('condicion_pago',1,0)->default(0);
            $table->unsignedDecimal('plazo_dias',2,0)->default(0);
            $table->dateTime('fecha_emision')->default(null)->nullable();  
            $table->unsignedDecimal('estado',2,0)->default(1);
            $table->unsignedDecimal('subtotal',14,2)->nullable();
            $table->unsignedDecimal('igv',14,2)->nullable();
            $table->unsignedDecimal('flete',14,2)->nullable();
            $table->unsignedDecimal('total',14,2)->nullable();
            $table->string('condiciones_entrega',300)->nullable();
            $table->string('almacen',200)->default('');
            $table->string('direccion',200)->default('');
            $table->string('usuario_crea',20)->nullable();
            $table->string('usuario_aprueba',20)->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('purchase_orders');
    }
}
