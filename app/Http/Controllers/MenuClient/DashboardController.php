<?php

namespace App\Http\Controllers\MenuClient;

use App\Http\Controllers\Controller;
use App\Models\MenuClient;
use App\Models\MenuClientList;
use App\Models\MenuTheme;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\UpdateMenuClientRequest;
use App\Models\MenuClientPackage;
use App\Models\MenuProduct;
use App\Models\User;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends Controller
{
    use MediaUploadingTrait;

    public function check_subscription(){
        $now_date = date('Y-m-d');
        foreach(MenuClient::all() as $menuClient){
            $packages = MenuClientPackage::with('menu_package')
                            ->where('menu_client_id',$menuClient->id)
                            ->whereDate('start_at','<=',$now_date)
                            ->whereDate('end_at','>=',$now_date)
                            ->get(); 

            $allowed_menus_num = 0;
            foreach($packages as $raw){ 
                $allowed_menus_num += $raw->menu_package->menus ?? 0;
            }
            
            $active_menus = MenuClientList::where('menu_client_id',$menuClient->id)->where('active',1)->get();

            if($active_menus->count() > $allowed_menus_num){
                foreach($active_menus->take($active_menus->count() - $allowed_menus_num) as $menu){
                    $menu->active = 0;
                    $menu->save();
                }
            }
        }
    }

    public function menu($link){

        $menuClientList = MenuClientList::where('link',$link)->first();
        if(!$menuClientList){
            return abort(404,'Not Available Right Now.');
        }
        $menuClientList->load('categories.products'); 
        
        $menuClient = MenuClient::find($menuClientList->menu_client_id);
        $menuClient->load('user'); 
    
        $checkActive = 1;
        if(auth()->user() && auth()->user()->user_type == 'staff'){
            $checkActive = 0;
        }
        
        if($checkActive){ 
            if(!$menuClientList->active && auth()->user()){ 
                // if the menu not active we need to give the chance to the user to see the preview of his menu
                // so check if the logging user is the author of the scanned menu so open it
                $user = auth()->user();
                $current_client = MenuClient::where('user_id',$user->id)->first();
                if(!$current_client || $current_client->id != $menuClient->id){
                    return abort(404,'Not Available Right Now.');
                }
            }else{
                if(!$menuClientList->active){
                    return abort(404,'Not Available Right Now.');
                }
            }
        }
        

        return view('menuClient.clientThemes.theme'.$menuClientList->menu_theme_id,compact('menuClient','menuClientList'));
    }

    public function settings(){
        $user = auth()->user();
        $menuClient = MenuClient::where('user_id',$user->id)->first();
        return view('menuClient.settings',compact('user','menuClient'));
    }

    public function update_settings(UpdateMenuClientRequest $request){
        
        $user = auth()->user();
        $menuClient = MenuClient::where('user_id',$user->id)->first();
        
        $user->update([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number, 
            'password' => $request->password ? bcrypt($request->password) : $user->password,
        ]); 
        
        $menuClient->update([ 
            'about_us' => $request->about_us,
            'facebook' => $request->facebook,
            'twitter' => $request->twitter,
            'google' => $request->google,
            'linkedin' => $request->linkedin,
            'tiktok' => $request->tiktok,
            'youtube' => $request->youtube,
            'instagram' => $request->instagram,
            'whatsapp' => $request->whatsapp,
        ]);

        if ($request->input('logo', false)) {
            if (! $menuClient->logo || $request->input('logo') !== $menuClient->logo->file_name) {
                if ($menuClient->logo) {
                    $menuClient->logo->delete();
                }
                $menuClient->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
            }
        } elseif ($menuClient->logo) {
            $menuClient->logo->delete();
        }
        return redirect()->route('menuClient.settings');
    }

    public function show_photos(Request $request){
        $menuProduct = MenuProduct::find($request->id);
        return view('menuClient.partials.photos',compact('menuProduct'));
    }

    public function show_qr_code(Request $request){
        $text = $request->text;
        return view('menuClient.partials.qr_code',compact('text'));
    }

    public function dashboard(){
        $user = auth()->user();
        $menuClient = MenuClient::where('user_id',$user->id)->first();
        $menuClient->load('packages');
        $last_subscribe_package = $menuClient->packages()->with('menu_package')->latest()->first();
        return view('menuClient.dashboard',compact('user','menuClient','last_subscribe_package'));
    }

    public function storeCKEditorImages(Request $request)
    {  
        $model         = new User();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
