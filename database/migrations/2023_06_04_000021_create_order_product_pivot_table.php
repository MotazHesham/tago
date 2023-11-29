<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderProductPivotTable extends Migration
{
    public function up()
    {
        Schema::create('order_product', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('quantity');
            $table->decimal('price',15,2);
            $table->decimal('total_cost',15,2);
            $table->string('variant')->nullable();
            $table->string('token')->nullable();
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id', 'order_id_fk_8576515')->references('id')->on('orders')->onDelete('cascade');
            $table->unsignedBigInteger('scanned_user_id');
            $table->foreign('scanned_user_id', 'scanned_user_fk_124124')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('product_id');
            $table->foreign('product_id', 'product_id_fk_8576515')->references('id')->on('products')->onDelete('cascade');
            $table->timestamps();
        });
    }
}
