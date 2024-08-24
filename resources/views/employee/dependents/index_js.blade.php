
    $('#dependents-table').DataTable().clear().destroy();


    var table_table = $('#dependents-table').DataTable({
        initComplete: function () {
            this.api().columns([0]).every(function () {
                var column = this;
                var select = $('<select><option value=""></option></select>')
                    .appendTo($(column.footer()).empty())
                    .on('change', function () {
                        var val = $.fn.dataTable.util.escapeRegex(
                            $(this).val()
                        );

                        column
                            .search(val ? '^' + val + '$' : '', true, false)
                            .draw();
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
            url: "{{ route('dependents.show',$employee->id) }}",
        },

        columns: [
            {
                data: 'name',
                name: 'name',
            },
            {
                data: 'relation',
                name: 'relation',
            },

            {
                data: 'gender',
                name: 'gender',
            },
            {
                data: 'date_of_birth',
                name: 'date_of_birth',
            },
            {
                data: 'action',
                name: 'action',
                orderable: false
            }
        ],


        "order": [],
        'language': {
            'lengthMenu': '_MENU_ {{__('records per page')}}',
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
                'targets': [0, 4],
            },
        ],


        'select': {style: 'multi', selector: 'td:first-child'},
        'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "All"]],
    });
    new $.fn.dataTable.FixedHeader(table_table);


    $('#create_dependents_record').click(function () {

        $('.modal-title').text("Add New dependents");
        $('#dependents_action_button').val('{{trans('file.Add')}}');
        $('#dependents_action').val('{{trans('file.Add')}}');
        $('#DependentsformModal').modal('show');
    });

    $('#dependents_sample_form').on('submit', function (event) {
        event.preventDefault();
        if ($('#dependents_action').val() == '{{trans('file.Add')}}') {

            $.ajax({
                url: "{{ route('dependents.store',$employee->id) }}",
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

                        setTimeout(function () {
                            $('#DependentsformModal').modal('hide');
                            $('#dependents_sample_form')[0].reset();
                            $('select').selectpicker('refresh');
                            $('#dependents-table').DataTable().ajax.reload();
                        }, 2000);
                    }
                    $('#dependents_form_result').html(html).slideDown(300).delay(5000).slideUp(300);
                }

            });
        }

        if ($('#dependents_action').val() == '{{trans('file.Edit')}}') {
            $.ajax({
                url: "{{ route('dependents.update') }}",
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
                    if (data.error) {
                        html = '<div class="alert alert-danger">' + data.error + '</div>';
                    }

                    if (data.success) {
                        html = '<div class="alert alert-success">' + data.success + '</div>';
                        setTimeout(function () {
                            $('#DependentsformModal').modal('hide');
                            $('select').selectpicker('refresh');
                            $('#dependents-table').DataTable().ajax.reload();
                            $('#dependents_sample_form')[0].reset();
                        }, 2000);

                    }
                    $('#dependents_form_result').html(html).slideDown(300).delay(5000).slideUp(300);
                }
            });
        }
    });

    function toggleStatusField() {
        var status = $('input[name="pf_nominee"]:checked').val();
        if (status === 'Yes') {
            $('#hidden_pf_field').show();
        } else {
            $('#hidden_pf_field').hide();
            $('input[name="pf"]').val('');
        }
    }
    $(document).on('click', '.dependents_edit', function () {

        var id = $(this).attr('id');

        var target = "{{ route('dependents.index') }}/" + id + '/edit';


        $.ajax({
            url: target,
            dataType: "json",
            success: function (html) {

                let id = html.data.id;

                $('#dependent_name').val(html.data.name);
                $('#dependent_d_o_b').val(html.data.date_of_birth);
                $('#dependent_aadhar_no').val(html.data.aadhar_no);
                $('#dependent_mediclaim_no').val(html.data.mediclaim_no);
                $('#dependent_pf').val(html.data.pf);

                if (html.data.pf_nominee == 'Yes') {
                    $('#dependent_pf_nominee').prop('checked', true);
                } else {
                    $('#dependent_pf_nominee').prop('checked', false);
                }

                $('#dependent_relation_type').selectpicker('val', html.data.relation_type_id);
                $('#dependent_gender').selectpicker('val', html.data.gender);


                $('#dependents_hidden_id').val(html.data.id);
                $('.modal-title').text('{{trans('file.Edit')}}');
                $('#dependents_action_button').val('{{trans('file.Edit')}}');
                $('#dependents_action').val('{{trans('file.Edit')}}');
                $('#DependentsformModal').modal('show');
                toggleStatusField();
            }
        })
    });

    $('input[name="pf_nominee"]').change(function () {
        toggleStatusField();
    });
    $(document).ready(function () {
        toggleStatusField(); 
    });

    let dependents_delete_id;

    $(document).on('click', '.dependents_delete', function () {
    dependents_delete_id = $(this).attr('id');
        $('#confirmModalDependents').modal('show');
        $('.modal-title').text('{{__('DELETE Record')}}');
        $('.dependents-ok').text('{{trans('file.OK')}}');
    });


    $('.dependents-close').click(function () {
        $('#dependents_sample_form')[0].reset();
        $('select').selectpicker('refresh');
    $('#confirmModalDependents').modal('hide');
        $('#dependents-table').DataTable().ajax.reload();
    });

    $('.dependents-ok').click(function () {
        let target = "{{ route('dependents.index') }}/" + dependents_delete_id + '/delete';
        $.ajax({
            url: target,
            beforeSend: function () {
                $('.dependents-ok').text('{{trans('file.Deleting...')}}');
            },
            success: function (data) {
                setTimeout(function () {
                    $('#confirmModalDependents').modal('hide');
                    $('#dependents-table').DataTable().ajax.reload();
                }, 2000);
            }
        })
    });

