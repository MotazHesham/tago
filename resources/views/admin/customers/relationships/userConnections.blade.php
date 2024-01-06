

<div class="card">
    <div class="card-header">
        {{ trans('cruds.connection.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-userConnections">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.connection.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.connection.fields.user') }}
                        </th>
                        <th>
                            {{ trans('cruds.connection.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.connection.fields.email') }}
                        </th>
                        <th>
                            {{ trans('cruds.connection.fields.title') }}
                        </th>
                        <th>
                            {{ trans('cruds.connection.fields.phone_number') }}
                        </th>
                        <th>
                            {{ trans('cruds.connection.fields.photo') }}
                        </th>
                        <th>
                            {{ trans('cruds.connection.fields.link') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($connections as $key => $connection)
                        <tr data-entry-id="{{ $connection->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $connection->id ?? '' }}
                            </td>
                            <td>
                                {{ $connection->user->name ?? '' }}
                            </td>
                            <td>
                                {{ $connection->name ?? '' }}
                            </td>
                            <td>
                                {{ $connection->email ?? '' }}
                            </td>
                            <td>
                                {{ $connection->title ?? '' }}
                            </td>
                            <td>
                                {{ $connection->phone_number ?? '' }}
                            </td>
                            <td>
                                @if ($connection->photo)
                                    <a href="{{ $connection->photo->getUrl() }}" target="_blank"
                                        style="display: inline-block">
                                        <img src="{{ $connection->photo->getUrl('thumb') }}">
                                    </a>
                                @endif
                            </td>
                            <td>
                                {{ $connection->link ?? '' }}
                            </td>
                            {{-- <td>
                                @can('connection_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.connections.show', $connection->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('connection_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.connections.edit', $connection->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('connection_delete')
                                    <form action="{{ route('admin.connections.destroy', $connection->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
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
            let table = $('.datatable-userConnections:not(.ajaxTable)').DataTable({
                buttons: dtButtons
            })
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        })
    </script>
@endsection
