$('#employee_reason-table').DataTable().clear().destroy();

var table_table = $('#employee_reason-table').DataTable({
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
        url: "{{ route('employee_reason.index') }}",
    },
    columns: [
        {
            data: 'title',
            name: 'title',
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
            'targets': [0, 1],
        },

    ],


    'select': { style: 'multi', selector: 'td:first-child' },
    'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "All"]],

});
new $.fn.dataTable.FixedHeader(table_table);



$('#employee_reason_submit').on('click', function (event) {
    event.preventDefault();
    let employeeReasonTitle = $('input[name="employee_reason_title"]').val();

    $.ajax({
        url: "{{ route('employee_reason.store') }}",
        method: "POST",
        data: { title: employeeReasonTitle },
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
                $('#employee_reason_form')[0].reset();
                $('#employee_reason-table').DataTable().ajax.reload();
            }
            $('.employee_reason_result').html(html).slideDown(300).delay(5000).slideUp(300);

        }
    });

});


$(document).on('click', '.employee_reason_edit', function () {
    var id = $(this).attr('id');
    $('.employee_reason_result').html('');
    var target = "{{ route('employee_reason.index') }}/" + id + '/edit';
    $.ajax({
        url: target,
        dataType: "json",
        success: function (html) {
            console.log(html);
            $('input[name="employee_reason_title_edit"]').val(html.data.title);
            $('#hidden_employee_reason_id').val(html.data.id);
            $('#employeeReasonEditModal').modal('show');
        }
    });
});


$('#employee_reason_edit_submit').on('click', function (event) {
    event.preventDefault();
    let employee_reason_title_edit = $('input[name="employee_reason_title_edit"]').val();
    let hidden_employee_reason_id = $('#hidden_employee_reason_id').val();
    $.ajax({
        url: "{{ route('employee_reason.update') }}",
        method: "POST",
        data: { title: employee_reason_title_edit, hidden_employee_reason_id: hidden_employee_reason_id },
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
                $('#employee_reason_form_edit')[0].reset();
                <!-- $('#employeeReasonEditModal').modal('hide'); -->
                $('#employee_reason-table').DataTable().ajax.reload();
            }
            $('.employee_reason_result_edit').html(html).slideDown(300).delay(3000).slideUp(300);
            setTimeout(function () {
                $('#employeeReasonEditModal').modal('hide')
            }, 2000);
        }
    });
});



$(document).on('click', '.employee_reason_delete', function () {
    let delete_id = $(this).attr('id');
    let target = "{{ route('employee_reason.index') }}/" + delete_id + '/delete';
    if (confirm('{{__('Are You Sure you want to delete this data')}}')) {
        $.ajax({
            url: target,
            success: function (data) {
                var html = '';
                html = '<div class="alert alert-success">' + data.success + '</div>';
                setTimeout(function () {
                    $('#employee_reason-table').DataTable().ajax.reload();
                }, 2000);
                $('.employee_reason_result').html(html).slideDown(300).delay(3000).slideUp(300);
            }
        })
    }

});

$('#employee_reason_close').on('click', function () {
    $('#employee_reason_form')[0].reset();
    $('#employee_reason-table').DataTable().ajax.reload();
});
