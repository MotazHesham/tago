@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.connection.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.connections.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.connection.fields.id') }}
                        </th>
                        <td>
                            {{ $connection->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.connection.fields.user') }}
                        </th>
                        <td>
                            {{ $connection->user->name ?? '' }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.connection.fields.name') }}
                        </th>
                        <td>
                            {{ $connection->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.connection.fields.email') }}
                        </th>
                        <td>
                            {{ $connection->email }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.connection.fields.title') }}
                        </th>
                        <td>
                            {{ $connection->title }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.connection.fields.message') }}
                        </th>
                        <td>
                            {{ $connection->message }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.connection.fields.phone_number') }}
                        </th>
                        <td>
                            {{ $connection->phone_number }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.connection.fields.photo') }}
                        </th>
                        <td>
                            @if($connection->photo)
                                <a href="{{ $connection->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $connection->photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.connection.fields.link') }}
                        </th>
                        <td>
                            {{ $connection->link }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.connections.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection