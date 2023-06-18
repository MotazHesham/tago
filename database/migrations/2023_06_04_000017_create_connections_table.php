<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateConnectionsTable extends Migration
{
    public function up()
    {
        Schema::create('connections', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->string('email');
            $table->string('title');
            $table->string('phone_number');
            $table->string('message');
            $table->string('link')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
