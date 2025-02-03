@extends('layouts.admin')
@section('content')

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                {{ trans('global.show') }} {{ trans('cruds.user.title') }}
            </div>
        
            <div class="card-body">
                <div class="form-group">
                    <div class="form-group">
                        <a class="btn btn-default" href="{{ route('admin.users.index') }}">
                            {{ trans('global.back_to_list') }}
                        </a>
                    </div>
                    <table class="table table-bordered table-striped">
                        <tbody>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.id') }}
                                </th>
                                <td>
                                    {{ $user->id }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.name') }}
                                </th>
                                <td>
                                    {{ $user->name }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.email') }}
                                </th>
                                <td>
                                    {{ $user->email }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.phone_number') }}
                                </th>
                                <td>
                                    {{ $user->phone_number }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.email_verified_at') }}
                                </th>
                                <td>
                                    {{ $user->email_verified_at }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.roles') }}
                                </th>
                                <td>
                                    @foreach($user->roles as $key => $roles)
                                        <span class="label label-info">{{ $roles->title }}</span>
                                    @endforeach
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.nickname') }}
                                </th>
                                <td>
                                    {{ $user->nickname }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.bio') }}
                                </th>
                                <td>
                                    {{ $user->bio }}
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.email_active') }}
                                </th>
                                <td>
                                    <input type="checkbox" disabled="disabled" {{ $user->email_active ? 'checked' : '' }}>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.nickname_active') }}
                                </th>
                                <td>
                                    <input type="checkbox" disabled="disabled" {{ $user->nickname_active ? 'checked' : '' }}>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.bio_active') }}
                                </th>
                                <td>
                                    <input type="checkbox" disabled="disabled" {{ $user->bio_active ? 'checked' : '' }}>
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.photo') }}
                                </th>
                                <td>
                                    @if($user->photo)
                                        <a href="{{ $user->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                            <img src="{{ $user->photo->getUrl('thumb') }}">
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.cover') }}
                                </th>
                                <td>
                                    @if($user->cover)
                                        <a href="{{ $user->cover->getUrl() }}" target="_blank" style="display: inline-block">
                                            <img src="{{ $user->cover->getUrl('thumb') }}">
                                        </a>
                                    @endif
                                </td>
                            </tr>
                            <tr>
                                <th>
                                    {{ trans('cruds.user.fields.company') }}
                                </th>
                                <td>
                                    {{ $user->company->company_name ?? '' }}
                                </td>
                            </tr>
                        </tbody>
                    </table>
                    <div class="form-group">
                        <a class="btn btn-default" href="{{ route('admin.users.index') }}">
                            {{ trans('global.back_to_list') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-8">
        <div class="card">
            <div class="card-header">
                {{ trans('global.relatedData') }}
            </div>
            <ul class="nav nav-tabs" role="tablist" id="relationship-tabs">
                <li class="nav-item">
                    <a class="nav-link active" href="#user_user_links" role="tab" data-toggle="tab">
                        {{ trans('cruds.userLink.title') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#user_connections" role="tab" data-toggle="tab">
                        {{ trans('cruds.connection.title') }}
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="#user_user_alerts" role="tab" data-toggle="tab">
                        {{ trans('cruds.userAlert.title') }}
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" role="tabpanel" id="user_user_links">
                    @includeIf('admin.customers.relationships.userUserLinks', ['userLinks' => $user->userUserLinks])
                </div>
                <div class="tab-pane" role="tabpanel" id="user_connections">
                    @includeIf('admin.customers.relationships.userConnections', ['connections' => $user->userConnections])
                </div>
                <div class="tab-pane" role="tabpanel" id="user_user_alerts">
                    @includeIf('admin.customers.relationships.userUserAlerts', ['userAlerts' => $user->userUserAlerts])
                </div>
            </div>
        </div>
    </div>
</div>


@endsection