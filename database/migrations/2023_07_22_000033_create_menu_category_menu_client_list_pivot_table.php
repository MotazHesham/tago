<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuCategoryMenuClientListPivotTable extends Migration
{
    public function up()
    {
        Schema::create('menu_category_menu_client_list', function (Blueprint $table) {
            $table->unsignedBigInteger('menu_category_id');
            $table->foreign('menu_category_id', 'menu_category_id_fk_8782747')->references('id')->on('menu_categories')->onDelete('cascade');
            $table->unsignedBigInteger('menu_client_list_id');
            $table->foreign('menu_client_list_id', 'menu_client_list_id_fk_8782747')->references('id')->on('menu_client_lists')->onDelete('cascade');
        });
    }
}
