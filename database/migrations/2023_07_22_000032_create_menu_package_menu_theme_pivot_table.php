<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMenuPackageMenuThemePivotTable extends Migration
{
    public function up()
    {
        Schema::create('menu_package_menu_theme', function (Blueprint $table) {
            $table->unsignedBigInteger('menu_package_id');
            $table->foreign('menu_package_id', 'menu_package_id_fk_8782564')->references('id')->on('menu_packages')->onDelete('cascade');
            $table->unsignedBigInteger('menu_theme_id');
            $table->foreign('menu_theme_id', 'menu_theme_id_fk_8782564')->references('id')->on('menu_themes')->onDelete('cascade');
        });
    }
}
