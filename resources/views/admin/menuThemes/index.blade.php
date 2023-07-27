@extends('layouts.admin')
@section('content')

<div class="card">
    <div class="card-header">
        {{ trans('cruds.menuTheme.title_singular') }} {{ trans('global.list') }}
    </div>

    <div class="card-body">
        <div class="table-responsive">
            <table class=" table table-bordered table-striped table-hover datatable datatable-MenuTheme">
                <thead>
                    <tr>
                        <th width="10">

                        </th>
                        <th>
                            {{ trans('cruds.menuTheme.fields.id') }}
                        </th>
                        <th>
                            {{ trans('cruds.menuTheme.fields.name') }}
                        </th> 
                        <th>
                            &nbsp;
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($menuThemes as $key => $menuTheme)
                        <tr data-entry-id="{{ $menuTheme->id }}">
                            <td>

                            </td>
                            <td>
                                {{ $menuTheme->id ?? '' }}
                            </td>
                            <td>
                                {{ $menuTheme->name ?? '' }}
                            </td>
                            <td> 
                                <a href="{{ route('menuClient.theme',$menuTheme->id) }}" class="btn btn-success" target="_blanc">view</a>
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
  
  $.extend(true, $.fn.dataTable.defaults, {
    orderCellsTop: true,
    order: [[ 1, 'desc' ]],
    pageLength: 100,
  });
  let table = $('.datatable-MenuTheme:not(.ajaxTable)').DataTable({ buttons: dtButtons })
  $('a[data-toggle="tab"]').on('shown.bs.tab click', function(e){
      $($.fn.dataTable.tables(true)).DataTable()
          .columns.adjust();
  });
  
})

</script>
@endsection