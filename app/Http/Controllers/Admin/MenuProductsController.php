<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyMenuProductRequest;
use App\Http\Requests\StoreMenuProductRequest;
use App\Http\Requests\UpdateMenuProductRequest;
use App\Models\MenuCategory;
use App\Models\MenuClient;
use App\Models\MenuProduct;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MenuProductsController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('menu_product_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = MenuProduct::with(['menu_category', 'menu_client'])->select(sprintf('%s.*', (new MenuProduct)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'menu_product_show';
                $editGate      = 'menu_product_edit';
                $deleteGate    = 'menu_product_delete';
                $crudRoutePart = 'menu-products';

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
            $table->addColumn('menu_category_name', function ($row) {
                return $row->menu_category ? $row->menu_category->name : '';
            });

            $table->addColumn('menu_client_facebook', function ($row) {
                return $row->menu_client ? $row->menu_client->facebook : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'menu_category', 'menu_client']);

            return $table->make(true);
        }

        return view('admin.menuProducts.index');
    }

    public function create()
    {
        abort_if(Gate::denies('menu_product_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $menu_categories = MenuCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $menu_clients = MenuClient::pluck('facebook', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.menuProducts.create', compact('menu_categories', 'menu_clients'));
    }

    public function store(StoreMenuProductRequest $request)
    {
        $menuProduct = MenuProduct::create($request->all());

        return redirect()->route('admin.menu-products.index');
    }

    public function edit(MenuProduct $menuProduct)
    {
        abort_if(Gate::denies('menu_product_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $menu_categories = MenuCategory::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $menu_clients = MenuClient::pluck('facebook', 'id')->prepend(trans('global.pleaseSelect'), '');

        $menuProduct->load('menu_category', 'menu_client');

        return view('admin.menuProducts.edit', compact('menuProduct', 'menu_categories', 'menu_clients'));
    }

    public function update(UpdateMenuProductRequest $request, MenuProduct $menuProduct)
    {
        $menuProduct->update($request->all());

        return redirect()->route('admin.menu-products.index');
    }

    public function show(MenuProduct $menuProduct)
    {
        abort_if(Gate::denies('menu_product_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $menuProduct->load('menu_category', 'menu_client');

        return view('admin.menuProducts.show', compact('menuProduct'));
    }

    public function destroy(MenuProduct $menuProduct)
    {
        abort_if(Gate::denies('menu_product_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $menuProduct->delete();

        return back();
    }

    public function massDestroy(MassDestroyMenuProductRequest $request)
    {
        $menuProducts = MenuProduct::find(request('ids'));

        foreach ($menuProducts as $menuProduct) {
            $menuProduct->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
