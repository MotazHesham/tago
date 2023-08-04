<?php

namespace App\Http\Controllers\MenuClient;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMenuProductRequest;
use App\Http\Requests\StoreMenuProductRequest;
use App\Http\Requests\UpdateMenuProductRequest;
use App\Models\MenuCategory;
use App\Models\MenuClient;
use App\Models\MenuProduct;
use Gate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class MenuProductsController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    { 
        $menuClient = MenuClient::where('user_id',Auth::id())->first();
        $products = MenuProduct::where('menu_client_id',$menuClient->id)->with(['menu_category'])->orderBy('created_at','desc')->simplePaginate(10);

        return view('menuClient.menuProducts.index',compact('products','menuClient'));
    }

    public function create()
    { 
        $menuClient = MenuClient::where('user_id',Auth::id())->first();
        $menu_categories = MenuCategory::where('menu_client_id',$menuClient->id)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), ''); 

        return view('menuClient.menuProducts.create', compact('menu_categories','menuClient'));
    }

    public function store(StoreMenuProductRequest $request)
    {
        $menuProduct = MenuProduct::create($request->all());
        if ($request->input('banner', false)) {
            $menuProduct->addMedia(storage_path('tmp/uploads/' . basename($request->input('banner'))))->toMediaCollection('banner');
        }

        if (count($menuProduct->photos) > 0) {
            foreach ($menuProduct->photos as $media) {
                if (! in_array($media->file_name, $request->input('photos', []))) {
                    $media->delete();
                }
            }
        }
        $media = $menuProduct->photos->pluck('file_name')->toArray();
        foreach ($request->input('photos', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $menuProduct->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photos');
            }
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $menuProduct->id]);
        }

        return redirect()->route('menuClient.menu-products.index');
    }

    public function edit(MenuProduct $menuProduct)
    {  
        $menuClient = MenuClient::where('user_id',Auth::id())->first();
        $menu_categories = MenuCategory::where('menu_client_id',$menuClient->id)->pluck('name', 'id')->prepend(trans('global.pleaseSelect'), ''); 

        $menuProduct->load('menu_category');

        return view('menuClient.menuProducts.edit', compact('menuProduct', 'menu_categories'));
    }

    public function update(UpdateMenuProductRequest $request, MenuProduct $menuProduct)
    {
        $menuProduct->update($request->all());

        if ($request->input('banner', false)) {
            if (! $menuProduct->banner || $request->input('banner') !== $menuProduct->banner->file_name) {
                if ($menuProduct->banner) {
                    $menuProduct->banner->delete();
                }
                $menuProduct->addMedia(storage_path('tmp/uploads/' . basename($request->input('banner'))))->toMediaCollection('banner');
            }
        } elseif ($menuProduct->banner) {
            $menuProduct->banner->delete();
        }

        if (count($menuProduct->photos) > 0) {
            foreach ($menuProduct->photos as $media) {
                if (! in_array($media->file_name, $request->input('photos', []))) {
                    $media->delete();
                }
            }
        }
        $media = $menuProduct->photos->pluck('file_name')->toArray();
        foreach ($request->input('photos', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $menuProduct->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('photos');
            }
        }
        
        return redirect()->route('menuClient.menu-products.index');
    } 

    public function destroy(MenuProduct $menuProduct)
    { 

        $menuProduct->delete();

        return back();
    } 
    public function storeCKEditorImages(Request $request)
    {  
        $model         = new MenuProduct();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
