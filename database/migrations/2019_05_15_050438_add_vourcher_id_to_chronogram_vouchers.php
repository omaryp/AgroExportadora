<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddVourcherIdToChronogramVouchers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('chronogram_vouchers', function (Blueprint $table) {
            $table->bigInteger('vouchers_id');
            $table->foreign('vouchers_id')->references('id')->on('vouchers');
            $table->primary(['vouchers_id','nro_cuota']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
        Schema::table('chronogram_vouchers', function (Blueprint $table) {
            $table->dropForeign('vouchers_id');
            $table->dropColumn('vouchers_id');
        });
    }
}
