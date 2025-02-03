<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyUserLinkRequest;
use App\Http\Requests\StoreUserLinkRequest;
use App\Http\Requests\UpdateUserLinkRequest;
use App\Jobs\PhotoUploadJob;
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

    public function edit_all_links(){
        $main_links = MainLink::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        return view('company.edit_all_links',compact('main_links'));
    }
    public function update_all(Request $request){
        $company = auth()->user()->company_owner;
        $users = User::where('company_id', $company->id)->get(); 
        $photoPath = null; 
        
        if ($request->input('photo')) {
            $photoPath = storage_path('tmp/uploads/' . basename($request->input('photo'))); 
        } 

        foreach ($users as $user) { 
            $userLink = UserLink::where('user_id',$user->id)->where('main_link_id',$request->main_link_id)->first();
            if(!$userLink){
                $userLink = new UserLink();
                $userLink->user_id = $user->id;
                $userLink->main_link_id = $request->main_link_id;
                $userLink->name = '';
                $userLink->link = '';
            }
            
            if($request->has('name') && $request->name != null){
                $userLink->name = $request->name;
            }
            if($request->has('link') && $request->link != null){
                $userLink->link = $request->link;
            }
            if($request->has('priority') && $request->priority != null){
                $userLink->priority = $request->priority;
            }
            if($request->has('active') && $request->active != null){
                $userLink->active = $request->active;
            }
            if ($photoPath) {
                PhotoUploadJob::dispatch($userLink,$photoPath);
            } 
            $userLink->save();
        } 
        toast('Links Updated Successfully','success');
        return redirect()->route('company.customers.index');
    }
    public function update_statuses(Request $request){ 
        $type = $request->type;
        $link = UserLink::findOrFail($request->id);
        $link->$type = $request->status;
        $link->save();
        return 1;
    }
    public function index(Request $request)
    { 

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

        return view('company.userLinks.index');
    }

    public function create()
    { 

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $main_links = MainLink::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('company.userLinks.create', compact('main_links', 'users'));
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

        return redirect()->route('company.customers.show',$userLink->user_id);
    }

    public function edit(UserLink $userLink)
    { 

        $users = User::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $main_links = MainLink::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $userLink->load('user', 'main_link');

        return view('company.userLinks.edit', compact('main_links', 'userLink', 'users'));
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

        return redirect()->route('company.customers.show',$userLink->user_id);
    }

    public function show(UserLink $userLink)
    { 

        $userLink->load('user', 'main_link');

        return view('company.userLinks.show', compact('userLink'));
    }

    public function destroy(UserLink $userLink)
    {  
        $userLink->delete();

        return back();
    }  
}
