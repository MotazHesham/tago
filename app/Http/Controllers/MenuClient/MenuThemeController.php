<?php

namespace App\Http\Controllers\MenuClient;

use App\Http\Controllers\Controller;
use App\Models\MenuClient;
use App\Models\MenuClientList;
use App\Models\MenuTheme;
use Illuminate\Http\Request;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreMenuClientListRequest;
use App\Http\Requests\UpdateMenuClientListRequest;
use App\Models\MenuCategory;
use App\Models\MenuClientPackage;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class MenuThemeController extends Controller
{
    use MediaUploadingTrait;
    
    public function menu_theme($id){
        $theme = MenuTheme::findOrFail($id);
        return view('menuClient.themes.theme'.$id,compact('theme'));
    }

    public function menu_active($id){
        $menuClient = MenuClient::where('user_id',Auth::id())->first();
        $menuClientList = MenuClientList::findOrFail($id);

        if($menuClient->id != $menuClientList->menu_client_id){
            alert('Not Auth','','warning');
            return redirect()->route('menuClient.menus.index');
        }

        if($menuClientList->active){
            $menuClientList->active = 0;
        }else{
            $now_date = date('Y-m-d');
            $active_menus_num = MenuClientList::where('menu_client_id',$menuClient->id)->where('active',1)->count();
            $available_packages = MenuClientPackage::with('menu_package')
                                                    ->where('menu_client_id',$menuClient->id)
                                                    ->whereDate('start_at','<=',$now_date)
                                                    ->whereDate('end_at','>=',$now_date)
                                                    ->get(); 
            $allowed_menus_num = 0; 
            if($available_packages->count() == 0){ 
                alert('You Haven"t any active Subscription right now','','warning');
                return redirect()->route('menuClient.menus.index');
            }
            foreach($available_packages as $raw){
                $allowed_menus_num += $raw->menu_package->menus ?? 0;
            }
            if($allowed_menus_num <= $active_menus_num){
                alert('Exceeded Allowed menu Number','','warning');
                return redirect()->route('menuClient.menus.index');
            }else{
                $menuClientList->active = 1;
            } 
        }
        $menuClientList->save();
        
        return redirect()->route('menuClient.menus.index');
    }

    public function index(){ 
        $menuClient = MenuClient::where('user_id',Auth::id())->first();
        $menus = MenuClientList::with('menu_theme')->where('menu_client_id',$menuClient->id)->orderBy('created_at','desc')->simplePaginate(10);
        return view("menuClient.menus.index",compact('menus'));
    }

    public function create(){
        $menu_themes = MenuTheme::pluck('name', 'id');  
        $menuClient = MenuClient::where('user_id',Auth::id())->first(); 
        $menu_categories = MenuCategory::where('menu_client_id',$menuClient->id)->pluck('name', 'id'); 
        return view("menuClient.menus.create",compact('menu_themes','menuClient','menu_categories'));
    }

    public function store(StoreMenuClientListRequest $request)
    {
        $menuClientList = MenuClientList::create($request->all());
        $menuClientList->categories()->sync($request->input('categories', []));

        if ($request->input('logo', false)) {
            $menuClientList->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
        }

        if ($request->input('background', false)) {
            $menuClientList->addMedia(storage_path('tmp/uploads/' . basename($request->input('background'))))->toMediaCollection('background');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $menuClientList->id]);
        } 
        return redirect()->route('menuClient.menus.index');
    }
    
    public function edit(Request $request)
    {  
        $menuClientList = MenuClientList::find($request->id);
        $menu_themes = MenuTheme::pluck('name', 'id');  
        $menu_categories = MenuCategory::where('menu_client_id',$menuClientList->menu_client_id)->pluck('name', 'id'); 

        $menuClientList->load('menu_theme', 'menu_client');

        return view('menuClient.menus.edit', compact('menuClientList', 'menu_themes','menu_categories'));
    }

    public function update(UpdateMenuClientListRequest $request)
    {
        $menuClientList = MenuClientList::findOrFail($request->id);
        $menuClientList->update($request->all());
        $menuClientList->categories()->sync($request->input('categories', []));

        if ($request->input('logo', false)) {
            if (! $menuClientList->logo || $request->input('logo') !== $menuClientList->logo->file_name) {
                if ($menuClientList->logo) {
                    $menuClientList->logo->delete();
                }
                $menuClientList->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
            }
        } elseif ($menuClientList->logo) {
            $menuClientList->logo->delete();
        }

        if ($request->input('background', false)) {
            if (! $menuClientList->background || $request->input('background') !== $menuClientList->background->file_name) {
                if ($menuClientList->background) {
                    $menuClientList->background->delete();
                }
                $menuClientList->addMedia(storage_path('tmp/uploads/' . basename($request->input('background'))))->toMediaCollection('background');
            }
        } elseif ($menuClientList->background) {
            $menuClientList->background->delete();
        }

        return redirect()->route('menuClient.menus.index');
    }
    
    public function destroy($id)
    {
        $menuClientList = MenuClientList::findOrFail($id);

        $menuClientList->delete();

        return back();
    }

    public function storeCKEditorImages(Request $request)
    {

        $model         = new MenuClientList();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
