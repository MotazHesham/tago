<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('order_template', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('quantity');
            $table->decimal('price',15,2);
            $table->boolean('has_nfc')->default(0);
            $table->decimal('total_cost',15,2);
            $table->longText('canvas_pages')->nullable();
            $table->string('token')->nullable();
            $table->unsignedBigInteger('order_id');
            $table->foreign('order_id', 'order_id_fk_85252315')->references('id')->on('orders')->onDelete('cascade');
            $table->unsignedBigInteger('scanned_user_id')->nullable();
            $table->foreign('scanned_user_id', 'scanned_user_fk_121263244')->references('id')->on('users')->onDelete('cascade');
            $table->unsignedBigInteger('template_id');
            $table->foreign('template_id', 'template_id_fk_852215')->references('id')->on('templates')->onDelete('cascade');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('order_template');
    }
};
