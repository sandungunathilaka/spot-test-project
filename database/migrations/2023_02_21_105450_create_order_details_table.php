<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {

         Schema::create('order_details', function (Blueprint $table) {
            $table->id('order_id')->length(11);
            $table->string('customer_name')->length(255);
            $table->float('order_value',8, 2)->length(11);
            $table->string('order_status')->length(255);
            $table->integer('process_id')->length(2);
            $table->timestamp('order_date');
        });


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('order_details');
    }
};
