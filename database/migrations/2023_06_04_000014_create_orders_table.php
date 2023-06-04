<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone_number');
            $table->longText('shipping_address');
            $table->decimal('total_price', 15, 2)->nullable();
            $table->string('delivery_status');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
