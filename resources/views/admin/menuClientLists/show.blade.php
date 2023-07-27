@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.menuClientList.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.menu-client-lists.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.menuClientList.fields.id') }}
                        </th>
                        <td>
                            {{ $menuClientList->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.menuClientList.fields.menu_client_package') }}
                        </th>
                        <td>
                            {{ $menuClientList->menu_client_package->start_at ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.menuClientList.fields.logo') }}
                        </th>
                        <td>
                            @if($menuClientList->logo)
                                <a href="{{ $menuClientList->logo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $menuClientList->logo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.menuClientList.fields.about_us') }}
                        </th>
                        <td>
                            {!! $menuClientList->about_us !!}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.menuClientList.fields.facebook') }}
                        </th>
                        <td>
                            {{ $menuClientList->facebook }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.menuClientList.fields.twitter') }}
                        </th>
                        <td>
                            {{ $menuClientList->twitter }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.menuClientList.fields.google') }}
                        </th>
                        <td>
                            {{ $menuClientList->google }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.menuClientList.fields.linkedin') }}
                        </th>
                        <td>
                            {{ $menuClientList->linkedin }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.menuClientList.fields.tiktok') }}
                        </th>
                        <td>
                            {{ $menuClientList->tiktok }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.menuClientList.fields.youtube') }}
                        </th>
                        <td>
                            {{ $menuClientList->youtube }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.menuClientList.fields.instagram') }}
                        </th>
                        <td>
                            {{ $menuClientList->instagram }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.menuClientList.fields.whatsapp') }}
                        </th>
                        <td>
                            {{ $menuClientList->whatsapp }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.menuClientList.fields.menu_client') }}
                        </th>
                        <td>
                            {{ $menuClientList->menu_client->facebook ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.menu-client-lists.index') }}">
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
            <a class="nav-link" href="#menu_client_list_menu_categories" role="tab" data-toggle="tab">
                {{ trans('cruds.menuCategory.title') }}
            </a>
        </li>
    </ul>
    <div class="tab-content">
        <div class="tab-pane" role="tabpanel" id="menu_client_list_menu_categories">
            @includeIf('admin.menuClientLists.relationships.menuClientListMenuCategories', ['menuCategories' => $menuClientList->menuClientListMenuCategories])
        </div>
    </div>
</div>

@endsection