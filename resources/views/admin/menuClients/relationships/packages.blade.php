@can('menu_client_package_create')
    @include('admin.menuClientPackages.create')
@endcan

<div class="card"> 
    <div class="card-body">
        <div class="table-responsive">
            <table
                class=" table table-bordered table-striped table-hover datatable datatable-menuClientMenuClientPackages">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.menuClientPackage.fields.id') }}
                        </th> 
                        <th>
                            {{ trans('cruds.menuClientPackage.fields.menu_package') }}
                        </th>
                        <th>
                            {{ trans('cruds.menuClientPackage.fields.start_at') }}
                        </th>
                        <th>
                            {{ trans('cruds.menuClientPackage.fields.end_at') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($packages as $key => $menuClientPackage)
                        <tr data-entry-id="{{ $menuClientPackage->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $menuClientPackage->id ?? '' }}
                            </td> 
                            <td>
                                {{ $menuClientPackage->menu_package->name ?? '' }}
                            </td>
                            <td>
                                {{ $menuClientPackage->start_at ?? '' }}
                            </td>
                            <td>
                                {{ $menuClientPackage->end_at ?? '' }}
                            </td>
                            <td> 

                                @can('menu_client_package_delete')
                                    <form
                                        action="{{ route('admin.menu-client-packages.destroy', $menuClientPackage->id) }}"
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
            $.extend(true, $.fn.dataTable.defaults, {
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 25,
            });
            let table = $('.datatable-menuClientMenuClientPackages:not(.ajaxTable)').DataTable({
                buttons: []
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
