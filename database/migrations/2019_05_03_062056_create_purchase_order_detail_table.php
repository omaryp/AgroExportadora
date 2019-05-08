<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePurchaseOrderDetailTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('purchase_order_details', function (Blueprint $table) {
            $table->unsignedDecimal('numero_item',2,0);
            $table->unsignedDecimal('cantidad',10,0);
            $table->unsignedDecimal('unidad_medida',5,0);
            $table->string('descripcion',200);
            $table->unsignedDecimal('precio_unitario',14,2);
            $table->unsignedDecimal('total',14,2);
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
        Schema::dropIfExists('purchase_order_details');
    }
}
