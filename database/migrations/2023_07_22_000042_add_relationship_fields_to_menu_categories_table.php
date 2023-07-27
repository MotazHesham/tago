<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMenuCategoriesTable extends Migration
{
    public function up()
    {
        Schema::table('menu_categories', function (Blueprint $table) { 
            $table->unsignedBigInteger('menu_client_id')->nullable();
            $table->foreign('menu_client_id', 'menu_client_fk_8782724')->references('id')->on('menu_clients');
        });
    }
}
