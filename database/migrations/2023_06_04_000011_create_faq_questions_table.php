<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFaqQuestionsTable extends Migration
{
    public function up()
    {
        Schema::create('faq_questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->longText('question_en')->nullable();
            $table->longText('question_ar')->nullable();
            $table->longText('answer_en')->nullable();
            $table->longText('answer_ar')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
}
