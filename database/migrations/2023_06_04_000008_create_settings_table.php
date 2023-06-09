<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('website_name');
            $table->string('email')->nullable();
            $table->string('phone_number');
            $table->string('facebook');
            $table->string('instagram');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
