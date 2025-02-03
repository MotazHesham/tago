<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUsersTable extends Migration
{
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('provider_id',50)->nullable();
            $table->string('user_type')->default('staff')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable()->unique();
            $table->string('phone_number')->nullable();
            $table->datetime('email_verified_at')->nullable();
            $table->string('password')->nullable();
            $table->string('remember_token')->nullable();
            $table->string('nickname')->nullable();
            $table->string('bio')->nullable();
            $table->boolean('email_active')->default(0)->nullable();
            $table->boolean('nickname_active')->default(0)->nullable();
            $table->boolean('bio_active')->default(0)->nullable();
            $table->boolean('active_byqr')->default(0)->nullable();
            $table->boolean('approved')->default(1);
            $table->text('fcm_token')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
