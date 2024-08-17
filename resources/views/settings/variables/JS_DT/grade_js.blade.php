$('#grade-table').DataTable().clear().destroy();

var table_table = $('#grade-table').DataTable({
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
        url: "{{ route('grade.index') }}",
    },
    columns: [
        {
            data: 'name',
            name: 'name',
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



$('#grade_submit').on('click', function (event) {
    event.preventDefault();
    let Gradename = $('input[name="grade_name"]').val();

    $.ajax({
        url: "{{ route('grade.store') }}",
        method: "POST",
        data: { name: Gradename },
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
                $('#grade_form')[0].reset();
                $('#grade-table').DataTable().ajax.reload();
            }
            $('.grade_result').html(html).slideDown(300).delay(5000).slideUp(300);

        }
    });

});


$(document).on('click', '.grade_edit', function () {
    var id = $(this).attr('id');
    $('.grade_result').html('');
    var target = "{{ route('grade.index') }}/" + id + '/edit';
    $.ajax({
        url: target,
        dataType: "json",
        success: function (html) {
            console.log(html);
            $('input[name="grade_name_edit"]').val(html.data.name);
            $('#hidden_grade_id').val(html.data.id);
            $('#gradesEditModal').modal('show');
        }
    });
});


$('#grade_edit_submit').on('click', function (event) {
    event.preventDefault();
    let grade_name_edit = $('input[name="grade_name_edit"]').val();
    let hidden_grade_id = $('#hidden_grade_id').val();
    $.ajax({
        url: "{{ route('grade.update') }}",
        method: "POST",
        data: { name: grade_name_edit, hidden_grade_id: hidden_grade_id },
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
                $('#grade_form_edit')[0].reset();
                $('#gradesEditModal').modal('hide');
                $('#grade-table').DataTable().ajax.reload();
            }
            $('.grade_result_edit').html(html).slideDown(300).delay(3000).slideUp(300);
            setTimeout(function () {
                $('#gradesEditModal').modal('hide')
            }, 5000);
        }
    });
});



$(document).on('click', '.grade_delete', function () {
    let delete_id = $(this).attr('id');
    let target = "{{ route('grade.index') }}/" + delete_id + '/delete';
    if (confirm('{{__('Are You Sure you want to delete this data')}}')) {
        $.ajax({
            url: target,
            success: function (data) {
                var html = '';
                html = '<div class="alert alert-success">' + data.success + '</div>';
                setTimeout(function () {
                    $('#grade-table').DataTable().ajax.reload();
                }, 2000);
                $('.grade_result').html(html).slideDown(300).delay(3000).slideUp(300);
            }
        })
    }

});

$('#grade_close').on('click', function () {
    $('#grade_form')[0].reset();
    $('#grade-table').DataTable().ajax.reload();
});
