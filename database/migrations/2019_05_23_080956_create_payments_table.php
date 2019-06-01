<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('moneda_comprobante')->default(0);
            $table->string('serie_comprobante',4);
            $table->unsignedInteger('numero_comprobante')->default(0);
            $table->string('ruc_proveedor',11);
            $table->string('razon_social',150);
            $table->unsignedDecimal('importe_comprobante',14,2)->default(0);
            //
            $table->unsignedInteger('tipo_pago')->default(0); 
            $table->date('fecha_pago');
            $table->unsignedDecimal('monto_pago',14,2)->default(0);
            $table->unsignedInteger('nro_cuota')->defualt(0);
            $table->unsignedInteger('medio_pago')->default(0);
            $table->unsignedInteger('codigo_banco')->default(0);
            $table->string('serie_retencion',4)->defaut('');
            $table->string('numero_retencion',8)->defaut('');
            $table->string('codigo_voucher_pago',20)->default('');
            $table->string('nro_doc_pago',20)->default('');
            $table->string('glosa',400)->default('');
           
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
        Schema::dropIfExists('payments');
    }
}
