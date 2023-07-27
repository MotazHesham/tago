<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMenuClientRequest;
use App\Http\Requests\StoreMenuClientRequest;
use App\Http\Requests\UpdateMenuClientRequest;
use App\Models\MenuClient;
use App\Models\MenuPackage;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MenuClientsController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('menu_client_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = MenuClient::with(['user'])->select(sprintf('%s.*', (new MenuClient)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'menu_client_show';
                $editGate      = 'menu_client_edit';
                $deleteGate    = 'menu_client_delete';
                $crudRoutePart = 'menu-clients';

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
            $table->addColumn('user_name', function ($row) {
                return $row->user ? $row->user->name : '';
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

            $table->rawColumns(['actions', 'placeholder', 'user', 'logo']);

            return $table->make(true);
        }

        return view('admin.menuClients.index');
    }

    public function create()
    {
        abort_if(Gate::denies('menu_client_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.menuClients.create', compact('users'));
    }

    public function store(StoreMenuClientRequest $request)
    {
        $user = User::create([
            'name' => $request->name,
            'email' => $request->email,
            'phone_number' => $request->phone_number, 
            'password' => bcrypt($request->password),
            'user_type' => 'client_menu',  
        ]);

        $menuClient = MenuClient::create([
            'user_id' => $user->id,
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
            $menuClient->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $menuClient->id]);
        }

        return redirect()->route('admin.menu-clients.index');
    }

    public function edit(MenuClient $menuClient)
    {
        abort_if(Gate::denies('menu_client_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $menuClient->load('user');

        return view('admin.menuClients.edit', compact('menuClient', 'users'));
    }

    public function update(UpdateMenuClientRequest $request, MenuClient $menuClient)
    {
        $user = User::find($menuClient->user_id);
        
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

        return redirect()->route('admin.menu-clients.index');
    }

    public function show(MenuClient $menuClient)
    {
        abort_if(Gate::denies('menu_client_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $menuClient->load('user', 'packages.menu_package', 'categories', 'menus.menu_client.user','menus.menu_theme');

        $menu_packages = MenuPackage::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.menuClients.show', compact('menuClient','menu_packages'));
    }

    public function destroy(MenuClient $menuClient)
    {
        abort_if(Gate::denies('menu_client_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $menuClient->delete();

        return back();
    }

    public function massDestroy(MassDestroyMenuClientRequest $request)
    {
        $menuClients = MenuClient::find(request('ids'));

        foreach ($menuClients as $menuClient) {
            $menuClient->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('menu_client_create') && Gate::denies('menu_client_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new MenuClient();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
