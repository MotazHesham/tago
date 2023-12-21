@extends('layouts.admin')
@section('content')
    @can('template_create')
        <div style="margin-bottom: 10px;" class="row">
            <div class="col-lg-12">
                <a class="btn btn-success" href="{{ route('frontend.magico') }}">
                    {{ trans('global.add') }} {{ trans('cruds.template.title_singular') }}
                </a>
            </div>
        </div>
    @endcan
    <div class="card">
        <div class="card-header">
            {{ trans('cruds.template.title_singular') }} {{ trans('global.list') }}
        </div>

        <div class="card-body">
            <table class=" table table-bordered table-striped table-hover ajaxTable datatable datatable-Template">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.template.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.template.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.template.fields.price') }}
                        </th>
                        <th>
                            {{ trans('cruds.template.fields.photo') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
            </table>
        </div>
    </div>
@endsection
@section('scripts')
    @parent
    <script>
        $(function() {
            let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons) 
            let dtOverrideGlobals = {
                buttons: dtButtons,
                processing: true,
                serverSide: true,
                retrieve: true,
                aaSorting: [],
                ajax: "{{ route('admin.templates.index') }}",
                columns: [{
                        data: 'placeholder',
                        name: 'placeholder'
                    },
                    {
                        data: 'id',
                        name: 'id'
                    },
                    {
                        data: 'name',
                        name: 'name'
                    },
                    {
                        data: 'price',
                        name: 'price'
                    },
                    {
                        data: 'photo',
                        name: 'photo',
                        sortable: false,
                        searchable: false
                    },
                    {
                        data: 'actions',
                        name: '{{ trans('global.actions') }}'
                    }
                ],
                orderCellsTop: true,
                order: [
                    [1, 'desc']
                ],
                pageLength: 25,
            };
            let table = $('.datatable-Template').DataTable(dtOverrideGlobals);
            $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e) {
                $($.fn.dataTable.tables(true)).DataTable()
                    .columns.adjust();
            });

        });
    </script>
@endsection
