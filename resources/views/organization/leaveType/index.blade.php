@extends('layout.main')
@section('content')
 
    <section>
        <div class="container-fluid mb-3">
            @can('store-company')
                <button type="button" class="btn btn-info" name="create_record" id="create_record"><i class="fa fa-plus"></i> {{__('Add Leave Type')}}</button>
            @endcan
            @can('delete-company')
                <button type="button" class="btn btn-danger" name="bulk_delete" id="bulk_delete"><i class="fa fa-minus-circle"></i> {{__('Bulk delete')}}</button>
            @endcan
        </div>


        <div class="table-responsive">
            <table id="leaveType-table" class="table ">
                <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th>Leave Name</th>
                    <th>No. of Leave Per Annum</th>
                    <th>Max. Carry Forward</th>
                    <th>Description</th>
                    <th>Carry Forward</th>
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
                    <h5 id="exampleModalLabel" class="modal-title">{{__('Add Leave Type')}}</h5>
                    <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i class="dripicons-cross"></i></button>
                </div>

                <div class="modal-body">
                    <span id="store_logo"></span>

                    <span id="form_result"></span>
                    <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">

                        @csrf
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label>{{__('Name')}} <span class="text-danger">*</span></label>
                                <input type="text" name="leave_type" id="leave_type" required class="form-control"
                                       placeholder="Name">
                            </div>
                            <div class="col-md-12 form-group">
                                <label>{{__('Days Per Year')}} *</label>
                                <input type="number" name="allocated_day" id="allocated_day"  class="form-control"
                                    placeholder="{{__('Days Per Year')}}">
                            </div>
                            <div class="col-md-12 form-group">
                                <label>{{__('Max. Carry Forward')}} </label>
                                <input type="number" name="max_carry_forward" id="max_carry_forward"  class="form-control"
                                    placeholder="{{__('Max. Carry Forward')}}">
                            </div>
                            <div class="col-md-12 form-group">
                                <label>{{__('Carry Forward')}} </label>
                                <!-- <input type="number" name="max_carry_forward" id="max_carry_forward"  class="form-control"
                                    placeholder="{{__('Carry Forward')}}"> -->
                                    <select class="form-control" id="carry_forward" name="carry_forward">
                                        <option value="Yes">Yes</option>
                                        <option value="No">No</option>
                                    </select>
                            </div>
                            <div class="col-md-12 form-group">
                                <label>{{__('Description')}} </label>
                                <textarea class="form-control" id="description" name="description" rows="3"></textarea>
                            </div>


                            <div class="col-md-12 form-group" align="">
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

    <!-- <div class="modal fade" id="company_modal" tabindex="-1" role="dialog" aria-labelledby="basicModal"
         aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="myModalLabel">{{__('Company Info')}}</h4>
                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                </div>
                <div class="modal-body">

                    <span id="logo_id"></span>

                    <div class="row">
                        <div class="col-md-12">

                            <div class="table-responsive">

                                <table class="table  table-bordered">
                                    <tr>
                                        <th>{{trans('file.Company')}}</th>
                                        <td id="company_name_id"></td>
                                    </tr>

                                    <tr>
                                        <th>{{__('Company Type')}}</th>
                                        <td id="company_type"></td>
                                    </tr>

                                    <tr>
                                        <th>{{__('Trading Name')}}</th>
                                        <td id="trading_name_id"></td>
                                    </tr>

                                    <tr>
                                        <th>{{__('Registration Number')}}</th>
                                        <td id="registration_no_id"></td>
                                    </tr>

                                    <tr>
                                        <th>{{__('Contact Number')}}</th>
                                        <td id="contact_no_id"></td>
                                    </tr>

                                    <tr>
                                        <th>{{trans('file.Email')}}</th>
                                        <td id="email_id"></td>
                                    </tr>

                                    <tr>
                                        <th>{{trans('file.Website')}}</th>
                                        <td id="website_id"></td>
                                    </tr>

                                    <tr>
                                        <th>{{__('Tax Number')}}</th>
                                        <td id="tax_no_id"></td>
                                    </tr>

                                    <tr>
                                        <th>{{trans('file.Address')}}</th>
                                        <td><p id="address1_id"></p>
                                            <p id="address2_id"></p>
                                            <p id="city_id"></p>
                                            <p id="state_id"></p>
                                            <p id="country_id"></p>
                                        </td>
                                    </tr>

                                    <tr>
                                        <th>{{trans('file.ZIP')}}</th>
                                        <td id="zip_id"></td>
                                    </tr>


                                </table>

                            </div>

                        </div>
                    </div>


                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">{{trans('file.Close')}}</button>
            </div>
        </div>
    </div> -->

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
                var table_table = $('#leaveType-table').DataTable({
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
                    url: "{{ route('leaveType.index') }}",
                },

                columns: [

                    {
                        data: 'id',
                        orderable: false,
                        searchable: false
                    },
                    {
                        data: 'leave_type',
                        name: 'leave_type',

                    },
                    {
                        data: 'allocated_day',
                        name: 'allocated_day',

                    },
                    {
                        data: 'max_carry_forward',
                        name: 'max_carry_forward',

                    },
                    {
                        data: 'description',
                        name: 'description',

                    },
                    {
                        data: 'carry_forward',
                        name: 'carry_forward',

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
                $('.modal-title').text('{{__('Add New Leave Type')}}');
                $('#action_button').val('{{trans("file.Add")}}');
                $('#action').val('{{trans("file.Add")}}');
                $('#store_logo').html('');
                $('#formModal').modal('show');
            });


            $('#sample_form').on('submit', function (event) {
                event.preventDefault();
                if ($('#action').val() == '{{trans('file.Add')}}') {
                    $.ajax({
                        url: "{{ route('leaveType.store') }}",
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
                                $('#leaveType-table').DataTable().ajax.reload(null, false);
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
                        url: "{{ route('leaveType.update') }}",
                        method: "POST",
                        data: new FormData(this),
                        contentType: false,
                        cache: false,
                        processData: false,
                        dataType: "json",
                        success: function (data) {
                            var html = '';
                            if (data.errors) {
                                html = '<div class="alert alert-danger">';
                                for (var count = 0; count < data.errors.length; count++) {
                                    toastr.error(data.errors[count]);
                                }
                                html += '</div>';
                            }
                            if (data.success) {
                                toastr.success(data.success);
                                $('#sample_form')[0].reset();
                                $('select').selectpicker('refresh');
                                $('#leaveType-table').DataTable().ajax.reload();
                            }
                            setTimeout(function() {
                                    $('#formModal').modal('hide');
                                }, 2000);
                            // $('#form_result').html(html).slideDown(300).delay(5000).slideUp(300);
                        }
                    });
                }
            });

            $('#formModal').on('hidden.bs.modal', function () {
                $('#sample_form')[0].reset();

            });


            $(document).on('click', '.edit', function () {
                var id = $(this).attr('id');
                $('#form_result').html('');

                var target = "{{ url('/organization/leaveType/edit')}}/" + id;

                $.ajax({
                    url: target,
                    dataType: "json",
                    success: function (html) {
                        $('#leave_type').val(html.data.leave_type);
                        $('#allocated_day').val(html.data.allocated_day);
                        $('#max_carry_forward').val(html.data.max_carry_forward);
                        $('#carry_forward').val(html.data.carry_forward);
                        $('#description').val(html.data.description);
                        $('#hidden_id').val(html.data.id);
                        $('.modal-title').text('{{trans('file.Edit')}}');
                        $('#action_button').val('{{trans('file.Edit')}}');
                        $('#action').val('{{trans('file.Edit')}}');
                        $('#formModal').modal('show');
                    }
                })
            });


            $(document).on('click', '.show_new', function () {
                var id = $(this).attr('id');
                $('#form_result').html('');
                var target = "{{ url('/organization/companies')}}/" + id;
                $.ajax({
                    url: target,
                    dataType: "json",
                    success: function (result) {
                        $('#company_name_id').html(result.data.company_name);
                        $('#company_type').html(result.data.company_type.type_name);
                        $('#trading_name_id').html(result.data.trading_name);
                        $('#registration_no_id').html(result.data.registration_no);
                        $('#contact_no_id').html(result.data.contact_no);
                        $('#email_id').html(result.data.email);
                        $('#website_id').html(result.data.website);
                        $('#tax_no_id').html(result.data.tax_no);
                        $('#address1_id').html(result.data.location.address1);
                        $('#address2_id').html(result.data.location.address2);
                        $('#city_id').html(result.data.location.city);
                        $('#state_id').html(result.data.location.state);
                        $('#country_id').html(result.data.location.country.name);
                        $('#zip_id').html(result.data.location.zip);
                        if (result.data.company_logo) {
                            $('#logo_id').html("<img src={{ URL::to('/public') }}/uploads/company_logo/" + result.data.company_logo + " width='70'  class='img-thumbnail' />");
                            $('#logo_id').append("<input type='hidden'  name='hidden_image' value='" + result.data.company_logo + "'  />");
                        }
                        $('#company_modal').modal('show');
                        $('.modal-title').text('{{__('Company Info')}}');
                    }
                });
            });

            let lid;

            $(document).on('click', '.delete', function () {
                lid = $(this).attr('id');
                $('#confirmModal').modal('show');
                $('.modal-title').text('{{__('DELETE Record')}}');
                $('#ok_button').text('{{trans('file.OK')}}');

            });


            $(document).on('click', '#bulk_delete', function () {
                let table = $('#leaveType-table').DataTable();
                let id = [];
                id = table.rows({selected: true}).ids().toArray();
                if (id.length > 0) {
                    if (confirm("Are you sure you want to delete the selected Leave Type?")) {
                        $.ajax({
                            url: '{{route('mass_delete_leaveType')}}',
                            method: 'POST',
                            data: {
                                divisionIdArray: id
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


            $('.close').on('click', function () {
                $('#sample_form')[0].reset();
                $('#store_logo').html('');
                $('#logo_id').html('');
                $('#leaveType-table').DataTable().ajax.reload();
                $('select').selectpicker('refresh');
            });

            $('#ok_button').on('click', function () {
                var target = "{{ url('/organization/leaveType/delete')}}/" + lid;
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
                        $('#leaveType-table').DataTable().ajax.reload();
                    }, 2000);
                    }
                })
            });

        })(jQuery);
    </script>
@endpush
