<?php

namespace App\Http\Controllers\Api\V1;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Resources\V1\UserResource;
use App\Models\OrderProduct;
use App\Models\UserLink;
use App\Traits\api_return;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use PDO;

class UsersApiController extends Controller
{
    use api_return; 
    use MediaUploadingTrait;

    public function delete_account(){
        auth()->user()->delete();
        return $this->returnSuccessMessage(trans('global.flash.api.success')); 
    }

    public function check_qr(Request $request){
        
        $rules = [  
            'token' => 'required',  
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        $token = str_replace('https://my-tago.com/user/token/','',$request->token);

        $orderProduct = OrderProduct::where('token',$token)->first();
        if(!$orderProduct){
            return $this->returnError('401', 'كود غير صحيح');
        }

        if($orderProduct->scanned_user_id){
            return $this->returnError('500', 'تم استخدام الكود من قبل');
        } 
        return $this->returnSuccessMessage(trans('global.flash.api.success')); 

    }

    public function connect_qr(Request $request){
        $rules = [  
            'token' => 'required',  
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }  
        $token = str_replace('https://my-tago.com/user/token/','',$request->token);

        $orderProduct = OrderProduct::where('token',$token)->first();
        
        if(!$orderProduct){
            return $this->returnError('401', 'كود غير صحيح');
        }

        if($orderProduct->scanned_user_id){
            return $this->returnError('500', 'تم استخدام الكود من قبل');
        }  

        $user = Auth::user();

        $orderProduct->scanned_user_id = $user->id;
        $orderProduct->save();
        
        $user->active_byqr = 1;
        $user->save();
        return $this->returnSuccessMessage(trans('global.flash.api.success')); 
    }
    
    public function profile()
    {
        return $this->returnData(new UserResource(Auth::user()));
    }

    public function update_profile(Request $request){
        
        $rules = [  
            'name' => 'nullable', 
            'email' => 'nullable|email|unique:users,email,' . Auth::id(), 
            'photo' => 'nullable', 
            'cover' => 'nullable', 
            'phone_number' => 'nullable', 
            'nickname' => 'nullable', 
            'bio' => 'nullable', 
            'email_active' => 'in:0,1', 
            'nickname_active' => 'in:0,1', 
            'bio_active' => 'in:0,1', 
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        $user = auth()->user();
        $user->update([
            'name' => request('name') ? request('name') : $user->name, 
            'email' => request('email') ? request('email') : $user->email,
            'phone_number' => request('phone_number') ? request('phone_number') : $user->phone_number,
            'nickname' => request('nickname') ? request('nickname') : $user->nickname, 
            'bio' => request('bio') ? request('bio') : $user->bio,
            'email_active' => request('email_active') ? request('email_active') : $user->email_active,
            'nickname_active' => request('nickname_active') ? request('nickname_active') : $user->nickname_active,
            'bio_active' => request('bio_active') ? request('bio_active') : $user->bio_active,
        ]);

        if (request('photo')&& request('photo')!= null) { 
            if($user->photo){
                $user->photo->delete();
            }
            $user->addMedia(request('photo'))->toMediaCollection('photo'); 
        }

        if (request('cover') && request('cover') != null) { 
            if($user->cover){
                $user->cover->delete();
            }
            $user->addMedia(request('cover'))->toMediaCollection('cover'); 
        }

        return $this->returnSuccessMessage(trans('global.flash.api.success'));
    }

    public function update_priority(Request $request){
        
        $rules = [ 
            'links' => 'required|array', 
            'links.*.id' => 'required',
            'links.*.priority' => 'required'
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        foreach($request->links as $link){
            $user_link = UserLink::find($link['id']);
            $user_link->priority = $link['priority'];
            $user_link->save();
        }

        return $this->returnSuccessMessage(trans('global.flash.api.success'));
    }

    public function update_active(Request $request){
        $rules = [  
            'id' => 'required',
            'active' => 'required|in:1,0', 
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        $user_link = UserLink::find($request->id);
        if($user_link){
            $user_link->update([  
                'active' => $request->active, 
            ]);
            if(request('photo')){
                $user_link->addMedia(request('photo'))->toMediaCollection('photo');
            }
            return $this->returnSuccessMessage(trans('global.flash.api.success'));
        }else{ 
            return $this->returnError('404', trans('global.flash.api.not_found'));
        }
    }

    public function update_link(Request $request){
        $rules = [  
            'id' => 'required',
            'name' => 'string|required',
            'link' => 'string|required',
            'photo' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        $user_link = UserLink::find($request->id);
        if($user_link){
            $user_link->update([  
                'name' => $request->name,
                'link' => $request->link,  
            ]);
            if(request('photo')){
                $user_link->addMedia(request('photo'))->toMediaCollection('photo');
            }
            return $this->returnSuccessMessage(trans('global.flash.api.success'));
        }else{ 
            return $this->returnError('404', trans('global.flash.api.not_found'));
        }
    }

    public function delete_link($id){ 
        $user_link = UserLink::find($id);
        if($user_link){
            $user_link->delete();
            return $this->returnSuccessMessage(trans('global.flash.api.success'));
        }else{ 
            return $this->returnError('404', trans('global.flash.api.not_found'));
        }
    }
    

    public function update_password(Request $request){
        $rules = [
            'old_password' => 'required|min:6|max:20',
            'password' => 'required|min:6|max:20|confirmed',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        $user = Auth::user();
        $hashedPassword = $user->password;
        if(!\Hash::check($request->old_password, $hashedPassword)){
            return $this->returnError('401',trans('global.flash.api.old_password_not_correct'));
        }else{
            $user->password = bcrypt($request->password);
            $user->save();
            return $this->returnSuccessMessage(trans('global.flash.api.password_updated'));
        }
    }

    public function update_fcm_token(Request $request){

        $rules = [
            'fcm_token' => 'required',
        ];

        $validator = Validator::make($request->all(), $rules);

        if ($validator->fails()) {
            return $this->returnError('401', $validator->errors());
        }

        $user = Auth::user();

        if(!$user)
            return $this->returnError('404',trans('global.flash.api.not_found'));

        $user->update($request->all());


        return $this->returnSuccessMessage('Token Updated Successfully');
    }
}
