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
            $table->string('order_num');
            $table->string('first_name');
            $table->string('last_name');
            $table->string('phone_number');
            $table->longText('shipping_address');
            $table->decimal('total_price', 15, 2)->nullable();
            $table->string('order_type')->default('normal');
            $table->string('delivery_status')->default('pending');
            $table->decimal('shipping_cost', 15, 2)->nullable();
            $table->unsignedBigInteger('country_id');
            $table->foreign('country_id', 'country_fk_8570018')->references('id')->on('countries');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
