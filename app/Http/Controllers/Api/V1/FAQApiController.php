<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller; 
use App\Http\Resources\V1\FaqQuestionResource; 
use App\Models\FaqQuestion;
use App\Traits\api_return; 

class FAQApiController extends Controller
{
    use api_return;

    public function faq(){
        $faq_questions = FaqQuestion::with('category')->whereHas('category',function($q){
            return $q->where('category','application');
        })->get();
        return $this->returnData(FaqQuestionResource::collection($faq_questions));
    }
}
