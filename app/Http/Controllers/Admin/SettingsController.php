<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroySettingRequest;
use App\Http\Requests\StoreSettingRequest;
use App\Http\Requests\UpdateSettingRequest;
use App\Models\Setting;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;

class SettingsController extends Controller
{
    use MediaUploadingTrait;

    public function shapes($id){
        $setting = Setting::findOrFail($id);
        return view('admin.settings.shapes', compact('setting'));
    }
    public function shape_delete($id){
        $media = Media::findOrFail($id);
        $media->delete();
        return redirect()->back();
    }

    public function index()
    {
        abort_if(Gate::denies('setting_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $settings = Setting::with(['media'])->get();

        return view('admin.settings.index', compact('settings'));
    }

    public function create()
    {
        abort_if(Gate::denies('setting_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.settings.create');
    }

    public function store(StoreSettingRequest $request)
    {
        $validated_request = $request->all(); 
        $validated_request['keywords_seo'] = implode('|',$request->keywords_seo);  
        $setting = Setting::create($validated_request); 
        foreach ($request->input('shapes', []) as $file) {
            $setting->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('shapes');
        }

        if ($request->input('logo', false)) {
            $setting->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $setting->id]);
        }

        return redirect()->route('admin.settings.index');
    }

    public function edit(Setting $setting)
    {
        abort_if(Gate::denies('setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.settings.edit', compact('setting'));
    }

    public function update(UpdateSettingRequest $request, Setting $setting)
    {
        $validated_request = $request->all(); 
        if($request->has('keywords_seo')){
            $validated_request['keywords_seo'] = implode('|',$request->keywords_seo);  
        }
        $setting->update($validated_request);

        if (count($setting->supporters) > 0) {
            foreach ($setting->supporters as $media) {
                if (! in_array($media->file_name, $request->input('supporters', []))) {
                    $media->delete();
                }
            }
        }
        $media = $setting->supporters->pluck('file_name')->toArray();
        foreach ($request->input('supporters', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $setting->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('supporters');
            }
        }

        $media = $setting->shapes->pluck('file_name')->toArray();
        foreach ($request->input('shapes', []) as $file) {
            if (count($media) === 0 || ! in_array($file, $media)) {
                $setting->addMedia(storage_path('tmp/uploads/' . basename($file)))->toMediaCollection('shapes');
            }
        }
        
        if ($request->input('logo', false)) {
            if (! $setting->logo || $request->input('logo') !== $setting->logo->file_name) {
                if ($setting->logo) {
                    $setting->logo->delete();
                }
                $setting->addMedia(storage_path('tmp/uploads/' . basename($request->input('logo'))))->toMediaCollection('logo');
            }
        } elseif ($setting->logo) {
            $setting->logo->delete();
        }

        return redirect()->route('admin.settings.index');
    }

    public function show(Setting $setting)
    {
        abort_if(Gate::denies('setting_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.settings.show', compact('setting'));
    }

    public function destroy(Setting $setting)
    {
        abort_if(Gate::denies('setting_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $setting->delete();

        return back();
    }

    public function massDestroy(MassDestroySettingRequest $request)
    {
        $settings = Setting::find(request('ids'));

        foreach ($settings as $setting) {
            $setting->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }

    public function storeCKEditorImages(Request $request)
    {
        abort_if(Gate::denies('setting_create') && Gate::denies('setting_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $model         = new Setting();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
