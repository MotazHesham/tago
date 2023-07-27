<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTutorialsTable extends Migration
{
    public function up()
    {
        Schema::create('tutorials', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('iframe');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
