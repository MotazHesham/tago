

<div class="card">
    <div class="card-header">
        {{ trans('cruds.userLink.title_singular') }} {{ trans('global.list') }}
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
                            {{ trans('cruds.userLink.fields.user') }}
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
                                {{ $userLink->user->name ?? '' }}
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
                                <span style="display:none">{{ $userLink->active ?? '' }}</span>
                                <input type="checkbox" disabled="disabled" {{ $userLink->active ? 'checked' : '' }}>
                            </td>
                            <td>
                                {{-- @can('user_link_show')
                                    <a class="btn btn-xs btn-primary"
                                        href="{{ route('admin.user-links.show', $userLink->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('user_link_edit')
                                    <a class="btn btn-xs btn-info"
                                        href="{{ route('admin.user-links.edit', $userLink->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('user_link_delete')
                                    <form action="{{ route('admin.user-links.destroy', $userLink->id) }}" method="POST"
                                        onsubmit="return confirm('{{ trans('global.areYouSure') }}');"
                                        style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger"
                                            value="{{ trans('global.delete') }}">
                                    </form>
                                @endcan --}}

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
@endsection
