<div class="container-fluid">
    <div class="card mb-0">
        <div class="card-body">           
            <h3 class="card-title">{{__('Add Compentencies Type')}}</h3>
            <form method="post" id="compentencies_type_form1" class="form-horizontal" >
                @csrf
                <div class="input-group">
                    <input type="text" name="compentencies_title" id="title1" class="form-control"
                           placeholder="{{__('Compentencies Type')}}">

                        <select class="form-control" name="compentency_type_id" id="compentency_type_id">
                           @if($compentency)
                                <option value="">--Select Compentency Type--</option>
                                @foreach($compentency as $cmp => $cmpvl)
                                    <option value="{{$cmpvl->id}}">{{$cmpvl->title}}</option>
                                @endforeach
                           @endif
                        </select>
                    
                    <input type="submit" name="compentencies_type_submit" id="compentencies_type_submit1" class="btn btn-success" value={{trans("file.Save")}}>
                </div>
            </form>
        </div>
    </div>
</div>

<span class="compentencies_type_result1"></span>
<div class="table-responsive">
    <table id="compentencies_type-table1" class="table ">
        <thead>
        <tr>
            <th>{{__('Compentencies Type')}}</th>
            <th class="not-exported">{{trans('file.action')}}</th>
        </tr>
        </thead>

    </table>
</div>


<div id="compentencyEditModal1" class="modal fade" role="dialog">
    <div class="modal-dialog modal-dialog-centered">
        <div class="modal-content">

            <div class="modal-header">
                <h5 id="compentencytypeModalLabel1" class="modal-title">{{trans('file.Edit')}}</h5>

                <button type="button" data-dismiss="modal" id="compentency_close1" aria-label="Close" class="close"><span
                            aria-hidden="true">×</span></button>
            </div>
            <span class="compentency_result_edit1"></span>

            <div class="modal-body">
                <form method="post" id="compentencies_type_form_edit1" class="form-horizontal" enctype="multipart/form-data" >

                    @csrf
                    <div class="col-md-6 form-group">
                        <label>{{__('Compentencies Type')}} *</label>
                        <input type="text" name="compentencies_type_edit1" id="compentencies_type_edit1"  class="form-control"
                               placeholder="{{__('Compentencies Type')}}">
                    </div>

                    <div class="col-md-6 form-group">
                        <select class="form-control" name="compentency_type_edit_id" id="compentency_type_edit_id">
                           @if($compentency)
                                <option value="">--Select Compentency Type--</option>
                                @foreach($compentency as $cmp => $cmpvl)
                                    <option value="{{$cmpvl->id}}">{{$cmpvl->title}}</option>
                                @endforeach
                           @endif
                        </select>
                    </div>
                    <div class="col-md-4 form-group">
                        <input type="hidden" name="hidden_compentency_id" id="hidden_compentency_id1" />
                        <input type="submit" name="compentencies_type_edit_submit" id="compentencies_type_edit_submit1" class="btn btn-success" value={{trans("file.Edit")}} />
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>