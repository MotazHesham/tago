<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToUserLinksTable extends Migration
{
    public function up()
    {
        Schema::table('user_links', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id', 'user_fk_8576493')->references('id')->on('users');
            $table->unsignedBigInteger('main_link_id')->nullable();
            $table->foreign('main_link_id', 'main_link_fk_8576499')->references('id')->on('main_links');
        });
    }
}
