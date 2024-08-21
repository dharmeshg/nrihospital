<section>
   <span id="dependents_general_result"></span>
   <div class="container-fluid">
      @if(auth()->user()->can('store-details-employee') || auth()->user()->id == $employee->id)
      <button type="button" class="btn btn-info" name="create_record" id="create_dependents_record"><i
         class="fa fa-plus"></i>{{__('Add New')}}</button>
      @endif
   </div>
   <div class="table-responsive">
      <table id="dependents-table" class="table ">
         <thead>
            <tr>
               <th>{{__('Name')}}</th>
               <th>{{__('Relation')}}</th>
               <th>{{__('Gender')}}</th>
               <th>{{__('Date Of Birth')}}</th>
               <th class="not-exported">{{trans('file.action')}}</th>
            </tr>
         </thead>
      </table>
   </div> 
   <div id="DependentsformModal" class="modal fade" role="dialog">
      <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
            <div class="modal-header">
               <h5 id="exampleModalLabel" class="modal-title">{{__('Add New')}}</h5>
               <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="dependents-close"><i class="dripicons-cross"></i></button>
            </div>
            <div class="modal-body">
               <span id="dependents_form_result"></span>
               <form method="post" id="dependents_sample_form" class="form-horizontal" autocomplete="off">
                  @csrf
                  <div class="row">
                     <div class="col-md-6 form-group">
                        <label>{{trans('file.Name')}} <span class="text-danger">*</span></label>
                        <input type="text" name="name" id="dependent_name"
                           placeholder="{{trans('file.Name')}}"
                           required class="form-control">
                     </div>

                      <div class="col-md-6">
                            <div class="form-group">
                                <label>{{__('Gender')}} <span class="text-danger">*</span> </label>
                                <select name="gender" id="dependent_gender"
                                    class="form-control selectpicker"
                                    data-live-search="true"
                                    data-live-search-style="contains"
                                    title="{{__('Selecting',['key'=>trans('Gender')])}}...">
                                    <option value="Male">Male</option>
                                    <option value="Female">Female</option>
                                </select>
                            </div>
                        </div>
                     <div class="col-md-6 form-group">
                        <label>{{trans('file.Relation')}} <span class="text-danger">*</span> </label>
                        <select name="relation_type_id" required id="dependent_relation_type"
                        class="form-control selectpicker"
                        data-live-search="true" data-live-search-style="contains"
                        title='{{__('Selecting',['key'=>trans('file.Relation')])}}...'>
                        @foreach($relationTypes as $item)
                        <option value="{{$item->id}}">{{$item->type_name}}</option>
                        @endforeach
                        </select>
                     </div>
                     <div class="col-md-6 form-group">
                            <label>{{__('DOB')}} <span class="text-danger">*</span> </label>
                            <input type="text" name="date_of_birth" id="dependent_d_o_b"
                               autocomplete="off" class="form-control date">
                         </div>
                     <div class="col-md-6 form-group">
                        <label>{{__('Aadhar No')}} <span class="text-danger">*</span> </label>
                        <input type="text" name="aadhar_no" id="dependent_aadhar_no"
                           placeholder="{{__('Emergency Contact')}}"
                           required class="form-control mb-2">
                     </div>
                     <div class="col-md-6 form-group">
                        <label>{{__('Mediclaim No')}} <span class="text-danger">*</span> </label>
                        <input type="text" name="mediclaim_no" id="dependent_mediclaim_no"
                           placeholder="{{__('Present Address')}}"
                           required class="form-control mb-2">
                     </div>
                    <div class="col-md-6 form-group">
                        <div class=" form-check">
                            <input type="checkbox" name="pf_nominee" id="dependent_pf_nominee" class="form-check-input" value="Yes"/>
                            <label class="mr-4 form-check-label"><strong>{{ __('PF Nominee') }}</strong></label>
                        </div>
                    </div>
                  </div>
                  <div class="row">
                      <div class="col-md-6 form-group">
                        <label>{{__('PF(%)')}} <span class="text-danger">*</span> </label>
                        <input type="text" name="pf" id="dependent_pf"
                           placeholder=""
                           class="form-control mb-2">
                     </div>
                  </div>
                  <div class="container">
                        <div class="form-group" align="center">
                           <input type="hidden" name="action" id="dependents_action"/>
                           <input type="hidden" name="hidden_id" id="dependents_hidden_id"/>
                           <input type="submit" name="action_button" id="dependents_action_button"
                              class="btn btn-warning" value={{trans('file.Add')}} />
                        </div>
                     </div>
               </form>
            </div>
         </div>
      </div>
   </div>
   <div class="modal fade confirmModal" role="dialog" id="confirmModal">
      <div class="modal-dialog modal-dialog-centered">
         <div class="modal-content">
            <div class="modal-header">
               <h2 class="modal-title">{{trans('file.Confirmation')}}</h2>
               <button type="button" class="dependents-close" data-dismiss="modal">&times;</button>
            </div>
            <div class="modal-body">
               <h4 align="center" style="margin:0;">{{__('Are you sure you want to remove this data?')}}</h4>
            </div>
            <div class="modal-footer">
               <button type="button" name="ok_button"  class="btn btn-danger dependents-ok">{{trans('file.OK')}}</button>
               <button type="button" class="dependents-close btn-default" data-dismiss="modal">{{trans('file.Cancel')}}</button>
            </div>
         </div>
      </div>
   </div>
</section>