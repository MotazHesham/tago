<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyTutorialRequest;
use App\Http\Requests\StoreTutorialRequest;
use App\Http\Requests\UpdateTutorialRequest;
use App\Models\Tutorial;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class TutorialsController extends Controller
{
    public function index()
    {
        abort_if(Gate::denies('tutorial_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tutorials = Tutorial::all();

        return view('admin.tutorials.index', compact('tutorials'));
    }

    public function create()
    {
        abort_if(Gate::denies('tutorial_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tutorials.create');
    }

    public function store(StoreTutorialRequest $request)
    {
        $tutorial = Tutorial::create($request->all());

        return redirect()->route('admin.tutorials.index');
    }

    public function edit(Tutorial $tutorial)
    {
        abort_if(Gate::denies('tutorial_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tutorials.edit', compact('tutorial'));
    }

    public function update(UpdateTutorialRequest $request, Tutorial $tutorial)
    {
        $tutorial->update($request->all());

        return redirect()->route('admin.tutorials.index');
    }

    public function show(Tutorial $tutorial)
    {
        abort_if(Gate::denies('tutorial_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('admin.tutorials.show', compact('tutorial'));
    }

    public function destroy(Tutorial $tutorial)
    {
        abort_if(Gate::denies('tutorial_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $tutorial->delete();

        return back();
    }

    public function massDestroy(MassDestroyTutorialRequest $request)
    {
        $tutorials = Tutorial::find(request('ids'));

        foreach ($tutorials as $tutorial) {
            $tutorial->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
