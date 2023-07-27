@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.menuClientPackage.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.menu-client-packages.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.menuClientPackage.fields.id') }}
                        </th>
                        <td>
                            {{ $menuClientPackage->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.menuClientPackage.fields.menu_client') }}
                        </th>
                        <td>
                            {{ $menuClientPackage->menu_client->facebook ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.menuClientPackage.fields.menu_package') }}
                        </th>
                        <td>
                            {{ $menuClientPackage->menu_package->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.menuClientPackage.fields.start_at') }}
                        </th>
                        <td>
                            {{ $menuClientPackage->start_at }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.menuClientPackage.fields.end_at') }}
                        </th>
                        <td>
                            {{ $menuClientPackage->end_at }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.menu-client-packages.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection