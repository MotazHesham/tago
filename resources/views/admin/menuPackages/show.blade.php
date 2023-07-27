@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.menuPackage.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.menu-packages.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.menuPackage.fields.id') }}
                        </th>
                        <td>
                            {{ $menuPackage->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.menuPackage.fields.name') }}
                        </th>
                        <td>
                            {{ $menuPackage->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.menuPackage.fields.descrption') }}
                        </th>
                        <td>
                            {!! $menuPackage->descrption !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.menuPackage.fields.price') }}
                        </th>
                        <td>
                            {{ $menuPackage->price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.menuPackage.fields.menus') }}
                        </th>
                        <td>
                            {{ $menuPackage->menus }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.menuPackage.fields.themes') }}
                        </th>
                        <td>
                            @foreach($menuPackage->themes as $key => $themes)
                                <span class="label label-info">{{ $themes->name }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.menu-packages.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection