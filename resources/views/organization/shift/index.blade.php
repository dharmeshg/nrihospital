@extends('layout.main')
@section('content')
 
    <section>
        <div class="container-fluid mb-3">
            @can('store-company')
                <button type="button" class="btn btn-info" name="create_record" id="create_record"><i class="fa fa-plus"></i> {{__('Add Shift')}}</button>
            @endcan
            @can('delete-company')
                <button type="button" class="btn btn-danger" name="bulk_delete" id="bulk_delete"><i class="fa fa-minus-circle"></i> {{__('Bulk delete')}}</button>
            @endcan
        </div>


        <div class="table-responsive">
            <table id="shift-table" class="table ">
                <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th>Division</th>
                    <th>Code</th>
                    <th>Shift Name</th>
                    <th>Strat Time</th>
                    <th>Br.Out Time</th>
                    <th>Br.In Time</th>
                    <th>End Time</th>
                    <th>Grace In</th>
                    <th>Out</th>
                    <th>Half Day Hrs</th>
                    <th>Full Day Hrs</th>
                    <th>Shift Based</th>
                    <th>Day Off Shift</th>
                    <th class="not-exported">{{trans('file.action')}}</th>

                </tr>
                </thead>

            </table>
        </div>
    </section>


    <div id="formModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 id="exampleModalLabel" class="modal-title">{{__('Add Shift')}}</h5>
                    <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i class="dripicons-cross"></i></button>
                </div>

                <div class="modal-body">
                    <span id="store_logo"></span>

                    <span id="form_result"></span>
                    <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">

                        @csrf
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label>{{__('Division')}} <span class="text-danger">*</span></label>
                                <select name="division_id" id="division_id" class="form-control selectpicker dynamic"
                                            data-live-search="true" data-live-search-style="contains"
                                            data-dependent="department_name"
                                            title='{{__('Selecting',['key'=>trans('file.Shift')])}}...'>
                                        @foreach($divisions as $division)
                                            <option value="{{$division->id}}">{{$division->division_name}}</option>
                                        @endforeach

                                </select>
                            </div>
                            <div class="col-md-6 form-group">
                                <label>{{__('Code')}} *</label>
                                <input type="text" name="code" id="code"  class="form-control"
                                    placeholder="{{__('Code')}}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>{{__('Shift Name')}} </label>
                                <input type="text" name="shift_name" id="shift_name"  class="form-control"
                                    placeholder="{{__('Shift Name')}}">
                            </div>

                            <div class="col-md-6 form-group">
                                <label>{{__('Start Time')}} </label>
                                <input type="time" name="start_time" id="start_time"  class="form-control"
                                    placeholder="{{__('Start Time')}}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>{{__('End Time')}} </label>
                                <input type="time" name="end_time" id="end_time"  class="form-control"
                                    placeholder="{{__('End Time')}}">
                            </div>

                            <div class="col-md-6 form-group">
                                <label>{{__('Br.Out Time')}} </label>
                                <input type="time" name="br_out_time" id="br_out_time"  class="form-control"
                                    placeholder="{{__('Br.Out Time')}}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>{{__('Br.In Time')}} </label>
                                <input type="time" name="br_in_time" id="br_in_time"  class="form-control"
                                    placeholder="{{__('Br.In Time')}}">
                            </div>

                            <div class="col-md-6 form-group">
                                <label>{{__('Grace In')}} </label>
                                <input type="text" name="grace_in" id="grace_in" min="0"  class="form-control min"
                                    placeholder="{{__('Grace In')}}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>{{__('Grace Out')}} </label>
                                <input type="text" name="grace_out" id="grace_out" min="0"  class="form-control min"
                                    placeholder="{{__('Grace Out')}}">
                            </div>

                            <div class="col-md-6 form-group">
                                <label>{{__('Half Day')}}</label>
                                <input type="text" name="half_day" id="half_day" min="0"  class="form-control hrs"
                                    placeholder="{{__('Half Day')}}">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>{{__('Full Day')}} </label>
                                <input type="text" name="full_day" id="full_day" min="0"  class="form-control hrs"
                                    placeholder="{{__('Full Day')}}">
                            </div>
                            <div class="col-md-12 form-group custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="shift_based" id="shift_based" value="1" checked="">
                                <label class="custom-control-label" for="shift_based">Shift Based</label>
                            </div>
                            <div class="col-md-12 form-group custom-checkbox">
                                <input type="checkbox" class="custom-control-input" name="day_off_allowed" id="day_off_allowed" value="1" checked="">
                                <label class="custom-control-label" for="day_off_allowed">Day Off Allowed</label>
                            </div>


                            <div class="col-md-12  form-group" align="">
                                <input type="hidden" name="action" id="action"/>
                                <input type="hidden" name="hidden_id" id="hidden_id"/>
                                <input type="submit" name="action_button" id="action_button" class="btn btn-warning"
                                       value={{trans('file.Add')}} />
                            </div>
                        </div>

                    </form>

                </div>
            </div>
        </div>
    </div>

 

    <div id="confirmModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title">{{trans('file.Confirmation')}}</h2>
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <h4 align="center">{{__('Are you sure you want to remove this data?')}}</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" name="ok_button" id="ok_button" class="btn btn-danger">{{trans('file.OK')}}'
                    </button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('file.Cancel')}}</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script type="text/javascript">
        (function($) {
            "use strict";

            $(document).ready(function () {
                var table_table = $('#shift-table').DataTable({
                initComplete: function () {
                    this.api().columns([1]).every(function () {
                        var column = this;
                        var select = $('<select><option value=""></option></select>')
                            .appendTo($(column.footer()).empty())
                            .on('change', function () {
                                var val = $.fn.dataTable.util.escapeRegex(
                                    $(this).val()
                                );
                                column.search(val ? '^' + val + '$' : '', true, false).draw();
                            });

                        column.data().unique().sort().each(function (d, j) {
                            select.append('<option value="' + d + '">' + d + '</option>');
                            $('select').selectpicker('refresh');
                        });
                    });
                },
                responsive: true,
                fixedHeader: {
                    header: true,
                    footer: true
                },
                processing: true,
                serverSide: true,
                ajax: {
                    url: "{{ route('shift.index') }}",
                },

                columns: [

                    {
                        data: 'id',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'division_name',
                        name: 'division_name',

                    },
                    {
                        data: 'code',
                        name: 'code',

                    },
                    {
                        data: 'shift_name',
                        name: 'shift_name',

                    },
                    {
                        data: 'start_time',
                        name: 'start_time',

                    },
                    {
                        data: 'br_out_time',
                        name: 'br_out_time',

                    },
                    {
                        data: 'br_in_time',
                        name: 'br_in_time',

                    },
                    {
                        data: 'end_time',
                        name: 'end_time',

                    },
                    {
                        data: 'grace_in',
                        name: 'grace_in',

                    },
                    {
                        data: 'grace_out',
                        name: 'grace_out',

                    },
                    {
                        data: 'half_day',
                        name: 'half_day',

                    },
                    {
                        data: 'full_day',
                        name: 'full_day',

                    },
                    {
                        data: 'shift_based',
                        name: 'shift_based',

                    },
                    {
                        data: 'day_off_allowed',
                        name: 'day_off_allowed',

                    },
                    {
                        data: 'action',
                        name: 'action',
                        orderable: false
                    }
                ],


                "order": [],
                'language': {
                    'lengthMenu': '_MENU_ {{__("records per page")}}',
                    "info": '{{trans("file.Showing")}} _START_ - _END_ (_TOTAL_)',
                    "search": '{{trans("file.Search")}}',
                    'paginate': {
                        'previous': '{{trans("file.Previous")}}',
                        'next': '{{trans("file.Next")}}'
                    }
                },
                'columnDefs': [
                    {
                        "orderable": false,
                        'targets': [0, 2],
                    },
                    {
                        'render': function (data, type, row, meta) {
                            if (type == 'display') {
                                data = '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>';
                            }

                            return data;
                        },
                        'checkboxes': {
                            'selectRow': true,
                            'selectAllRender': '<div class="checkbox"><input type="checkbox" class="dt-checkboxes"><label></label></div>'
                        },
                        'targets': [0]
                    }
                ],


                'select': {style: 'multi', selector: 'td:first-child'},
                'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "All"]],
                dom: '<"row"lfB>rtip',
                buttons: [
                    {
                        extend: 'pdf',
                        text: '<i title="export to pdf" class="fa fa-file-pdf-o"></i>',
                        exportOptions: {
                            columns: ':visible:Not(.not-exported)',
                            rows: ':visible'
                        },
                    },
                    {
                        extend: 'csv',
                        text: '<i title="export to csv" class="fa fa-file-text-o"></i>',
                        exportOptions: {
                            columns: ':visible:Not(.not-exported)',
                            rows: ':visible'
                        },
                    },
                    {
                        extend: 'print',
                        text: '<i title="print" class="fa fa-print"></i>',
                        exportOptions: {
                            columns: ':visible:Not(.not-exported)',
                            rows: ':visible'
                        },
                    },
                    {
                        extend: 'colvis',
                        text: '<i title="column visibility" class="fa fa-eye"></i>',
                        columns: ':gt(0)'
                    },
                ],
            });
            new $.fn.dataTable.FixedHeader(table_table);
        });


            // $(document).on('click', '#create_record', function () {
            $('#create_record').on('click', function () {
                console.log('Create');
                $('.modal-title').text('{{__('Add New Shift')}}');
                $('#action_button').val('{{trans("file.Add")}}');
                $('#action').val('{{trans("file.Add")}}');
                $('#store_logo').html('');
                $('#formModal').modal('show');
            });


            $('#sample_form').on('submit', function (event) {
                event.preventDefault();
                if ($('#action').val() == '{{trans('file.Add')}}') {
                    $.ajax({
                        url: "{{ route('shift.store') }}",
                        method: "POST",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        dataType: "json",
                        success: function (data) {
                            console.log(data);
                            var html = '';
                            if (data.errors) {
                                // html = '<div class="alert alert-danger">';
                                for (var count = 0; count < data.errors.length; count++) {
                                    toastr.error(data.errors[count]);
                                }
                                // html += '</div>';
                            }
                            if (data.success) {
                                toastr.success(data.success);
                                $('#sample_form')[0].reset();
                                $('select').selectpicker('refresh');
                                $('#shift-table').DataTable().ajax.reload(null, false);
                                setTimeout(function() {
                                    $('#formModal').modal('hide');
                                }, 2000); 
                            }
                            // $('#form_result').html(html).slideDown(300).delay(5000).slideUp(300);
                        }
                    })
                }

                if ($('#action').val() == '{{trans('file.Edit')}}') {
                    $.ajax({
                        url: "{{ route('shift.update') }}",
                        method: "POST",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        dataType: "json",
                        success: function (data) {
                            var html = '';
                            if (data.errors) {
                                // html = '<div class="alert alert-danger">';
                                for (var count = 0; count < data.errors.length; count++) {
                                    toastr.error(data.errors[count]);
                                }
                                // html += '</div>';
                            }
                            if (data.success) {
                                toastr.success(data.success);
                                $('#sample_form')[0].reset();
                                $('select').selectpicker('refresh');
                                $('#shift-table').DataTable().ajax.reload();
                            }
                            setTimeout(function() {
                                    $('#formModal').modal('hide');
                                }, 2000);
                            // $('#form_result').html(html).slideDown(300).delay(5000).slideUp(300);
                        }
                    });
                }
            });


            $(document).on('click', '.edit', function () {
                var id = $(this).attr('id');
                $('#form_result').html('');

                var target = "{{ url('/organization/shift/edit')}}/" + id;

                $.ajax({
                    url: target,
                    dataType: "json",
                    success: function (html) {
                        $('#division_id').val(html.data.division_id).trigger('change');
                        $('#code').val(html.data.code);
                        $('#shift_name').val(html.data.shift_name);
                        $('#start_time').val(html.data.start_time);
                        $('#end_time').val(html.data.end_time);
                        $('#br_out_time').val(html.data.br_out_time);
                        $('#br_in_time').val(html.data.br_in_time);
                        $('#grace_in').val(html.data.grace_in);
                        $('#grace_out').val(html.data.grace_out);
                        $('#half_day').val(html.data.half_day);
                        $('#full_day').val(html.data.full_day);

                        if (html.data.shift_based == 'Yes') {
                            $('#shift_based').prop('checked', true);
                        } else {
                            $('#shift_based').prop('checked', false);
                        }

                        if (html.data.day_off_allowed == 'Yes') {
                            $('#day_off_allowed').prop('checked', true);
                        } else {
                            $('#day_off_allowed').prop('checked', false);
                        }

                        $('#hidden_id').val(html.data.id);
                        $('.modal-title').text('{{trans('file.Edit')}}');
                        $('#action_button').val('{{trans('file.Edit')}}');
                        $('#action').val('{{trans('file.Edit')}}');
                        $('#formModal').modal('show');
                    }
                })
            });


            let lid;
            $(document).on('click', '.delete', function () {
                lid = $(this).attr('id');
                $('#confirmModal').modal('show');
                $('.modal-title').text('{{__('DELETE Record')}}');
                $('#ok_button').text('{{trans('file.OK')}}');

            });


            $(document).on('click', '#bulk_delete', function () {
                let table = $('#shift-table').DataTable();
                let id = [];
                id = table.rows({selected: true}).ids().toArray();
                console.log(id);
                if (id.length > 0) {
                    if (confirm("Are you sure you want to delete the selected Shift?")) {
                        $.ajax({
                            url: '{{route('mass_delete_shift')}}',
                            method: 'POST',
                            data: {
                                shiftIdArray: id
                            },
                            success: function (data) {
                                let html = '';
                                if (data.success) {
                                    toastr.success(data.success);
                                }
                                if (data.error) {
                                    toastr.error(data.error);
                                }
                                table.ajax.reload();
                                table.rows('.selected').deselect();
                                if (data.errors) {
                                    toastr.error(data.error);
                                }
                                // $('#general_result').html(html).slideDown(300).delay(5000).slideUp(300);
                            }

                        });
                    }
                } else {

                }

            });
            $('#formModal').on('hidden.bs.modal', function () {
                $('#sample_form')[0].reset();
                $('#division_id').val('').trigger('change');

            });


            $('.close').on('click', function () {
                $('#sample_form')[0].reset();
                $('#store_logo').html('');
                $('#logo_id').html('');
                $('#shift-table').DataTable().ajax.reload();
                $('select').selectpicker('refresh');
            });

            $('#ok_button').on('click', function () {
                var target = "{{ url('/organization/shift/delete')}}/" + lid;
                $.ajax({
                    url: target,
                    beforeSend: function () {
                        $('#ok_button').text('{{trans('file.Deleting...')}}');
                    },
                    success: function (data) {
                        console.log(data);

                        let html = '';
                        if (data.success) {
                            toastr.success(data.success);
                        }
                        if (data.error) {
                            toastr.error(data.error);
                        }
                       setTimeout(function () {
                        // $('#general_result').html(html).slideDown(300).delay(5000).slideUp(300);
                        $('#confirmModal').modal('hide');
                        $('#shift-table').DataTable().ajax.reload();
                    }, 2000);
                    }
                })
            });

        })(jQuery);
    </script>
@endpush
