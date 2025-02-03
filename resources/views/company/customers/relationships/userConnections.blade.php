

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

                            <td>
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
