<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMenuClientListsTable extends Migration
{
    public function up()
    {
        Schema::table('menu_client_lists', function (Blueprint $table) {
            $table->unsignedBigInteger('menu_theme_id')->nullable();
            $table->foreign('menu_theme_id', 'menu_theme_fk_8782589')->references('id')->on('menu_themes');
            $table->unsignedBigInteger('menu_client_id')->nullable();
            $table->foreign('menu_client_id', 'menu_client_fk_8782725')->references('id')->on('menu_clients');
        });
    }
}
