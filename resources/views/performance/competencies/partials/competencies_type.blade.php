<div class="container-fluid">
    <div class="card mb-0">
        <div class="card-body">           
            <h3 class="card-title">{{__('Add Compentencies Type')}}</h3>
            <form method="post" id="compentencies_type_form" class="form-horizontal" >
                @csrf
                <div class="input-group">
                    <input type="text" name="title" id="title"  class="form-control"
                           placeholder="{{__('Compentencies Type')}}">

                    <input type="submit" name="compentencies_type_submit" id="compentencies_type_submit" class="btn btn-success" value={{trans("file.Save")}}>
                </div>
            </form>
        </div>
    </div>
</div>

<span class="compentencies_type_result"></span>
<div class="table-responsive">
    <table id="compentencies_type-table" class="table ">
        <thead>
        <tr>
            <th>{{__('Award name')}}</th>
            <th class="not-exported">{{trans('file.action')}}</th>
        </tr>
        </thead>

    </table>
</div>


<div id="compentencyEditModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 id="compentencytypeModalLabel" class="modal-title">{{trans('file.Edit')}}</h5>

                <button type="button" data-dismiss="modal" id="compentency_close" aria-label="Close" class="close"><span
                            aria-hidden="true">×</span></button>
            </div>
            <span class="compentency_result_edit"></span>

            <div class="modal-body">
                <form method="post" id="compentency_type_type_form_edit" class="form-horizontal" enctype="multipart/form-data" >

                    @csrf
                    <div class="col-md-4 form-group">
                        <label>{{__('Compentencies Type')}} *</label>
                        <input type="text" name="compentencies_type_edit" id="compentencies_type_edit"  class="form-control"
                               placeholder="{{__('Compentencies Type')}}">
                    </div>
                    <div class="col-md-4 form-group">
                        <input type="hidden" name="hidden_compentency_id" id="hidden_compentency_id" />
                        <input type="submit" name="compentencies_type_edit_submit" id="compentencies_type_edit_submit" class="btn btn-success" value={{trans("file.Edit")}} />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>