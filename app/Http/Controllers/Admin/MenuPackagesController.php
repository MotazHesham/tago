<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMenuPackageRequest;
use App\Http\Requests\StoreMenuPackageRequest;
use App\Http\Requests\UpdateMenuPackageRequest;
use App\Models\MenuPackage;
use App\Models\MenuTheme;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MenuPackagesController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('menu_package_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = MenuPackage::with(['themes'])->select(sprintf('%s.*', (new MenuPackage)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'menu_package_show';
                $editGate      = 'menu_package_edit';
                $deleteGate    = 'menu_package_delete';
                $crudRoutePart = 'menu-packages';

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
            $table->editColumn('price', function ($row) {
                return $row->price ? $row->price : '';
            });
            $table->editColumn('menus', function ($row) {
                return $row->menus ? $row->menus : '';
            });
            $table->editColumn('themes', function ($row) {
                $labels = [];
                foreach ($row->themes as $theme) {
                    $labels[] = sprintf('<span class="label label-info label-many">%s</span>', $theme->name);
                }

                return implode(' ', $labels);
            });

            $table->rawColumns(['actions', 'placeholder', 'themes']);

            return $table->make(true);
        }

        return view('admin.menuPackages.index');
    }

    public function create()
    {
        abort_if(Gate::denies('menu_package_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $themes = MenuTheme::pluck('name', 'id');

        return view('admin.menuPackages.create', compact('themes'));
    }

    public function store(StoreMenuPackageRequest $request)
    {
        $menuPackage = MenuPackage::create($request->all());
        $menuPackage->themes()->sync($request->input('themes', []));
        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $menuPackage->id]);
        }

        return redirect()->route('admin.menu-packages.index');
    }

    public function edit(MenuPackage $menuPackage)
    {
        abort_if(Gate::denies('menu_package_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $themes = MenuTheme::pluck('name', 'id');

        $menuPackage->load('themes');

        return view('admin.menuPackages.edit', compact('menuPackage', 'themes'));
    }

    public function update(UpdateMenuPackageRequest $request, MenuPackage $menuPackage)
    {
        $menuPackage->update($request->all());
        $menuPackage->themes()->sync($request->input('themes', []));

        return redirect()->route('admin.menu-packages.index');
    }

    public function show(MenuPackage $menuPackage)
    {
        abort_if(Gate::denies('menu_package_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $menuPackage->load('themes');

        return view('admin.menuPackages.show', compact('menuPackage'));
    }

    public function destroy(MenuPackage $menuPackage)
    {
        abort_if(Gate::denies('menu_package_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $menuPackage->delete();

        return back();
    }

    public function massDestroy(MassDestroyMenuPackageRequest $request)
    {
        $menuPackages = MenuPackage::find(request('ids'));

        foreach ($menuPackages as $menuPackage) {
            $menuPackage->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('menu_package_create') && Gate::denies('menu_package_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new MenuPackage();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
