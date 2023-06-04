<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\LinkCategoryResource;
use App\Models\LinkCategory;
use App\Models\MainLink;
use Illuminate\Http\Request;
use App\Traits\api_return;
use App\Models\User;
use App\Models\UserLink;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class MainLinksApiController extends Controller
{
    use api_return; 

    public function index(){
        $mainlinks = LinkCategory::with('mainlinks')->get();
        $resource = LinkCategoryResource::collection($mainlinks); 
        return $this->returnData($resource,"success");
    }

    public function add(Request $request){
        
        $rules = [ 
            'main_link_id' => 'required',
            'name' => 'string|required',
            'link' => 'string|required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        if(!MainLink::find($request->main_link_id)){
            return $this->returnError('404', trans('global.flash.api.not_found'));
        } 

        $user_link = UserLink::create([
            'main_link_id' => $request->main_link_id,
            'user_id' => Auth::id(),
            'name' => $request->name,
            'link' => $request->link, 
            'active' => 1,
        ]);   

        if(request('photo')){
            $user_link->addMedia(request('photo'))->toMediaCollection('photo');
        }
        
        return $this->returnSuccessMessage(trans('global.flash.api.success'));
    }
}
