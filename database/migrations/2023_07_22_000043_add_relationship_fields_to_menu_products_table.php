<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMenuProductsTable extends Migration
{
    public function up()
    {
        Schema::table('menu_products', function (Blueprint $table) {
            $table->unsignedBigInteger('menu_category_id')->nullable();
            $table->foreign('menu_category_id', 'menu_category_fk_8782719')->references('id')->on('menu_categories');
            $table->unsignedBigInteger('menu_client_id')->nullable();
            $table->foreign('menu_client_id', 'menu_client_fk_8782720')->references('id')->on('menu_clients');
        });
    }
}
