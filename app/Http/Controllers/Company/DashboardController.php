<?php

namespace App\Http\Controllers\Company;

use App\Http\Controllers\Controller; 
use App\Http\Controllers\Traits\MediaUploadingTrait;
use App\Models\CompanyPackage;
use App\Models\User;
use Illuminate\Http\Request; 
use Symfony\Component\HttpFoundation\Response;

class DashboardController extends Controller
{
    use MediaUploadingTrait;  
    public function dashboard(){
        $company = auth()->user()->company_owner;
        $num_of_users = User::where('company_id',$company->id)->count();
        $package = currentCompanyPackage();
        return view('company.dashboard',compact('num_of_users','package'));
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
