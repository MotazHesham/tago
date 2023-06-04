<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreMainLinkRequest;
use App\Http\Requests\UpdateMainLinkRequest;
use App\Http\Resources\Admin\MainLinkResource;
use App\Models\MainLink;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class MainLinksApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('main_link_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MainLinkResource(MainLink::with(['category'])->get());
    }

    public function store(StoreMainLinkRequest $request)
    {
        $mainLink = MainLink::create($request->all());

        if ($request->input('photo', false)) {
            $mainLink->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        return (new MainLinkResource($mainLink))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(MainLink $mainLink)
    {
        abort_if(Gate::denies('main_link_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new MainLinkResource($mainLink->load(['category']));
    }

    public function update(UpdateMainLinkRequest $request, MainLink $mainLink)
    {
        $mainLink->update($request->all());

        if ($request->input('photo', false)) {
            if (! $mainLink->photo || $request->input('photo') !== $mainLink->photo->file_name) {
                if ($mainLink->photo) {
                    $mainLink->photo->delete();
                }
                $mainLink->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($mainLink->photo) {
            $mainLink->photo->delete();
        }

        return (new MainLinkResource($mainLink))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(MainLink $mainLink)
    {
        abort_if(Gate::denies('main_link_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mainLink->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
