<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyLinkCategoryRequest;
use App\Http\Requests\StoreLinkCategoryRequest;
use App\Http\Requests\UpdateLinkCategoryRequest;
use App\Models\LinkCategory;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class LinkCategoryController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('link_category_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $linkCategories = LinkCategory::all();

        return view('admin.linkCategories.index', compact('linkCategories'));
    }

    public function create()
    {
        abort_if(Gate::denies('link_category_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.linkCategories.create');
    }

    public function store(StoreLinkCategoryRequest $request)
    {
        $linkCategory = LinkCategory::create($request->all());

        return redirect()->route('admin.link-categories.index');
    }

    public function edit(LinkCategory $linkCategory)
    {
        abort_if(Gate::denies('link_category_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.linkCategories.edit', compact('linkCategory'));
    }

    public function update(UpdateLinkCategoryRequest $request, LinkCategory $linkCategory)
    {
        $linkCategory->update($request->all());

        return redirect()->route('admin.link-categories.index');
    }

    public function show(LinkCategory $linkCategory)
    {
        abort_if(Gate::denies('link_category_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.linkCategories.show', compact('linkCategory'));
    }

    public function destroy(LinkCategory $linkCategory)
    {
        abort_if(Gate::denies('link_category_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $linkCategory->delete();

        return back();
    }

    public function massDestroy(MassDestroyLinkCategoryRequest $request)
    {
        $linkCategories = LinkCategory::find(request('ids'));

        foreach ($linkCategories as $linkCategory) {
            $linkCategory->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
