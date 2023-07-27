@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.menuProduct.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.menu-products.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.menuProduct.fields.id') }}
                        </th>
                        <td>
                            {{ $menuProduct->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.menuProduct.fields.name') }}
                        </th>
                        <td>
                            {{ $menuProduct->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.menuProduct.fields.price') }}
                        </th>
                        <td>
                            {{ $menuProduct->price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.menuProduct.fields.menu_category') }}
                        </th>
                        <td>
                            {{ $menuProduct->menu_category->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.menuProduct.fields.menu_client') }}
                        </th>
                        <td>
                            {{ $menuProduct->menu_client->facebook ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.menu-products.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection