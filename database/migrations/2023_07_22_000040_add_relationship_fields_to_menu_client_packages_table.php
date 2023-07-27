<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToMenuClientPackagesTable extends Migration
{
    public function up()
    {
        Schema::table('menu_client_packages', function (Blueprint $table) {
            $table->unsignedBigInteger('menu_client_id')->nullable();
            $table->foreign('menu_client_id', 'menu_client_fk_8782581')->references('id')->on('menu_clients');
            $table->unsignedBigInteger('menu_package_id')->nullable();
            $table->foreign('menu_package_id', 'menu_package_fk_8782582')->references('id')->on('menu_packages');
        });
    }
}
