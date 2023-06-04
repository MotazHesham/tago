@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.userLink.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.user-links.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.userLink.fields.id') }}
                        </th>
                        <td>
                            {{ $userLink->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userLink.fields.user') }}
                        </th>
                        <td>
                            {{ $userLink->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userLink.fields.main_link') }}
                        </th>
                        <td>
                            {{ $userLink->main_link->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userLink.fields.name') }}
                        </th>
                        <td>
                            {{ $userLink->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userLink.fields.link') }}
                        </th>
                        <td>
                            {{ $userLink->link }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userLink.fields.photo') }}
                        </th>
                        <td>
                            @if($userLink->photo)
                                <a href="{{ $userLink->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $userLink->photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.userLink.fields.active') }}
                        </th>
                        <td>
                            <input type="checkbox" disabled="disabled" {{ $userLink->active ? 'checked' : '' }}>
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.user-links.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection