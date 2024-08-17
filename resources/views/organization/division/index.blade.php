@extends('layout.main')
@section('content')

    <section>
        <div class="container-fluid mb-3">
            @can('store-company')
                <button type="button" class="btn btn-info" name="create_record" id="create_record"><i class="fa fa-plus"></i> {{__('Add Division')}}</button>
            @endcan
            @can('delete-company')
                <button type="button" class="btn btn-danger" name="bulk_delete" id="bulk_delete"><i class="fa fa-minus-circle"></i> {{__('Bulk delete')}}</button>
            @endcan
        </div>


        <div class="table-responsive">
            <table id="division-table" class="table ">
                <thead>
                <tr>
                    <th class="not-exported"></th>
                    <th>Name</th>
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
                    <h5 id="exampleModalLabel" class="modal-title">{{__('Add Division')}}</h5>
                    <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="close"><i class="dripicons-cross"></i></button>
                </div>

                <div class="modal-body">
                    <span id="store_logo"></span>

                    <span id="form_result"></span>
                    <form method="post" id="sample_form" class="form-horizontal" enctype="multipart/form-data">

                        @csrf
                        <div class="row">
                            <div class="col-md-12 form-group">
                                <label>{{__('Name')}} *</label>
                                <input type="text" name="division_name" id="division_name" required class="form-control"
                                       placeholder="Name">
                            </div>


                            <div class="form-group" align="center">
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

    <div class="modal fade" id="company_modal" tabindex="-1" role="dialog" aria-labelledby="basicModal"
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
                var table_table = $('#division-table').DataTable({
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
                    url: "{{ route('division.index') }}",
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
                $('.modal-title').text('{{__('Add New Divison')}}');
                $('#action_button').val('{{trans("file.Add")}}');
                $('#action').val('{{trans("file.Add")}}');
                $('#store_logo').html('');
                $('#formModal').modal('show');
            });


            $('#sample_form').on('submit', function (event) {
                event.preventDefault();
                if ($('#action').val() == '{{trans('file.Add')}}') {
                    $.ajax({
                        url: "{{ route('division.store') }}",
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
                                html = '<div class="alert alert-danger">';
                                for (var count = 0; count < data.errors.length; count++) {
                                    html += '<p>' + data.errors[count] + '</p>';
                                }
                                html += '</div>';
                            }
                            if (data.success) {
                                html = '<div class="alert alert-success">' + data.success + '</div>';
                                $('#sample_form')[0].reset();
                                $('select').selectpicker('refresh');
                                $('#division-table').DataTable().ajax.reload(null, false);
                                setTimeout(function() {
                                    $('#formModal').modal('hide');
                                }, 2000); 
                            }
                            $('#form_result').html(html).slideDown(300).delay(5000).slideUp(300);
                        }
                    })
                }

                if ($('#action').val() == '{{trans('file.Edit')}}') {
                    $.ajax({
                        url: "{{ route('division.update') }}",
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
                                    html += '<p>' + data.errors[count] + '</p>';
                                }
                                html += '</div>';
                            }
                            if (data.success) {
                                html = '<div class="alert alert-success">' + data.success + '</div>';
                                $('#sample_form')[0].reset();
                                $('select').selectpicker('refresh');
                                $('#division-table').DataTable().ajax.reload();
                            }
                            setTimeout(function() {
                                    $('#formModal').modal('hide');
                                }, 2000);
                            $('#form_result').html(html).slideDown(300).delay(5000).slideUp(300);
                        }
                    });
                }
            });


            $(document).on('click', '.edit', function () {
                var id = $(this).attr('id');
                $('#form_result').html('');

                var target = "{{ url('/organization/division/edit')}}/" + id;

                $.ajax({
                    url: target,
                    dataType: "json",
                    success: function (html) {
                        $('#division_name').val(html.data.division_name);
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
                let table = $('#division-table').DataTable();
                let id = [];
                id = table.rows({selected: true}).ids().toArray();
                if (id.length > 0) {
                    if (confirm("Are you sure you want to delete the selected division?")) {
                        $.ajax({
                            url: '{{route('mass_delete_division')}}',
                            method: 'POST',
                            data: {
                                divisionIdArray: id
                            },
                            success: function (data) {
                                let html = '';
                                if (data.success) {
                                    html = '<div class="alert alert-success">' + data.success + '</div>';
                                }
                                if (data.error) {
                                    html = '<div class="alert alert-danger">' + data.error + '</div>';
                                }
                                table.ajax.reload();
                                table.rows('.selected').deselect();
                                if (data.errors) {
                                    html = '<div class="alert alert-danger">' + data.error + '</div>';
                                }
                                $('#general_result').html(html).slideDown(300).delay(5000).slideUp(300);
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
                $('#division-table').DataTable().ajax.reload();
                $('select').selectpicker('refresh');
            });

            $('#ok_button').on('click', function () {
                var target = "{{ url('/organization/division/delete')}}/" + lid;
                $.ajax({
                    url: target,
                    beforeSend: function () {
                        $('#ok_button').text('{{trans('file.Deleting...')}}');
                    },
                    success: function (data) {
                        console.log(data);

                        let html = '';
                        if (data.success) {
                            html = '<div class="alert alert-success">' + data.success + '</div>';
                        }
                        if (data.error) {
                            html = '<div class="alert alert-danger">' + data.error + '</div>';
                        }
                       setTimeout(function () {
                        $('#general_result').html(html).slideDown(300).delay(5000).slideUp(300);
                        $('#confirmModal').modal('hide');
                        $('#division-table').DataTable().ajax.reload();
                    }, 2000);
                    }
                })
            });

        })(jQuery);
    </script>
@endpush
