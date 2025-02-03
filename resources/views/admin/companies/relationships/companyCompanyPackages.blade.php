@can('company_package_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.company-packages.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.companyPackage.title_singular') }}
            </a>
        </div>
    </div>
@endcan

<div class="card">
    <div class="card-header">
        {{ trans('cruds.companyPackage.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-companyCompanyPackages">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.companyPackage.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.companyPackage.fields.company') }}
                        </th>
                        <th>
                            {{ trans('cruds.companyPackage.fields.price') }}
                        </th>
                        <th>
                            {{ trans('cruds.companyPackage.fields.start_at') }}
                        </th>
                        <th>
                            {{ trans('cruds.companyPackage.fields.end_at') }}
                        </th>
                        <th>
                            {{ trans('cruds.companyPackage.fields.num_of_users') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($companyPackages as $key => $companyPackage)
                        <tr data-entry-id="{{ $companyPackage->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $companyPackage->id ?? '' }}
                            </td>
                            <td>
                                {{ $companyPackage->company->company_name ?? '' }}
                            </td>
                            <td>
                                {{ $companyPackage->price ?? '' }}
                            </td>
                            <td>
                                {{ $companyPackage->start_at ?? '' }}
                            </td>
                            <td>
                                {{ $companyPackage->end_at ?? '' }}
                            </td>
                            <td>
                                {{ $companyPackage->num_of_users ?? '' }}
                            </td>
                            <td>
                                @can('company_package_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.company-packages.show', $companyPackage->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('company_package_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.company-packages.edit', $companyPackage->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('company_package_delete')
                                    <form action="{{ route('admin.company-packages.destroy', $companyPackage->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
                                        <input type="hidden" name="_method" value="DELETE">
                                        <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                        <input type="submit" class="btn btn-xs btn-danger" value="{{ trans('global.delete') }}">
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
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('company_package_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.company-packages.massDestroy') }}",
    className: 'btn-danger',
    action: function (e, dt, node, config) {
      var ids = $.map(dt.rows({ selected: true }).nodes(), function (entry) {
          return $(entry).data('entry-id')
      });

      if (ids.length === 0) {
        alert('{{ trans('global.datatables.zero_selected') }}')

        return
      }

      if (confirm('{{ trans('global.areYouSure') }}')) {
        $.ajax({
          headers: {'x-csrf-token': _token},
          method: 'POST',
          url: config.url,
          data: { ids: ids, _method: 'DELETE' }})
          .done(function () { location.reload() })
      }
    }
  }
  dtButtons.push(deleteButton)
@endcan

  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 25,
  });
  let table = $('.datatable-companyCompanyPackages:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection