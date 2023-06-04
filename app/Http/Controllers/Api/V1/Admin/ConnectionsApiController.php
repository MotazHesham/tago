<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreConnectionRequest;
use App\Http\Requests\UpdateConnectionRequest;
use App\Http\Resources\Admin\ConnectionResource;
use App\Models\Connection;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class ConnectionsApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('connection_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ConnectionResource(Connection::with(['user'])->get());
    }

    public function store(StoreConnectionRequest $request)
    {
        $connection = Connection::create($request->all());

        if ($request->input('photo', false)) {
            $connection->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        return (new ConnectionResource($connection))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(Connection $connection)
    {
        abort_if(Gate::denies('connection_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new ConnectionResource($connection->load(['user']));
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

        return (new ConnectionResource($connection))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(Connection $connection)
    {
        abort_if(Gate::denies('connection_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $connection->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
