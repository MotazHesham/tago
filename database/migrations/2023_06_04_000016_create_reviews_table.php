<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateReviewsTable extends Migration
{
    public function up()
    {
        Schema::create('reviews', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('name');
            $table->longText('review');
            $table->float('rate', 3, 1)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
