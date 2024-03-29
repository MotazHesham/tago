<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTemplatesTable extends Migration
{
    public function up()
    {
        Schema::create('templates', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('type')->default('business_card');
            $table->string('name');
            $table->decimal('price', 15, 2);
            $table->longText('canvas_pages')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
