<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\FaqCategoryResource;
use App\Models\FaqCategory;
use App\Traits\api_return;
use Illuminate\Http\Request;

class FAQApiController extends Controller
{
    use api_return;

    public function faq(){
        $faq_categories = FaqCategory::with('faq_questions')->get();
        return $this->returnData(FaqCategoryResource::collection($faq_categories));
    }
}
