<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMenuClientListRequest;
use App\Http\Requests\StoreMenuClientListRequest;
use App\Http\Requests\UpdateMenuClientListRequest;
use App\Models\MenuClient;
use App\Models\MenuClientList;
use App\Models\MenuClientPackage;
use App\Models\MenuTheme;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MenuClientListController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('menu_client_list_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = MenuClientList::with(['menu_client_package', 'menu_client'])->select(sprintf('%s.*', (new MenuClientList)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'menu_client_list_show';
                $editGate      = 'menu_client_list_edit';
                $deleteGate    = 'menu_client_list_delete';
                $crudRoutePart = 'menu-client-lists';

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
            $table->addColumn('menu_client_package_start_at', function ($row) {
                return $row->menu_client_package ? $row->menu_client_package->start_at : '';
            });

            $table->editColumn('logo', function ($row) {
                if ($photo = $row->logo) {
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

            $table->rawColumns(['actions', 'placeholder', 'menu_client_package', 'logo', 'menu_client']);

            return $table->make(true);
        }

        return view('admin.menuClientLists.index');
    }

    public function create()
    {
        abort_if(Gate::denies('menu_client_list_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $menu_themes = MenuTheme::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $menu_clients = MenuClient::pluck('facebook', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.menuClientLists.create', compact('menu_themes', 'menu_clients'));
    }

    public function store(StoreMenuClientListRequest $request)
    {
        $menuClientList = MenuClientList::create($request->all());

        if ($request->input('logo', false)) {
            $menuClientList->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $menuClientList->id]);
        }

        return redirect()->route('admin.menu-client-lists.index');
    }

    public function edit(MenuClientList $menuClientList)
    {
        abort_if(Gate::denies('menu_client_list_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $menu_client_packages = MenuClientPackage::pluck('start_at', 'id')->prepend(trans('global.pleaseSelect'), '');

        $menu_clients = MenuClient::pluck('facebook', 'id')->prepend(trans('global.pleaseSelect'), '');

        $menuClientList->load('menu_theme', 'menu_client');

        return view('admin.menuClientLists.edit', compact('menuClientList', 'menu_client_packages', 'menu_clients'));
    }

    public function update(UpdateMenuClientListRequest $request, MenuClientList $menuClientList)
    {
        $menuClientList->update($request->all());

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

        return redirect()->route('admin.menu-client-lists.index');
    }

    public function show(MenuClientList $menuClientList)
    {
        abort_if(Gate::denies('menu_client_list_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $menuClientList->load('menu_theme', 'menu_client', 'menuClientListMenuCategories');

        return view('admin.menuClientLists.show', compact('menuClientList'));
    }

    public function destroy(MenuClientList $menuClientList)
    {
        abort_if(Gate::denies('menu_client_list_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $menuClientList->delete();

        return back();
    }

    public function massDestroy(MassDestroyMenuClientListRequest $request)
    {
        $menuClientLists = MenuClientList::find(request('ids'));

        foreach ($menuClientLists as $menuClientList) {
            $menuClientList->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('menu_client_list_create') && Gate::denies('menu_client_list_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new MenuClientList();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
