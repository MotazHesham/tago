<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMainLinksTable extends Migration
{
    public function up()
    {
        Schema::create('main_links', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('base_url')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
