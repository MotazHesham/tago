<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Http\Requests\MassDestroyUserRequest;
use App\Http\Requests\StoreUserRequest;
use App\Http\Requests\UpdateUserRequest;
use App\Models\Company;
use App\Models\MainLink;
use App\Models\OrderProduct;
use App\Models\Role;
use App\Models\User;
use App\Traits\api_return;
use Gate;
use Illuminate\Http\Request;
use Spatie\MediaLibrary\MediaCollections\Models\Media;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CustomersController extends Controller
{
    use MediaUploadingTrait;
    use api_return;

    public function qr_scanned(Request $request){
        $user = User::find($request->user_id); 
        
        $token = str_replace('https://my-tago.com/user/token/','',$request->token);

        $orderProduct = OrderProduct::where('token',$token)->first();
        
        if(!$orderProduct){
            return $this->returnError('401', 'كود غير صحيح');
        }

        if($request->token != '34s#h8N'){ // open this specific QrCode All Time
            if($orderProduct->scanned_user_id && $orderProduct->scanned_user_id != $user->id){
                return $this->returnError('500', 'تم استخدام الكود من قبل');
            }  
        }   

        $orderProduct->scanned_user_id = $user->id;
        $orderProduct->save();
        
        $user->active_byqr = 1;
        $user->save();
        return $this->returnSuccessMessage(trans('global.flash.api.success')); 
    }

    public function update_statuses(Request $request){ 
        $type = $request->type;
        $user = User::findOrFail($request->id);
        $user->$type = $request->status;
        $user->save();
        return 1;
    }
    public function index(Request $request)
    { 
        $company = auth()->user()->company_owner;
        if ($request->ajax()) {
            $query = User::with(['company'])->where('company_id',$company->id)->where('user_type','customer')->select(sprintf('%s.*', (new User)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $crudRoutePart = 'company.customers';

                return view('partials.datatablesActions_noauth', compact(
                    'crudRoutePart',
                    'row',
                ));
            });

            $table->editColumn('id', function ($row) {
                return $row->id ? $row->id : '';
            });
            $table->editColumn('name', function ($row) {
                return $row->name ? $row->name : '';
            });
            $table->editColumn('email', function ($row) {
                return $row->email ? $row->email : '';
            });

            $table->rawColumns(['actions', 'placeholder']);

            return $table->make(true);
        }

        return view('company.customers.index');
    }

    public function create()
    {   
        $company = auth()->user()->company_owner;

        return view('company.customers.create', compact('company'));
    }

    public function store(StoreUserRequest $request)
    {
        $package = currentCompanyPackage();
        if($package && $company = auth()->user()->company_owner){
            if($package->num_of_users <= User::where('company_id',$company->id)->count()){
                toast('You Reached The maximum num of Users to Add','error');
                return redirect()->route('company.customers.index');
            }
        }
        $user = User::create($request->all()); 
        if ($request->input('photo', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
        }

        if ($request->input('cover', false)) {
            $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('cover'))))->toMediaCollection('cover');
        }

        if ($media = $request->input('ck-media', false)) {
            Media::whereIn('id', $media)->update(['model_id' => $user->id]);
        }

        return redirect()->route('company.customers.index');
    }

    public function edit($id)
    {    
        $user = User::findOrFail($id);
        $user->load( 'company');

        return view('company.customers.edit', compact( 'user'));
    }

    public function update(UpdateUserRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $user->update($request->all());
        if ($request->input('photo', false)) {
            if (! $user->photo || $request->input('photo') !== $user->photo->file_name) {
                if ($user->photo) {
                    $user->photo->delete();
                }
                $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('photo'))))->toMediaCollection('photo');
            }
        } elseif ($user->photo) {
            $user->photo->delete();
        }

        if ($request->input('cover', false)) {
            if (! $user->cover || $request->input('cover') !== $user->cover->file_name) {
                if ($user->cover) {
                    $user->cover->delete();
                }
                $user->addMedia(storage_path('tmp/uploads/' . basename($request->input('cover'))))->toMediaCollection('cover');
            }
        } elseif ($user->cover) {
            $user->cover->delete();
        }

        return redirect()->route('company.customers.index');
    }

    public function show($id)
    { 
        $user = User::findOrFail($id);

        $main_links = MainLink::pluck('name', 'id')->prepend(trans('global.pleaseSelect'), '');
        
        $user->load( 'company', 'userUserLinks.main_link', 'userConnections');

        return view('company.customers.show', compact('user','main_links'));
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return back();
    }

    public function storeCKEditorImages(Request $request)
    {
        $model         = new User();
        $model->id     = $request->input('crud_id', 0);
        $model->exists = true;
        $media         = $model->addMediaFromRequest('upload')->toMediaCollection('ck-media');

        return response()->json(['id' => $media->id, 'url' => $media->getUrl()], Response::HTTP_CREATED);
    }
}
