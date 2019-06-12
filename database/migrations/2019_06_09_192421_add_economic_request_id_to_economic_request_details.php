<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEconomicRequestIdToEconomicRequestDetails extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('economic_request_details', function (Blueprint $table) {
            $table->string('economic_request_id',10);
            $table->foreign('economic_request_id')->references('id')->on('economic_requests');
            $table->primary(['economic_request_id','numero_item']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('economic_request_details', function (Blueprint $table) {
            $table->dropForeign('economic_request_id');
            $table->dropColumn('economic_request_id');
        });
    }
}
