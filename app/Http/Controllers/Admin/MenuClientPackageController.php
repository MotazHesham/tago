<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMenuClientPackageRequest;
use App\Http\Requests\StoreMenuClientPackageRequest;
use App\Http\Requests\UpdateMenuClientPackageRequest;
use App\Models\MenuClient;
use App\Models\MenuClientPackage;
use App\Models\MenuPackage;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MenuClientPackageController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('menu_client_package_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = MenuClientPackage::with(['menu_client', 'menu_package'])->select(sprintf('%s.*', (new MenuClientPackage)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'menu_client_package_show';
                $editGate      = 'menu_client_package_edit';
                $deleteGate    = 'menu_client_package_delete';
                $crudRoutePart = 'menu-client-packages';

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
            $table->addColumn('menu_client_facebook', function ($row) {
                return $row->menu_client ? $row->menu_client->facebook : '';
            });

            $table->addColumn('menu_package_name', function ($row) {
                return $row->menu_package ? $row->menu_package->name : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'menu_client', 'menu_package']);

            return $table->make(true);
        }

        return view('admin.menuClientPackages.index');
    }

    public function create()
    {
        abort_if(Gate::denies('menu_client_package_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $menu_clients = MenuClient::pluck('facebook', 'id')->prepend(trans('global.pleaseSelect'), '');

        $menu_packages = MenuPackage::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.menuClientPackages.create', compact('menu_clients', 'menu_packages'));
    }

    public function store(StoreMenuClientPackageRequest $request)
    {
        $menuClientPackage = MenuClientPackage::create($request->all());

        return redirect()->route('admin.menu-clients.show',$menuClientPackage->menu_client_id);
    }

    public function edit(MenuClientPackage $menuClientPackage)
    {
        abort_if(Gate::denies('menu_client_package_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $menu_clients = MenuClient::pluck('facebook', 'id')->prepend(trans('global.pleaseSelect'), '');

        $menu_packages = MenuPackage::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $menuClientPackage->load('menu_client', 'menu_package');

        return view('admin.menuClientPackages.edit', compact('menuClientPackage', 'menu_clients', 'menu_packages'));
    }

    public function update(UpdateMenuClientPackageRequest $request, MenuClientPackage $menuClientPackage)
    {
        $menuClientPackage->update($request->all());

        return redirect()->route('admin.menu-client-packages.index');
    }

    public function show(MenuClientPackage $menuClientPackage)
    {
        abort_if(Gate::denies('menu_client_package_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $menuClientPackage->load('menu_client', 'menu_package');

        return view('admin.menuClientPackages.show', compact('menuClientPackage'));
    }

    public function destroy(MenuClientPackage $menuClientPackage)
    {
        abort_if(Gate::denies('menu_client_package_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $menuClientPackage->delete();

        return back();
    }

    public function massDestroy(MassDestroyMenuClientPackageRequest $request)
    {
        $menuClientPackages = MenuClientPackage::find(request('ids'));

        foreach ($menuClientPackages as $menuClientPackage) {
            $menuClientPackage->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
