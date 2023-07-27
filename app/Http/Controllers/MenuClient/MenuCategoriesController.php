<?php

namespace App\Http\Controllers\MenuClient;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMenuCategoryRequest;
use App\Http\Requests\StoreMenuCategoryRequest;
use App\Http\Requests\UpdateMenuCategoryRequest;
use App\Models\MenuCategory;
use App\Models\MenuClient;
use App\Models\MenuClientList;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MenuCategoriesController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {   
        $menuClient = MenuClient::where('user_id',Auth::id())->first();
        $categories = MenuCategory::where('menu_client_id',$menuClient->id)->orderBy('created_at','desc')->simplePaginate(10);

        return view('menuClient.menuCategories.index',compact('categories'));
    }

    public function create()
    {   
        $menuClient = MenuClient::where('user_id',Auth::id())->first();

        return view('menuClient.menuCategories.create',compact('menuClient'));
    }

    public function store(StoreMenuCategoryRequest $request)
    { 
        $menuCategory = MenuCategory::create($request->all()); 
        if ($request->input('banner', false)) {
            $menuCategory->addMedia(storage_path('tmp/uploads/' . basename($request->input('banner'))))->toMediaCollection('banner');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $menuCategory->id]);
        }

        return redirect()->route('menuClient.menu-categories.index');
    }

    public function edit(MenuCategory $menuCategory)
    {   

        return view('menuClient.menuCategories.edit', compact('menuCategory'));
    }

    public function update(UpdateMenuCategoryRequest $request, MenuCategory $menuCategory)
    {
        $menuCategory->update($request->all()); 
        if ($request->input('banner', false)) {
            if (! $menuCategory->banner || $request->input('banner') !== $menuCategory->banner->file_name) {
                if ($menuCategory->banner) {
                    $menuCategory->banner->delete();
                }
                $menuCategory->addMedia(storage_path('tmp/uploads/' . basename($request->input('banner'))))->toMediaCollection('banner');
            }
        } elseif ($menuCategory->banner) {
            $menuCategory->banner->delete();
        }

        return redirect()->route('menuClient.menu-categories.index');
    } 

    public function destroy(MenuCategory $menuCategory)
    {  
        $menuCategory->delete();

        return back();
    } 

    public function storeCKEditorImages(Request $request)
    {  
        $model         = new MenuCategory();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
