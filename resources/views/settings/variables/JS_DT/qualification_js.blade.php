$('#qualification-table').DataTable().clear().destroy();

var table_table = $('#qualification-table').DataTable({
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
        url: "{{ route('qualification.index') }}",
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



$('#qualification_submit').on('click', function (event) {
    event.preventDefault();
    let qualificationname = $('input[name="qualification_name"]').val();

    $.ajax({
        url: "{{ route('qualification.store') }}",
        method: "POST",
        data: { name: qualificationname },
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
                $('#qualification_form')[0].reset();
                $('#qualification-table').DataTable().ajax.reload();
            }
            $('.qualification_result').html(html).slideDown(300).delay(5000).slideUp(300);

        }
    });

});


$(document).on('click', '.qualification_edit', function () {
    var id = $(this).attr('id');
    $('.qualification_result').html('');
    var target = "{{ route('qualification.index') }}/" + id + '/edit';
    $.ajax({
        url: target,
        dataType: "json",
        success: function (html) {
            console.log(html);
            $('input[name="qualification_name_edit"]').val(html.data.name);
            $('#hidden_qualification_id').val(html.data.id);
            $('#qualificationsEditModal').modal('show');
        }
    });
});


$('#qualification_edit_submit').on('click', function (event) {
    event.preventDefault();
    let qualification_name_edit = $('input[name="qualification_name_edit"]').val();
    let hidden_qualification_id = $('#hidden_qualification_id').val();
    $.ajax({
        url: "{{ route('qualification.update') }}",
        method: "POST",
        data: { name: qualification_name_edit, hidden_qualification_id: hidden_qualification_id },
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
                $('#qualification_form_edit')[0].reset();
                $('#qualificationsEditModal').modal('hide');
                $('#qualification-table').DataTable().ajax.reload();
            }
            $('.qualification_result_edit').html(html).slideDown(300).delay(3000).slideUp(300);
            setTimeout(function () {
                $('#qualificationsEditModal').modal('hide')
            }, 5000);
        }
    });
});



$(document).on('click', '.qualification_delete', function () {
    let delete_id = $(this).attr('id');
    let target = "{{ route('qualification.index') }}/" + delete_id + '/delete';
    if (confirm('{{__('Are You Sure you want to delete this data')}}')) {
        $.ajax({
            url: target,
            success: function (data) {
                var html = '';
                html = '<div class="alert alert-success">' + data.success + '</div>';
                setTimeout(function () {
                    $('#qualification-table').DataTable().ajax.reload();
                }, 2000);
                $('.qualification_result').html(html).slideDown(300).delay(3000).slideUp(300);
            }
        })
    }

});

$('#qualification_close').on('click', function () {
    $('#qualification_form')[0].reset();
    $('#qualification-table').DataTable().ajax.reload();
});
