<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEconomicRequestsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('economic_requests', function (Blueprint $table) {
            $table->string('id',10);
            $table->primary('id');
            $table->unsignedDecimal('numero',6,0)->default(0);
            $table->unsignedDecimal('anio',4,0)->default(0);
            $table->string('dirigidoa',300)->nullable();
            $table->string('solicitadopor',200)->default('');
            $table->string('concepto',200)->default('');
            $table->unsignedDecimal('total',14,2)->default(0);
            $table->unsignedDecimal('estado',1,0)->default(0);
            $table->dateTime('fecha_emision')->default(null)->nullable();  
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
        Schema::dropIfExists('economic_requests');
    }
}
