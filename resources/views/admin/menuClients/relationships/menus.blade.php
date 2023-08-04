<div class="card">
    <div class="card-header">
        {{ trans('cruds.menuClientList.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-menuClientMenuClientLists">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.menuClientList.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.menuClientList.fields.menu_theme') }}
                        </th>
                        <th>
                            {{ trans('cruds.menuClientList.fields.active') }}
                        </th>
                        <th>
                            {{ trans('cruds.menuClientList.fields.logo') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($menus as $key => $menuClientList)
                        <tr data-entry-id="{{ $menuClientList->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $menuClientList->id ?? '' }}
                            </td>
                            <td>
                                {{ $menuClientList->menu_theme->name ?? '' }}
                            </td>
                            <td>
                                {{ $menuClientList->active == 1 ? 'Yes' : 'No' }}
                            </td>
                            <td>
                                @if ($menuClientList->logo)
                                    <a href="{{ $menuClientList->logo->getUrl() }}" target="_blank"
                                        style="display: inline-block">
                                        <img src="{{ $menuClientList->logo->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                @can('menu_client_list_show')
                                    <a class="btn btn-xs btn-primary"
                                        href="{{ route('menu',$menuClientList->link) }}" target="_blanc">
                                        {{ trans('global.view') }}
                                    </a>
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

            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 25,
            });
            let table = $('.datatable-menuClientMenuClientLists:not(.ajaxTable)').DataTable({
                buttons: []
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
