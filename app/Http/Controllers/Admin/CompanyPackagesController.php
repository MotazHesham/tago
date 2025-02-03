<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\MassDestroyCompanyPackageRequest;
use App\Http\Requests\StoreCompanyPackageRequest;
use App\Http\Requests\UpdateCompanyPackageRequest;
use App\Models\Company;
use App\Models\CompanyPackage;
use Gate;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Yajra\DataTables\Facades\DataTables;

class CompanyPackagesController extends Controller
{
    public function index(Request $request)
    {
        abort_if(Gate::denies('company_package_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        if ($request->ajax()) {
            $query = CompanyPackage::with(['company'])->select(sprintf('%s.*', (new CompanyPackage)->table));
            $table = Datatables::of($query);

            $table->addColumn('placeholder', '&nbsp;');
            $table->addColumn('actions', '&nbsp;');

            $table->editColumn('actions', function ($row) {
                $viewGate      = 'company_package_show';
                $editGate      = 'company_package_edit';
                $deleteGate    = 'company_package_delete';
                $crudRoutePart = 'company-packages';

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
            $table->addColumn('company_company_name', function ($row) {
                return $row->company ? $row->company->company_name : '';
            });

            $table->editColumn('price', function ($row) {
                return $row->price ? $row->price : '';
            });

            $table->editColumn('num_of_users', function ($row) {
                return $row->num_of_users ? $row->num_of_users : '';
            });

            $table->rawColumns(['actions', 'placeholder', 'company']);

            return $table->make(true);
        }

        return view('admin.companyPackages.index');
    }

    public function create()
    {
        abort_if(Gate::denies('company_package_create'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companies = Company::pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        return view('admin.companyPackages.create', compact('companies'));
    }

    public function store(StoreCompanyPackageRequest $request)
    {
        $companyPackage = CompanyPackage::create($request->all());

        return redirect()->route('admin.company-packages.index');
    }

    public function edit(CompanyPackage $companyPackage)
    {
        abort_if(Gate::denies('company_package_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companies = Company::pluck('company_name', 'id')->prepend(trans('global.pleaseSelect'), '');

        $companyPackage->load('company');

        return view('admin.companyPackages.edit', compact('companies', 'companyPackage'));
    }

    public function update(UpdateCompanyPackageRequest $request, CompanyPackage $companyPackage)
    {
        $companyPackage->update($request->all());

        return redirect()->route('admin.company-packages.index');
    }

    public function show(CompanyPackage $companyPackage)
    {
        abort_if(Gate::denies('company_package_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companyPackage->load('company');

        return view('admin.companyPackages.show', compact('companyPackage'));
    }

    public function destroy(CompanyPackage $companyPackage)
    {
        abort_if(Gate::denies('company_package_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $companyPackage->delete();

        return back();
    }

    public function massDestroy(MassDestroyCompanyPackageRequest $request)
    {
        $companyPackages = CompanyPackage::find(request('ids'));

        foreach ($companyPackages as $companyPackage) {
            $companyPackage->delete();
        }

        return response(null, Response::HTTP_NO_CONTENT);
    }
}
