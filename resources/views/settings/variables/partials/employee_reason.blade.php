<div class="container-fluid">
    <div class="card mb-0">
        <div class="card-body">
            <h3 class="card-title">{{__('Add Employee Reason')}}</h3>
            <form method="post" id="employee_reason_form" class="form-horizontal" >
                @csrf
                <div class="input-group">
                    <input type="text" name="employee_reason_title" class="form-control" placeholder="{{__('Employee Reason')}}">
                    <input type="submit" id="employee_reason_submit" class="btn btn-success" value={{trans("file.Save")}}>
                </div>
            </form>
        </div>
    </div>
</div>

<span class="employee_reason_result"></span>
<div class="table-responsive">
    <table id="employee_reason-table" class="table ">
        <thead>
        <tr>
            <th>{{__('Title')}}</th>
            <th class="not-exported">{{trans('file.Action')}}</th>
        </tr>
        </thead>

    </table>
</div>


<div id="employeeReasonEditModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">{{trans('file.Edit')}}</h5>

                <button type="button" data-dismiss="modal" id="employee_reason_close" aria-label="Close" class="close"><span
                            aria-hidden="true">×</span>
                </button>
            </div>
            <span class="employee_reason_result_edit"></span>

            <div class="modal-body">
                <form method="post" id="employee_reason_form_edit" class="form-horizontal" enctype="multipart/form-data" >
                    @csrf
                    <div class="col-md-6 form-group">
                        <label>{{__('Employee Reason')}} *</label>
                        <input type="text" name="employee_reason_title_edit" id="employee_reason_title_edit"  class="form-control" placeholder="{{__('Reason')}}">
                    </div>
                    <div class="col-md-4 form-group">
                        <input type="hidden" name="hidden_employee_reason_id" id="hidden_employee_reason_id" />
                        <input type="submit" name="employee_reason_edit_submit" id="employee_reason_edit_submit" class="btn btn-success" value={{trans("file.Edit")}} />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
