<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateChronogramVouchersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('chronogram_vouchers', function (Blueprint $table) {
            $table->unsignedInteger('nro_cuota')->default(0);
            $table->date('fecha_cuota')->nullable();
            $table->date('fecha_pago')->nullable();
            $table->unsignedInteger('mora')->default(0);
            $table->unsignedDecimal('monto_cuota',14,2)->default(0);
            $table->unsignedInteger('estado')->defualt(0);          
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
        Schema::dropIfExists('chronogram_vouchers');
    }
}
