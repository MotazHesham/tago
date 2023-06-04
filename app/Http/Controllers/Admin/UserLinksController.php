<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyUserLinkRequest;
use App\Http\Requests\StoreUserLinkRequest;
use App\Http\Requests\UpdateUserLinkRequest;
use App\Models\MainLink;
use App\Models\User;
use App\Models\UserLink;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class UserLinksController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('user_link_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = UserLink::with(['user', 'main_link'])->select(sprintf('%s.*', (new UserLink)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'user_link_show';
                $editGate      = 'user_link_edit';
                $deleteGate    = 'user_link_delete';
                $crudRoutePart = 'user-links';

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

            $table->addColumn('main_link_name', function ($row) {
                return $row->main_link ? $row->main_link->name : '';
            });

            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('link', function ($row) {
                return $row->link ? $row->link : '';
            });
            $table->editColumn('active', function ($row) {
                return '<input type="checkbox" disabled ' . ($row->active ? 'checked' : null) . '>';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'main_link', 'active']);

            return $table->make(true);
        }

        return view('admin.userLinks.index');
    }

    public function create()
    {
        abort_if(Gate::denies('user_link_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $main_links = MainLink::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.userLinks.create', compact('main_links', 'users'));
    }

    public function store(StoreUserLinkRequest $request)
    {
        $userLink = UserLink::create($request->all());

        if ($request->input('photo', false)) {
            $userLink->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $userLink->id]);
        }

        return redirect()->route('admin.user-links.index');
    }

    public function edit(UserLink $userLink)
    {
        abort_if(Gate::denies('user_link_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $main_links = MainLink::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $userLink->load('user', 'main_link');

        return view('admin.userLinks.edit', compact('main_links', 'userLink', 'users'));
    }

    public function update(UpdateUserLinkRequest $request, UserLink $userLink)
    {
        $userLink->update($request->all());

        if ($request->input('photo', false)) {
            if (! $userLink->photo || $request->input('photo') !== $userLink->photo->file_name) {
                if ($userLink->photo) {
                    $userLink->photo->delete();
                }
                $userLink->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($userLink->photo) {
            $userLink->photo->delete();
        }

        return redirect()->route('admin.user-links.index');
    }

    public function show(UserLink $userLink)
    {
        abort_if(Gate::denies('user_link_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userLink->load('user', 'main_link');

        return view('admin.userLinks.show', compact('userLink'));
    }

    public function destroy(UserLink $userLink)
    {
        abort_if(Gate::denies('user_link_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userLink->delete();

        return back();
    }

    public function massDestroy(MassDestroyUserLinkRequest $request)
    {
        $userLinks = UserLink::find(request('ids'));

        foreach ($userLinks as $userLink) {
            $userLink->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('user_link_create') && Gate::denies('user_link_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new UserLink();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
