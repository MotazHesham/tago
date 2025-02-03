<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompanyPackagesTable extends Migration
{
    public function up()
    {
        Schema::create('company_packages', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->decimal('price', 15, 2);
            $table->date('start_at');
            $table->date('end_at');
            $table->integer('num_of_users');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
