<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPurchaseOrderIdToVouchers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        //
        Schema::table('vouchers', function (Blueprint $table) {
            
            $table->string('purchase_order_id',10)->default('');
            $table->foreign('purchase_order_id')->references('id')->on('purchase_orders');

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
        Schema::table('vouchers', function (Blueprint $table) {
            $table->dropForeign('purchase_order_id');
            $table->dropColumn('purchase_order_id');
        });
    }
}
