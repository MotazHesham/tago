<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyConnectionRequest;
use App\Http\Requests\StoreConnectionRequest;
use App\Http\Requests\UpdateConnectionRequest;
use App\Models\Connection;
use App\Models\User;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class ConnectionsController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('connection_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = Connection::with(['user'])->select(sprintf('%s.*', (new Connection)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'connection_show';
                $editGate      = 'connection_edit';
                $deleteGate    = 'connection_delete';
                $crudRoutePart = 'connections';

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

            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });
            $table->editColumn('title', function ($row) {
                return $row->title ? $row->title : '';
            });
            $table->editColumn('phone_number', function ($row) {
                return $row->phone_number ? $row->phone_number : '';
            });
            $table->editColumn('photo', function ($row) {
                if ($photo = $row->photo) {
                    return sprintf(
                        '<a href="%s" target="_blank"><img src="%s" width="50px" height="50px"></a>',
                        $photo->url,
                        $photo->thumbnail
                    );
                }

                return '';
            });
            $table->editColumn('link', function ($row) {
                return $row->link ? $row->link : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'user', 'photo']);

            return $table->make(true);
        }

        return view('admin.connections.index');
    }

    public function create()
    {
        abort_if(Gate::denies('connection_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.connections.create', compact('users'));
    }

    public function store(StoreConnectionRequest $request)
    {
        $connection = Connection::create($request->all());

        if ($request->input('photo', false)) {
            $connection->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $connection->id]);
        }

        return redirect()->route('admin.connections.index');
    }

    public function edit(Connection $connection)
    {
        abort_if(Gate::denies('connection_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $connection->load('user');

        return view('admin.connections.edit', compact('connection', 'users'));
    }

    public function update(UpdateConnectionRequest $request, Connection $connection)
    {
        $connection->update($request->all());

        if ($request->input('photo', false)) {
            if (! $connection->photo || $request->input('photo') !== $connection->photo->file_name) {
                if ($connection->photo) {
                    $connection->photo->delete();
                }
                $connection->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($connection->photo) {
            $connection->photo->delete();
        }

        return redirect()->route('admin.connections.index');
    }

    public function show(Connection $connection)
    {
        abort_if(Gate::denies('connection_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $connection->load('user');

        return view('admin.connections.show', compact('connection'));
    }

    public function destroy(Connection $connection)
    {
        abort_if(Gate::denies('connection_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $connection->delete();

        return back();
    }

    public function massDestroy(MassDestroyConnectionRequest $request)
    {
        $connections = Connection::find(request('ids'));

        foreach ($connections as $connection) {
            $connection->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('connection_create') && Gate::denies('connection_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Connection();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
