@extends('layouts.admin')
@section('content')
@can('tutorial_create')
    <div style="margin-bottom: 10px;" class="row">
        <div class="col-lg-12">
            <a class="btn btn-success" href="{{ route('admin.tutorials.create') }}">
                {{ trans('global.add') }} {{ trans('cruds.tutorial.title_singular') }}
            </a>
        </div>
    </div>
@endcan
<div class="card">
    <div class="card-header">
        {{ trans('cruds.tutorial.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-Tutorial">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.tutorial.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.tutorial.fields.name') }}
                        </th>
                        <th>
                            {{ trans('cruds.tutorial.fields.iframe') }}
                        </th>
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tutorials as $key => $tutorial)
                        <tr data-entry-id="{{ $tutorial->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $tutorial->id ?? '' }}
                            </td>
                            <td>
                                {{ $tutorial->name ?? '' }}
                            </td>
                            <td>
                                {{ $tutorial->iframe ?? '' }}
                            </td>
                            <td>
                                @can('tutorial_show')
                                    <a class="btn btn-xs btn-primary" href="{{ route('admin.tutorials.show', $tutorial->id) }}">
                                        {{ trans('global.view') }}
                                    </a>
                                @endcan

                                @can('tutorial_edit')
                                    <a class="btn btn-xs btn-info" href="{{ route('admin.tutorials.edit', $tutorial->id) }}">
                                        {{ trans('global.edit') }}
                                    </a>
                                @endcan

                                @can('tutorial_delete')
                                    <form action="{{ route('admin.tutorials.destroy', $tutorial->id) }}" method="POST" onsubmit="return confirm('{{ trans('global.areYouSure') }}');" style="display: inline-block;">
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



@endsection
@section('scripts')
@parent
<script>
    $(function () {
  let dtButtons = $.extend(true, [], $.fn.dataTable.defaults.buttons)
@can('tutorial_delete')
  let deleteButtonTrans = '{{ trans('global.datatables.delete') }}'
  let deleteButton = {
    text: deleteButtonTrans,
    url: "{{ route('admin.tutorials.massDestroy') }}",
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
    pageLength: 100,
  });
  let table = $('.datatable-Tutorial:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection