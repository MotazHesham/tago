@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.menuCategory.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.menu-categories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.menuCategory.fields.id') }}
                        </th>
                        <td>
                            {{ $menuCategory->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.menuCategory.fields.name') }}
                        </th>
                        <td>
                            {{ $menuCategory->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.menuCategory.fields.banner') }}
                        </th>
                        <td>
                            @if($menuCategory->banner)
                                <a href="{{ $menuCategory->banner->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $menuCategory->banner->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.menuCategory.fields.menu_client') }}
                        </th>
                        <td>
                            {{ $menuCategory->menu_client->facebook ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.menuCategory.fields.menu_client_list') }}
                        </th>
                        <td>
                            @foreach($menuCategory->menu_client_lists as $key => $menu_client_list)
                                <span class="label label-info">{{ $menu_client_list->facebook }}</span>
                            @endforeach
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.menu-categories.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>

<div class="card">
    <div class="card-header">
        {{ trans('global.relatedData') }}
    </div>
    <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
        <li class="nav-item">
            <a class="nav-link" href="#menu_category_menu_products" role="tab" data-toggle="tab">
                {{ trans('cruds.menuProduct.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="menu_category_menu_products">
            @includeIf('admin.menuCategories.relationships.menuCategoryMenuProducts', ['menuProducts' => $menuCategory->menuCategoryMenuProducts])
        </div>
    </div>
</div>

@endsection