@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('global.show') }} {{ trans('cruds.template.title') }}
    </div>

    <div class="card-body">
        <div class="form-group">
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.templates.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
            <table class="table table-bordered table-striped">
                <tbody>
                    <tr>
                        <th>
                            {{ trans('cruds.template.fields.id') }}
                        </th>
                        <td>
                            {{ $template->id }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.template.fields.name') }}
                        </th>
                        <td>
                            {{ $template->name }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.template.fields.price') }}
                        </th>
                        <td>
                            {{ $template->price }}
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.template.fields.photo') }}
                        </th>
                        <td>
                            @if($template->photo)
                                <a href="{{ $template->photo->getUrl() }}" target="_blank" style="display: inline-block">
                                    <img src="{{ $template->photo->getUrl('thumb') }}">
                                </a>
                            @endif
                        </td>
                    </tr>
                    <tr>
                        <th>
                            {{ trans('cruds.template.fields.canvas_pages') }}
                        </th>
                        <td>
                            <div id="elem"></div>
                        </td>
                    </tr> 
                </tbody>
            </table>
            <div class="form-group">
                <a class="btn btn-default" href="{{ route('admin.templates.index') }}">
                    {{ trans('global.back_to_list') }}
                </a>
            </div>
        </div>
    </div>
</div>



@endsection

@section('scripts')
    @parent 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/backbone.js/1.1.2/backbone-min.js" integrity="sha512-2SP4LOvXWb74RKyIt9jRRFJ05nfXFYFsWabK1/pJFOPx3NsJ2GQ0K8t9oJQ929v22XhlqrrHb7gM0xTjGLHVOg==" crossorigin="anonymous" referrerpolicy="no-referrer"></script> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/underscore.js/1.7.0/underscore-min.js" integrity="sha512-q2FrCBRlUS5RBd9KoXK7s0S9gANneESF0+HZWgKKWMI45eW4FL/BtNA5T94wYK8PdP7wOCcvnS0mtAqb5P4KXA==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
    <script src="https://warfares.github.io/pretty-json/pretty-json-min.js"></script>
    <script>
        var obj = {{ Js::from(json_decode($template->canvas_pages)) }}

        var node = new PrettyJSON.view.Node({
            el:$('#elem'),
            data:obj
        });
    </script>
@endsection