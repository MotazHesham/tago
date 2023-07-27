<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSettingsTable extends Migration
{
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('website_name');
            $table->longText('description');
            $table->longText('how_it_work_description');
            $table->longText('how_it_work');
            $table->longText('contact_description');
            $table->string('email');
            $table->string('phone_number');
            $table->longText('address');
            $table->string('facebook');
            $table->string('instagram');
            $table->string('tiktok');
            $table->string('youtube'); 
            $table->longText('keywords_seo');
            $table->string('author_seo');
            $table->string('sitemap_link_seo');
            $table->longText('description_seo');
            $table->text('why_us');
            $table->text('our_mission');
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
