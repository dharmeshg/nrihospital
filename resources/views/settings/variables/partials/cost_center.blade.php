<div class="container-fluid">
    <div class="card mb-0">
        <div class="card-body">
            <h3 class="card-title">{{__('Add Cost Center')}}</h3>
            <form method="post" id="cost_center_form" class="form-horizontal" >
                @csrf
                <div class="input-group">
                    <input type="text" name="cost_center_name" class="form-control" placeholder="{{__('Cost Center')}}">
                    <input type="submit" id="cost_center_submit" class="btn btn-success" value={{trans("file.Save")}}>
                </div>
            </form>
        </div>
    </div>
</div>

<span class="cost_center_result"></span>
<div class="table-responsive">
    <table id="cost_center-table" class="table ">
        <thead>
        <tr>
            <th>{{__('Name')}}</th>
            <th class="not-exported">{{trans('file.Action')}}</th>
        </tr>
        </thead>

    </table>
</div>


<div id="costCenterEditModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">{{trans('file.Edit')}}</h5>

                <button type="button" data-dismiss="modal" id="cost_center_close" aria-label="Close" class="close"><span
                            aria-hidden="true">×</span>
                </button>
            </div>
            <span class="cost_center_result_edit"></span>

            <div class="modal-body">
                <form method="post" id="cost_center_form_edit" class="form-horizontal" enctype="multipart/form-data" >
                    @csrf
                    <div class="col-md-6 form-group">
                        <label>{{__('Cost Center')}} *</label>
                        <input type="text" name="cost_center_name_edit" id="cost_center_name_edit"  class="form-control" placeholder="{{__('Cost Center')}}">
                    </div>
                    <div class="col-md-4 form-group">
                        <input type="hidden" name="hidden_cost_center_id" id="hidden_cost_center_id" />
                        <input type="submit" name="cost_center_edit_submit" id="cost_center_edit_submit" class="btn btn-success" value={{trans("file.Edit")}} />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
