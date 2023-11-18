@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.mainLink.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.main-links.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.mainLink.fields.id') }}
                        </th>
                        <td>
                            {{ $mainLink->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mainLink.fields.name') }}
                        </th>
                        <td>
                            {{ $mainLink->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mainLink.fields.base_url') }}
                        </th>
                        <td>
                            {{ $mainLink->base_url }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mainLink.fields.photo') }}
                        </th>
                        <td>
                            @if($mainLink->photo)
                                <a href="{{ $mainLink->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $mainLink->photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.mainLink.fields.category') }}
                        </th>
                        <td>
                            {{ $mainLink->category->category ?? '' }}
                        </td>
                    </tr>
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.main-links.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection