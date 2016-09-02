@extends('layouts.app')

@section('contentheader_title','Dashboard')


@section('content')

    <div class="row">

        <div class="col-xs-12">

            <div class="box">
                <div class="box-header with-border">
                    <h3 class="box-title">Данные</h3>
                </div><!-- /.box-header -->
                <div class="box-body">


                    <table class="table table-bordered" id="items">
                        <thead>
                        <tr>
                            <th><input name="select_all" value="1" type="checkbox"></th>
                            @foreach($columns as $column)
                                <th>{{ $column->Comment ?: $column->Field }}</th>
                            @endforeach
                        </tr>
                        </thead>
                    </table>

                </div><!-- /.box-body -->
            </div><!-- /.box -->

        </div>


    </div>





@endsection

@section('scripts')

    @parent


    <script src="plugins/datatables2/datatables.js"></script>

    <script>


        //
        // Updates "Select all" control in a data table
        //
        function updateDataTableSelectAllCtrl(table) {
            var $table = table.table().node();
            var $chkbox_all = $('tbody input[type="checkbox"]', $table);
            var $chkbox_checked = $('tbody input[type="checkbox"]:checked', $table);
            var chkbox_select_all = $('thead input[name="select_all"]', $table).get(0);

            // If none of the checkboxes are checked
            if ($chkbox_checked.length === 0) {
                chkbox_select_all.checked = false;
                if ('indeterminate' in chkbox_select_all) {
                    chkbox_select_all.indeterminate = false;
                }

                // If all of the checkboxes are checked
            } else if ($chkbox_checked.length === $chkbox_all.length) {
                chkbox_select_all.checked = true;
                if ('indeterminate' in chkbox_select_all) {
                    chkbox_select_all.indeterminate = false;
                }

                // If some of the checkboxes are checked
            } else {
                chkbox_select_all.checked = true;
                if ('indeterminate' in chkbox_select_all) {
                    chkbox_select_all.indeterminate = true;
                }
            }
        }


        $(function () {


            var rows_selected = [];
            var filter_processed = 'any';


            var table = $('#items').DataTable({
                language: {
                    "processing": "Подождите...",
                    "search": "Поиск:",
                    "lengthMenu": "Показать _MENU_ записей",
                    "info": "Записи с _START_ до _END_ из _TOTAL_ записей",
                    "infoEmpty": "Записи с 0 до 0 из 0 записей",
                    "infoFiltered": "(отфильтровано из _MAX_ записей)",
                    "infoPostFix": "",
                    "loadingRecords": "Загрузка записей...",
                    "zeroRecords": "Записи отсутствуют.",
                    "emptyTable": "В таблице отсутствуют данные",
                    "paginate": {
                        "first": "Первая",
                        "previous": "Предыдущая",
                        "next": "Следующая",
                        "last": "Последняя"
                    },
                    "aria": {
                        "sortAscending": ": активировать для сортировки столбца по возрастанию",
                        "sortDescending": ": активировать для сортировки столбца по убыванию"
                    }
                },
                dom: 'Bfrtip',
                processing: true,
                serverSide: true,
                ordering: true,
                order: [1, 'asc'],
                searchDelay: 1000,
                columnDefs: [{
                    'targets': 0,
                    'searchable': false,
                    'orderable': false,
                    'width': '1%',
                    'className': 'dt-body-center',
                    'render': function (data, type, full, meta) {
                        return '<input type="checkbox">';
                    }
                }],
                rowCallback: function (row, data, dataIndex) {
                    // Get row ID
                    var rowId = data[0];

                    // If row ID is in the list of selected row IDs
                    if ($.inArray(rowId, rows_selected) !== -1) {
                        {{--$(row).find('input[type="checkbox"]').prop('checked', true);--}}
                        {{--$(row).addClass('selected');--}}
                    }
                },

                ajax: {
                    "url": '{{ url('/ajax/'.$table_name)  }}',
                    "data": function (d) {
                        d.processed = filter_processed;
                    }
                },
                columns: [
                    {data: '', name: '-'},
                        @foreach($columns as $column)
                    {
                        data: '{{$column->Field}}', name: '{{$column->Field }}'
                    },
                    @endforeach
                ],
                lengthMenu: [
                    [10, 25, 50, -1],
                    ['10', '25', '50', 'Все']
                ],
                buttons: [
                    'pageLength',
                        {{--{--}}
                        {{--extend: 'collection',--}}
                        {{--text: 'Обработано',--}}
                        {{--autoClose: true,--}}
                        {{--buttons: [--}}
                        {{--{--}}
                        {{--text: 'Необработанные',--}}
                        {{--action: function ( e, dt, node, config ) {--}}
                        {{--filter_processed = 0;--}}
                        {{--dt.draw(false);--}}
                        {{--}--}}
                        {{--},--}}
                        {{--{--}}
                        {{--text: 'Обработанные',--}}
                        {{--action: function ( e, dt, node, config ) {--}}
                        {{--filter_processed = 1;--}}
                        {{--dt.draw(false);--}}
                        {{--}--}}
                        {{--},--}}
                        {{--{--}}
                        {{--text: 'Все',--}}
                        {{--action: function ( e, dt, node, config ) {--}}
                        {{--filter_processed = 'any';--}}
                        {{--dt.draw(false);--}}
                        {{--}--}}
                        {{--}--}}
                        {{--]--}}
                        {{--},--}}
                    {
                        extend: 'collection',
                        text: 'Удалить',
                        autoClose: true,
                        buttons: [
                            {
                                text: 'Выбранное',
                                action: function (e, dt, node, config) {
                                    if (!confirm('Вы уверены?')) {
                                        return;
                                    }

                                    var selectedRows = table.rows($('#items tr.selected')).data().to$();

                                    $.ajax({
                                        url: '{{ url('api/v1/delete') }}',
                                        method: 'POST',
                                        data: {table: "{{ $table_name }}", rows: selectedRows.toArray()},
                                        dataType: 'json',
                                        success: function (data, status, xhr) {
                                            table.rows($('#items tr.selected')).remove().draw(false);
                                        }
                                    });
                                }
                            },
                            {
                                text: 'Всё',
                                action: function (e, dt, node, config) {
                                    if (!confirm('Вы уверены?')) {
                                        return;
                                    }

                                    var selectedRows = table.rows($('#items tr.selected')).data().to$();


                                    $.ajax({
                                        url: '{{ url('api/v1/delete') }}',
                                        method: 'POST',
                                        data: {table: "{{ $table_name }}", all: true},
                                        dataType: 'json',
                                        success: function (data, status, xhr) {
                                            table.rows($('#items tr.selected')).remove().draw(false);
                                        }
                                    });
                                }
                            },
                            {
                                text: 'Удалить таблицу',
                                action: function (e, dt, node, config) {
                                    if (!confirm('Вы уверены?')) {
                                        return;
                                    }

                                    $.ajax({
                                        url: '{{ url('api/v1/ajax/drop') }}',
                                        method: 'POST',
                                        data: {table: "{{ $table_name }}"},
                                        dataType: 'json',
                                        success: function (data, status, xhr) {
                                            location.href = '/';
                                        }
                                    });
                                }
                            }
                        ]
                    },
                        {{--{--}}
                        {{--extend: 'collection',--}}
                        {{--text: 'Пометить как',--}}
                        {{--autoClose: true,--}}
                        {{--buttons: [--}}
                        {{--{--}}
                        {{--text: 'Необработанные',--}}
                        {{--action: function ( e, dt, node, config ) {--}}
                        {{--var selectedRows = table.rows( $('#items tr.selected') ).data().to$();--}}

                        {{--$.ajax({--}}
                        {{--url: '{{ url('api/v1/setunmarked') }}',--}}
                        {{--method: 'POST',--}}
                        {{--data: { table:"{{ $table_name }}", rows: selectedRows.toArray() },--}}
                        {{--dataType: 'json',--}}
                        {{--success: function( data, status, xhr ) {--}}
                        {{--table.rows( $('#items tr.selected') ).remove().draw(false);--}}
                        {{--}--}}
                        {{--});--}}
                        {{--}--}}
                        {{--},--}}
                        {{--{--}}
                        {{--text: 'Обработанные',--}}
                        {{--action: function ( e, dt, node, config ) {--}}
                        {{--var selectedRows = table.rows( $('#items tr.selected') ).data().to$();--}}
                        {{--$.ajax({--}}
                        {{--url: '{{ url('api/v1/setmarked') }}',--}}
                        {{--method: 'POST',--}}
                        {{--data: { table:"{{ $table_name }}", rows: selectedRows.toArray() },--}}
                        {{--dataType: 'json',--}}
                        {{--success: function( data, status, xhr ) {--}}
                        {{--table.rows( $('#items tr.selected') ).remove().draw(false);--}}
                        {{--}--}}
                        {{--});--}}
                        {{--}--}}
                        {{--}--}}
                        {{--]--}}
                        {{--},--}}
                    {
                        extend: 'collection',
                        text: 'Экспорт',
                        autoClose: true,
                        buttons: [
                            'excel', 'csv'
                        ]
                    }
                ]
            });


            // Handle click on checkbox
            $('#items tbody').on('click', 'input[type="checkbox"]', function (e) {
                var $row = $(this).closest('tr');

                // Get row data
                var data = table.row($row).data();

                // Get row ID
                var rowId = data[0];

                // Determine whether row ID is in the list of selected row IDs
                var index = $.inArray(rowId, rows_selected);

                // If checkbox is checked and row ID is not in list of selected row IDs
                if (this.checked && index === -1) {
                    rows_selected.push(rowId);

                    // Otherwise, if checkbox is not checked and row ID is in list of selected row IDs
                } else if (!this.checked && index !== -1) {
                    rows_selected.splice(index, 1);
                }

                if (this.checked) {
                    $row.addClass('selected');
                } else {
                    $row.removeClass('selected');
                }

                // Update state of "Select all" control
                updateDataTableSelectAllCtrl(table);

                // Prevent click event from propagating to parent
                e.stopPropagation();
            });

            // Handle click on table cells with checkboxes
            $('#items').on('click', 'tbody td, thead th:first-child', function (e) {
                $(this).parent().find('input[type="checkbox"]').trigger('click');
            });

            // Handle click on "Select all" control
            $('thead input[name="select_all"]', table.table().container()).on('click', function (e) {
                if (this.checked) {
                    $('#items tbody input[type="checkbox"]:not(:checked)').trigger('click');
                } else {
                    $('#items tbody input[type="checkbox"]:checked').trigger('click');
                }

                // Prevent click event from propagating to parent
                e.stopPropagation();
            });

            // Handle table draw event
            table.on('draw', function () {
                // Update state of "Select all" control
                updateDataTableSelectAllCtrl(table);
            });


        });

    </script>


@endsection
