<?php

namespace App\Http\Controllers\Admin;

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
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MenuCategoriesController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('menu_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = MenuCategory::with(['menu_client', 'menu_client_lists'])->select(sprintf('%s.*', (new MenuCategory)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'menu_category_show';
                $editGate      = 'menu_category_edit';
                $deleteGate    = 'menu_category_delete';
                $crudRoutePart = 'menu-categories';

                return view('partials.datatablesActions', compact(
                    'viewGate',
                    'editGate',
                    'deleteGate',
                    'crudRoutePart',
                    'row'
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('banner', function ($row) {
                if ($photo = $row->banner) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->addColumn('menu_client_facebook', function ($row) {
                return $row->menu_client ? $row->menu_client->facebook : '';
            });

            $table->editColumn('menu_client_list', function ($row) {
                $labels = [];
                foreach ($row->menu_client_lists as $menu_client_list) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $menu_client_list->facebook);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'banner', 'menu_client', 'menu_client_list']);

            return $table->make(true);
        }

        return view('admin.menuCategories.index');
    }

    public function create()
    {
        abort_if(Gate::denies('menu_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $menu_clients = MenuClient::pluck('facebook', 'id')->prepend(trans('global.pleaseSelect'), '');

        $menu_client_lists = MenuClientList::pluck('facebook', 'id');

        return view('admin.menuCategories.create', compact('menu_client_lists', 'menu_clients'));
    }

    public function store(StoreMenuCategoryRequest $request)
    {
        $menuCategory = MenuCategory::create($request->all());
        $menuCategory->menu_client_lists()->sync($request->input('menu_client_lists', []));
        if ($request->input('banner', false)) {
            $menuCategory->addMedia(storage_path('tmp/uploads/' . basename($request->input('banner'))))->toMediaCollection('banner');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $menuCategory->id]);
        }

        return redirect()->route('admin.menu-categories.index');
    }

    public function edit(MenuCategory $menuCategory)
    {
        abort_if(Gate::denies('menu_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $menu_clients = MenuClient::pluck('facebook', 'id')->prepend(trans('global.pleaseSelect'), '');

        $menu_client_lists = MenuClientList::pluck('facebook', 'id');

        $menuCategory->load('menu_client', 'menu_client_lists');

        return view('admin.menuCategories.edit', compact('menuCategory', 'menu_client_lists', 'menu_clients'));
    }

    public function update(UpdateMenuCategoryRequest $request, MenuCategory $menuCategory)
    {
        $menuCategory->update($request->all());
        $menuCategory->menu_client_lists()->sync($request->input('menu_client_lists', []));
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

        return redirect()->route('admin.menu-categories.index');
    }

    public function show(MenuCategory $menuCategory)
    {
        abort_if(Gate::denies('menu_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $menuCategory->load('menu_client', 'menu_client_lists', 'menuCategoryMenuProducts');

        return view('admin.menuCategories.show', compact('menuCategory'));
    }

    public function destroy(MenuCategory $menuCategory)
    {
        abort_if(Gate::denies('menu_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $menuCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyMenuCategoryRequest $request)
    {
        $menuCategories = MenuCategory::find(request('ids'));

        foreach ($menuCategories as $menuCategory) {
            $menuCategory->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('menu_category_create') && Gate::denies('menu_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new MenuCategory();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
