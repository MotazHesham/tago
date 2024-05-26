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
        Schema::create('user_link_views', function (Blueprint $table) {
            $table->bigIncrements('id'); 
            $table->string('ip')->nullable();
            $table->integer('counter')->default(1);
            $table->unsignedBigInteger('user_link_id')->nullable();
            $table->foreign('user_link_id', 'user_link_fk_8542193')->references('id')->on('user_links');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_link_views');
    }
};
