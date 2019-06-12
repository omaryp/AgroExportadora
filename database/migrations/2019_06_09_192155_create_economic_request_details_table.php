<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEconomicRequestDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('economic_request_details', function (Blueprint $table) {
            $table->unsignedDecimal('numero_item',2,0);
            $table->unsignedDecimal('cantidad',10,0);
            $table->string('descripcion',200);
            $table->unsignedDecimal('importe',14,2);
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
        Schema::dropIfExists('economic_request_details');
    }
}
