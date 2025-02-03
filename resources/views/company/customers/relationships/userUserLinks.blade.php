<div class="card">
    <div class="card-header">
        {{ trans('global.create') }} {{ trans('cruds.userLink.title_singular') }}
    </div>

    <div class="card-body">
        <form method="POST" action="{{ route('company.user-links.store') }}" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="user_id" value="{{ $user->id }}" id="">
            <input type="hidden" name="active" value="1" id="">
            <div class="row">
                <div class="form-group col-md-4">
                    <label class="required" for="main_link_id">{{ trans('cruds.userLink.fields.main_link') }}</label>
                    <select class="form-control select2 {{ $errors->has('main_link') ? 'is-invalid' : '' }}"
                        name="main_link_id" id="main_link_id" required>
                        @foreach ($main_links as $id => $entry)
                            <option value="{{ $id }}" {{ old('main_link_id') == $id ? 'selected' : '' }}>
                                {{ $entry }}</option>
                        @endforeach
                    </select>
                    @if ($errors->has('main_link'))
                        <div class="invalid-feedback">
                            {{ $errors->first('main_link') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.userLink.fields.main_link_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label class="required" for="name">{{ trans('cruds.userLink.fields.name') }}</label>
                    <input class="form-control {{ $errors->has('name') ? 'is-invalid' : '' }}" type="text"
                        name="name" id="name" value="{{ old('name', '') }}" required>
                    @if ($errors->has('name'))
                        <div class="invalid-feedback">
                            {{ $errors->first('name') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.userLink.fields.name_helper') }}</span>
                </div>
                <div class="form-group col-md-4">
                    <label class="required" for="link">{{ trans('cruds.userLink.fields.link') }}</label>
                    <input class="form-control {{ $errors->has('link') ? 'is-invalid' : '' }}" type="text"
                        name="link" id="link" value="{{ old('link', '') }}" required>
                    @if ($errors->has('link'))
                        <div class="invalid-feedback">
                            {{ $errors->first('link') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.userLink.fields.link_helper') }}</span>
                </div>
                <div class="form-group col-md-12">
                    <label for="photo">{{ trans('cruds.userLink.fields.photo') }}</label>
                    <div class="needsclick dropzone {{ $errors->has('photo') ? 'is-invalid' : '' }}"
                        id="photo-dropzone">
                    </div>
                    @if ($errors->has('photo'))
                        <div class="invalid-feedback">
                            {{ $errors->first('photo') }}
                        </div>
                    @endif
                    <span class="help-block">{{ trans('cruds.userLink.fields.photo_helper') }}</span>
                </div>
            </div>
            <div class="form-group">
                <button class="btn btn-danger" type="submit">
                    {{ trans('global.save') }}
                </button>
            </div>
        </form>
    </div>
</div>
<div class="card">
    <div class="card-header">

    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-userUserLinks">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.userLink.fields.id') }}
                        </th> 
                        <th>
                            {{ trans('cruds.userLink.fields.photo') }}
                        </th>
                        <th>
                            {{ trans('cruds.userLink.fields.main_link') }}
                        </th>
                        <th>
                            {{ trans('cruds.userLink.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.userLink.fields.link') }}
                        </th>
                        <th>
                            {{ trans('cruds.userLink.fields.active') }}
                        </th>
                        <th>
                            الترتيب
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($userLinks as $key => $userLink)
                        <tr data-entry-id="{{ $userLink->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $userLink->id ?? '' }}
                            </td> 
                            <td>
                                @if($userLink->photo)
                                    <img src="{{ $userLink->photo->getUrl('thumb') }}" alt="">
                                @elseif($userLink->main_link && $photo = $userLink->main_link->photo)
                                    <img src="{{ $photo->getUrl('thumb') }}" alt="">
                                @endif
                            </td> 
                            <td>
                                {{ $userLink->main_link->name ?? '' }}
                            </td>
                            <td>
                                {{ $userLink->name ?? '' }}
                            </td>
                            <td>
                                {{ $userLink->link ?? '' }}
                            </td>
                            <td> 
                                <label class="c-switch c-switch-pill c-switch-success">
                                    <input onchange="update_statuses2(this,'active')" value="{{ $userLink->id }}"
                                        type="checkbox" class="c-switch-input"
                                        {{ $userLink->active ? 'checked' : null }}>
                                    <span class="c-switch-slider"></span>
                                </label>
                            </td>
                            <td>
                                {{ $userLink->priority ?? '' }}
                            </td>
                            <td>  
                                <a class="btn btn-xs btn-info"
                                    href="{{ route('company.user-links.edit', $userLink->id) }}">
                                    {{ trans('global.edit') }}
                                </a>  
                                <form action="{{ route('company.user-links.destroy', $userLink->id) }}" method="POST"
                                    onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                    style="display: inline-block;">
                                    <input type="hidden" name="_method" value="DELETE">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="submit" class="btn btn-xs btn-danger"
                                        value="{{ trans('global.delete') }}">
                                </form> 
                            </td>

                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 25,
            });
            let table = $('.datatable-userUserLinks:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>

    <script>
        Dropzone.options.photoDropzone = {
            url: '{{ route('company.storeMedia') }}',
            maxFilesize: 2, // MB
            acceptedFiles: '.jpeg,.jpg,.png,.gif',
            maxFiles: 1,
            addRemoveLinks: true,
            headers: {
                'X-CSRF-TOKEN': "{{ csrf_token() }}"
            },
            params: {
                size: 2,
                width: 4096,
                height: 4096
            },
            success: function(file, response) {
                $('form').find('input[name="photo"]').remove()
                $('form').append('<input type="hidden" name="photo" value="' + response.name + '">')
            },
            removedfile: function(file) {
                file.previewElement.remove()
                if (file.status !== 'error') {
                    $('form').find('input[name="photo"]').remove()
                    this.options.maxFiles = this.options.maxFiles + 1
                }
            }, 
            error: function(file, response) {
                if ($.type(response) === 'string') {
                    var message = response //dropzone sends it's own error messages in string
                } else {
                    var message = response.errors.file
                }
                file.previewElement.classList.add('dz-error')
                _ref = file.previewElement.querySelectorAll('[data-dz-errormessage]')
                _results = []
                for (_i = 0, _len = _ref.length; _i < _len; _i++) {
                    node = _ref[_i]
                    _results.push(node.textContent = message)
                }

                return _results
            }
        }
    </script>
@endsection
