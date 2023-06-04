<?php

namespace App\Http\Controllers\Api\V1\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\StoreUserLinkRequest;
use App\Http\Requests\UpdateUserLinkRequest;
use App\Http\Resources\Admin\UserLinkResource;
use App\Models\UserLink;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserLinksApiController extends Controller
{
    use MediaUploadingTrait;

    public function index()
    {
        abort_if(Gate::denies('user_link_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserLinkResource(UserLink::with(['user', 'main_link'])->get());
    }

    public function store(StoreUserLinkRequest $request)
    {
        $userLink = UserLink::create($request->all());

        if ($request->input('photo', false)) {
            $userLink->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        return (new UserLinkResource($userLink))
            ->response()
            ->setStatusCode(Response::HTTP_CREATED);
    }

    public function show(UserLink $userLink)
    {
        abort_if(Gate::denies('user_link_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return new UserLinkResource($userLink->load(['user', 'main_link']));
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

        return (new UserLinkResource($userLink))
            ->response()
            ->setStatusCode(Response::HTTP_ACCEPTED);
    }

    public function destroy(UserLink $userLink)
    {
        abort_if(Gate::denies('user_link_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $userLink->delete();

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
