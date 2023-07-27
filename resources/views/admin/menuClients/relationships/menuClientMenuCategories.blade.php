@can('menu_category_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.menu-categories.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.menuCategory.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.menuCategory.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-menuClientMenuCategories">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.menuCategory.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.menuCategory.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.menuCategory.fields.banner') }}
                        </th>
                        <th>
                            {{ trans('cruds.menuCategory.fields.menu_client') }}
                        </th>
                        <th>
                            {{ trans('cruds.menuCategory.fields.menu_client_list') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($menuCategories as $key => $menuCategory)
                        <tr data-entry-id="{{ $menuCategory->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $menuCategory->id ?? '' }}
                            </td>
                            <td>
                                {{ $menuCategory->name ?? '' }}
                            </td>
                            <td>
                                @if ($menuCategory->banner)
                                    <a href="{{ $menuCategory->banner->getUrl() }}" target="_blank"
                                        style="display: inline-block">
                                        <img src="{{ $menuCategory->banner->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ $menuCategory->menu_client->facebook ?? '' }}
                            </td>
                            <td>
                                @foreach ($menuCategory->menu_client_lists as $key => $item)
                                    <span class="badge badge-info">{{ $item->facebook }}</span>
                                @endforeach
                            </td>
                            <td>
                                @can('menu_category_show')
                                    <a class="btn btn-xs btn-primary"
                                        href="{{ route('admin.menu-categories.show', $menuCategory->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('menu_category_edit')
                                    <a class="btn btn-xs btn-info"
                                        href="{{ route('admin.menu-categories.edit', $menuCategory->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('menu_category_delete')
                                    <form action="{{ route('admin.menu-categories.destroy', $menuCategory->id) }}"
                                        method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                        style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger"
                                            value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan

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
            @can('menu_category_delete')
                let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
                let deleteButton = {
                    text: deleteButtonTrans,
                    url: "{{ route('admin.menu-categories.massDestroy') }}",
                    className: 'btn-danger',
                    action: function(e, dt, node, config) {
                        var ids = $.map(dt.rows({
                            selected: true
                        }).nodes(), function(entry) {
                            return $(entry).data('entry-id')
                        });

                        if (ids.length === 0) {
                            alert('{{ trans('global.datatables.zero_selected') }}')

                            return
                        }

                        if (confirm('{{ trans('global.areYouSure') }}')) {
                            $.ajax({
                                    headers: {
                                        'x-csrf-token': _token
                                    },
                                    method: 'POST',
                                    url: config.url,
                                    data: {
                                        ids: ids,
                                        _method: 'DELETE'
                                    }
                                })
                                .done(function() {
                                    location.reload()
                                })
                        }
                    }
                }
                dtButtons.push(deleteButton)
            @endcan

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 100,
            });
            let table = $('.datatable-menuClientMenuCategories:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
