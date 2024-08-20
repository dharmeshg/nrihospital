$('#compentencies_type-table1').DataTable().clear().destroy();

var table_table = $('#compentencies_type-table1').DataTable({
    initComplete: function () {
        this.api().columns([1]).every(function () {
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
    url: "{{ route('compentencies.index') }}",

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

    'select': {style: 'multi', selector: 'td:first-child'},
    'lengthMenu': [[10, 25, 50, -1], [10, 25, 50, "All"]],

});
new $.fn.dataTable.FixedHeader(table_table);

$('#compentencies_type_submit1').on('click', function(event) {
    event.preventDefault();
    let title = $('input[name="compentencies_title"]').val();
    let type_id = $('#compentency_type_id').val();

    $.ajax({
        url: "{{ route('compentencies.store') }}",
        method: "POST",
        data: { title:title, type_id:type_id},
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
            $('#compentencies_type_form1')[0].reset();
            $("#compentency_type_id")[0].selectedIndex = 0;
            $('#compentency_type_id').text($("select[name=compentency_type_id] option[value='']").text());
            $('#compentencies_type-table1').DataTable().ajax.reload();
      
        }
        $('.compentencies_type_result1').html(html).slideDown(300).delay(5000).slideUp(300);

        }
    });

});

$(document).on('click', '.compenteny_type_edit1', function(){
    var id = $(this).attr('id');
    $('.compentencies_type_result').html('');

    var target = "{{ route('compentencies.index') }}/"+id+'/edit';
    $.ajax({
        url:target,     
        dataType:"json",
        success:function(html){
            $('#compentencies_type_edit1').val(html.data.title);
            $('#hidden_compentency_id1').val(html.data.id);
            $('#compentency_type_edit_id').selectpicker('destroy');
            $('#compentency_type_edit_id').selectpicker('val', html.data.competency_type_id);
            $('#compentency_type_edit_id').selectpicker('refresh');
            $('#compentencyEditModal1').modal('show');
        }
    })

});

$('#compentencies_type_edit_submit1').on('click', function(event) {
    event.preventDefault();
    let title_edit = $('input[name="compentencies_type_edit1"]').val();
    let compentency_type_edit_id = $('#compentency_type_edit_id').val();
    let hidden_compentency_id= $('#hidden_compentency_id1').val();

    $.ajax({
        url: "{{ route('compentencies.update') }}",
        method: "POST",
        data: { title_edit:title_edit,hidden_compentency_id:hidden_compentency_id},
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
                $('#compentencies_type_form_edit1')[0].reset();
                $('#compentencies_type-table1').DataTable().ajax.reload();
            }
            $('.compentency_result_edit1').html(html).slideDown(300).delay(3000).slideUp(300);
            setTimeout(function(){
                    $('#compentencyEditModal1').modal('hide')
            }, 5000);
        }
    });
});


$(document).on('click', '.compenteny_type_delete1', function() {
    let delete_id = $(this).attr('id');
    let target = "{{ route('compentencies.index') }}/" + delete_id + '/delete';
    if (confirm('{{__('Are You Sure you want to delete this data')}}')) {
        $.ajax({
        url: target,
        success: function (data) {
            var html = '';
            html = '<div class="alert alert-success">' + data.success + '</div>';
            setTimeout(function () {
                $('#compentencies_type-table1').DataTable().ajax.reload();
            }, 2000);
            $('.award_result').html(html).slideDown(300).delay(3000).slideUp(300);
        }
        })
    }

});

$('#compentencies_type_close1').on('click', function() {
    $('#compentencies_type_form1')[0].reset();
    $('#compentencies_type-table1').DataTable().ajax.reload();
});