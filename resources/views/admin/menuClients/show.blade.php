@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                {{ trans('global.show') }} {{ trans('cruds.menuClient.title') }}
            </div>

            <div class="card-body">
                <div class="form-group">
                    <div class="form-group">
                        <a class="btn btn-default" href="{{ route('admin.menu-clients.index') }}">
                            {{ trans('global.back_to_list') }}
                        </a>
                    </div>
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th>
                                    {{ trans('cruds.menuClient.fields.id') }}
                                </th>
                                <td>
                                    {{ $menuClient->id }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.name') }}
                                </th>
                                <td>
                                    {{ $menuClient->user ? $menuClient->user->name : '' }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.email') }}
                                </th>
                                <td>
                                    {{ $menuClient->user ? $menuClient->user->email : '' }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.phone_number') }}
                                </th>
                                <td>
                                    {{ $menuClient->user ? $menuClient->user->phone_number : '' }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.menuClient.fields.logo') }}
                                </th>
                                <td>
                                    @if($menuClient->logo)
                                        <a href="{{ $menuClient->logo->getUrl() }}" target="_blank" style="display: inline-block">
                                            <img src="{{ $menuClient->logo->getUrl('thumb') }}">
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.menuClient.fields.about_us') }}
                                </th>
                                <td>
                                    {!! $menuClient->about_us !!}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.menuClient.fields.facebook') }}
                                </th>
                                <td>
                                    {{ $menuClient->facebook }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.menuClient.fields.twitter') }}
                                </th>
                                <td>
                                    {{ $menuClient->twitter }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.menuClient.fields.google') }}
                                </th>
                                <td>
                                    {{ $menuClient->google }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.menuClient.fields.linkedin') }}
                                </th>
                                <td>
                                    {{ $menuClient->linkedin }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.menuClient.fields.tiktok') }}
                                </th>
                                <td>
                                    {{ $menuClient->tiktok }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.menuClient.fields.youtube') }}
                                </th>
                                <td>
                                    {{ $menuClient->youtube }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.menuClient.fields.instagram') }}
                                </th>
                                <td>
                                    {{ $menuClient->instagram }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.menuClient.fields.whatsapp') }}
                                </th>
                                <td>
                                    {{ $menuClient->whatsapp }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="form-group">
                        <a class="btn btn-default" href="{{ route('admin.menu-clients.index') }}">
                            {{ trans('global.back_to_list') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card" style="background: #ffffff7a">
            <div class="card-header">
                {{ trans('global.relatedData') }}
            </div>
            <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#menu_client_menu_client_packages" role="tab" data-toggle="tab">
                        {{ trans('cruds.menuClientPackage.title') }}
                    </a>
                </li>
                {{-- <li class="nav-item">
                    <a class="nav-link" href="#menu_client_menu_categories" role="tab" data-toggle="tab">
                        {{ trans('cruds.menuCategory.title') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#menu_client_menu_products" role="tab" data-toggle="tab">
                        {{ trans('cruds.menuProduct.title') }}
                    </a>
                </li> --}}
                <li class="nav-item">
                    <a class="nav-link" href="#menu_client_menu_client_lists" role="tab" data-toggle="tab">
                        {{ trans('cruds.menuClientList.title') }}
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" role="tabpanel" id="menu_client_menu_client_packages" style="padding:10px">
                    @includeIf('admin.menuClients.relationships.packages', ['packages' => $menuClient->packages])
                </div>
                {{-- <div class="tab-pane" role="tabpanel" id="menu_client_menu_categories">
                    @includeIf('admin.menuClients.relationships.menuClientMenuCategories', ['menuCategories' => $menuClient->menuClientMenuCategories])
                </div>
                <div class="tab-pane" role="tabpanel" id="menu_client_menu_products">
                    @includeIf('admin.menuClients.relationships.menuClientMenuProducts', ['menuProducts' => $menuClient->menuClientMenuProducts])
                </div> --}}
                <div class="tab-pane" role="tabpanel" id="menu_client_menu_client_lists">
                    @includeIf('admin.menuClients.relationships.menus', ['menus' => $menuClient->menus])
                </div>
            </div>
        </div>  
    </div>
</div>
@endsection