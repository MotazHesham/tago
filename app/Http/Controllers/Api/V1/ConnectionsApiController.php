<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Resources\V1\ConnectionsResource;
use App\Models\Connection;
use Illuminate\Http\Request;
use App\Traits\api_return;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ConnectionsApiController extends Controller
{
    use api_return; 

    public function index(){
        $connections = Connection::where('user_id',Auth::id())->orderBy('created_at','desc')->paginate(15);
        $resource = ConnectionsResource::collection($connections); 
        return $this->returnPaginationData($resource,$connections,"success");
    }

    public function add(Request $request){
        
        $rules = [   
            'name' => 'string|required',
            'email'=> 'email|required',
            'phone_number' => 'required|size:11|regex:/(01)[0-9]{9}/',
            'title'=> 'string|required',
            'link' => 'string',
            'message' => 'string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        } 

        $connection = Connection::create([ 
            'user_id' => Auth::id(),
            'name' => $request->name,
            'email' => $request->email,  
            'link' => $request->link,  
            'title' => $request->title,  
            'message' => $request->message,  
            'phone_number' => $request->phone_number,  
        ]);   

        if(request('photo')){
            $connection->addMedia(request('photo'))->toMediaCollection('photo');
        }
        
        return $this->returnSuccessMessage(trans('global.flash.api.success'));
    }
    
    public function update(Request $request){
        
        $rules = [   
            'name' => 'string|required',
            'email'=> 'email|required',
            'phone_number' => 'required|size:11|regex:/(01)[0-9]{9}/',
            'title'=> 'string|required',
            'link' => 'string',
            'message' => 'string',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        } 
            
        $connection = Connection::find($request->id);

        if(!$connection){ 
            return $this->returnError('404', trans('global.flash.api.not_found'));
        }
        $connection->update([  
            'name' => $request->name,
            'email' => $request->email,  
            'link' => $request->link,  
            'title' => $request->title,  
            'message' => $request->message,  
            'phone_number' => $request->phone_number,  
        ]);   

        if(request('photo')){
            $connection->addMedia(request('photo'))->toMediaCollection('photo');
        }
        
        return $this->returnSuccessMessage(trans('global.flash.api.success'));
    }
    
    public function delete($id){  
            
        $connection = Connection::find($id);

        if(!$connection){ 
            return $this->returnError('404', trans('global.flash.api.not_found'));
        }
        $connection->delete();
        
        return $this->returnSuccessMessage(trans('global.flash.api.success'));
    }
}
