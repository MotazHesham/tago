<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuClientListsTable extends Migration
{
    public function up()
    {
        Schema::create('menu_client_lists', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('about_us')->nullable();
            $table->string('facebook')->nullable();
            $table->string('twitter')->nullable();
            $table->string('google')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('tiktok')->nullable();
            $table->string('youtube')->nullable();
            $table->string('instagram')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('active')->default(0);
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
