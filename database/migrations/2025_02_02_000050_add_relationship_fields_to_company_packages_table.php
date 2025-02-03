<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddRelationshipFieldsToCompanyPackagesTable extends Migration
{
    public function up()
    {
        Schema::table('company_packages', function (Blueprint $table) {
            $table->unsignedBigInteger('company_id')->nullable();
            $table->foreign('company_id', 'company_fk_10424215')->references('id')->on('companies');
        });
    }
}
