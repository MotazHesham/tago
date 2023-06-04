<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyMainLinkRequest;
use App\Http\Requests\StoreMainLinkRequest;
use App\Http\Requests\UpdateMainLinkRequest;
use App\Models\LinkCategory;
use App\Models\MainLink;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class MainLinksController extends Controller
{
    use MediaUploadingTrait;

    public function index(Request $request)
    {
        abort_if(Gate::denies('main_link_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = MainLink::with(['category'])->select(sprintf('%s.*', (new MainLink)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'main_link_show';
                $editGate      = 'main_link_edit';
                $deleteGate    = 'main_link_delete';
                $crudRoutePart = 'main-links';

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
            $table->addColumn('category_category', function ($row) {
                return $row->category ? $row->category->category : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'photo', 'category']);

            return $table->make(true);
        }

        return view('admin.mainLinks.index');
    }

    public function create()
    {
        abort_if(Gate::denies('main_link_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = LinkCategory::pluck('category', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.mainLinks.create', compact('categories'));
    }

    public function store(StoreMainLinkRequest $request)
    {
        $mainLink = MainLink::create($request->all());

        if ($request->input('photo', false)) {
            $mainLink->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $mainLink->id]);
        }

        return redirect()->route('admin.main-links.index');
    }

    public function edit(MainLink $mainLink)
    {
        abort_if(Gate::denies('main_link_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $categories = LinkCategory::pluck('category', 'id')->prepend(trans('global.pleaseSelect'), '');

        $mainLink->load('category');

        return view('admin.mainLinks.edit', compact('categories', 'mainLink'));
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

        return redirect()->route('admin.main-links.index');
    }

    public function show(MainLink $mainLink)
    {
        abort_if(Gate::denies('main_link_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mainLink->load('category');

        return view('admin.mainLinks.show', compact('mainLink'));
    }

    public function destroy(MainLink $mainLink)
    {
        abort_if(Gate::denies('main_link_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $mainLink->delete();

        return back();
    }

    public function massDestroy(MassDestroyMainLinkRequest $request)
    {
        $mainLinks = MainLink::find(request('ids'));

        foreach ($mainLinks as $mainLink) {
            $mainLink->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('main_link_create') && Gate::denies('main_link_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new MainLink();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
