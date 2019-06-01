<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {   
        Schema::create('vouchers', function (Blueprint $table) {
            $table->bigInteger('id');
            $table->primary('id');
            $table->string('key',16)->unique();
            $table->unsignedDecimal('tipo',2,0)->default(0);
            $table->string('serie',4)->default('');
            $table->string('numero',8)->default('');
            $table->unsignedDecimal('moneda',2,0)->default(0);
            $table->date('fecha_emision')->nullable();
            $table->unsignedDecimal('importe_orden',14,2)->default(0);
            $table->unsignedDecimal('importe',14,2)->default(0);
            $table->unsignedDecimal('detret',2,0)->default(0);
            $table->unsignedDecimal('valordetret',14,2)->default(0)->nullable();
            $table->unsignedDecimal('porvalordetret',10,5)->default(0)->nullable();
            $table->unsignedDecimal('subtotal',14,2)->default(0)->nullable();
            //0 voucher aun no cancelado 1 voucher cancelado
            $table->unsignedDecimal('estado',2,0)->default(0);
            //0 aun no se paga la afectacion 1 afectacion pagada
             $table->unsignedDecimal('estado_afectacion',2,0)->default(0);
            $table->unsignedDecimal('forma_pago',2,0)->default(0);
            $table->unsignedInteger('fecuencia_pago')->default(0);
            $table->unsignedInteger('nro_cuotas')->default(0);
            $table->date('fecha_vencimiento')->nullable();
            $table->date('fecha_primer_pago')->nullable();
            $table->string('ruc_proveedor',11)->default('');
            $table->string('razon_social',150)->default('');
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
        Schema::dropIfExists('vouchers');

    }
}
