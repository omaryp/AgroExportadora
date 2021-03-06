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
            $table->bigInteger('voucher_id');
            $table->foreign('voucher_id')->references('id')->on('vouchers');
            $table->primary(['voucher_id','nro_cuota']);
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
            $table->dropForeign('voucher_id');
            $table->dropColumn('voucher_id');
        });
    }
}
