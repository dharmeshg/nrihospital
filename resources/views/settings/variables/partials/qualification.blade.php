<div class="container-fluid">
    <div class="card mb-0">
        <div class="card-body">
            <h3 class="card-title">{{__('Add Qualification')}}</h3>
            <form method="post" id="qualification_form" class="form-horizontal" >
                @csrf
                <div class="input-group">
                    <input type="text" name="qualification_name" class="form-control" placeholder="{{__('Qualification')}}">
                    <input type="submit" id="qualification_submit" class="btn btn-success" value={{trans("file.Save")}}>
                </div>
            </form>
        </div>
    </div>
</div>

<span class="qualification_result"></span>
<div class="table-responsive">
    <table id="qualification-table" class="table ">
        <thead>
        <tr>
            <th>{{__('Name')}}</th>
            <th class="not-exported">{{trans('file.Action')}}</th>
        </tr>
        </thead>

    </table>
</div>


<div id="qualificationsEditModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 class="modal-title">{{trans('file.Edit')}}</h5>

                <button type="button" data-dismiss="modal" id="qualification_close" aria-label="Close" class="close"><span
                            aria-hidden="true">×</span>
                </button>
            </div>
            <span class="qualification_result_edit"></span>

            <div class="modal-body">
                <form method="post" id="qualification_form_edit" class="form-horizontal" enctype="multipart/form-data" >
                    @csrf
                    <div class="col-md-6 form-group">
                        <label>{{__('qualification')}} *</label>
                        <input type="text" name="qualification_name_edit" id="qualification_name_edit"  class="form-control" placeholder="{{__('Qualification')}}">
                    </div>
                    <div class="col-md-4 form-group">
                        <input type="hidden" name="hidden_qualification_id" id="hidden_qualification_id" />
                        <input type="submit" name="qualification_edit_submit" id="qualification_edit_submit" class="btn btn-success" value={{trans("file.Edit")}} />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
