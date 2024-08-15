<!--Edit Modal -->
<div class="modal fade" id="EditformModal" tabindex="-1" role="dialog" aria-labelledby="createModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="createModalLabel"><b>@lang('file.Edit Indicator')</b></h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body" id="edit-body">

          <form action="" method="POST" id="updatetForm">
            @csrf
            <input type="hidden" name="indicator_id" id="indicatorHiddenIdEdit">

            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label"><b>@lang('file.Company')</b></label>
                <div class="col-sm-6">
                    <select name="company_id" id="companyIdEdit" class="form-control selectpicker dynamic" data-live-search="true" data-live-search-style="contains"
                        data-dependent="designation_name" title='{{__('Selecting',['key'=>trans('file.Company')])}}...'>
                        @foreach ($companies as $company)
                            <option value="{{$company->id}}">{{$company->company_name}}</option>
                        @endforeach
                    </select>
                </div>
            </div>

            <div class="form-group row">
                <label for="inputEmail3" class="col-sm-2 col-form-label"><b>@lang('file.Designation')</b></label>
                <div class="col-sm-6" id="designation-selection">
                    <select name="designation_id" id="designationIdEdit" class="form-control selectpicker" data-live-search="true" data-live-search-style="contains"
                    title='{{__('Selecting',['key'=>trans('file.Designation')])}}...'>
                    </select>
                </div>
            </div>
            <br>
            @if($compentency_type)
                @foreach($compentency_type as $ky=>$vl)
                    @if($vl->compentencies->count() > 0)
                        <div class="form-group row">
                            <div class="col-md-12">
                                <h5><b>{{ $vl->title ? $vl->title : ''}}</b></h5>
                            </div>
                        
                            @foreach($vl->compentencies as $vlk => $vlkvl)
                                <div class="col-md-6">
                                    <label for="inputEmail3" class="col-form-label"><b>{{ $vlkvl->title ? $vlkvl->title : ''}}</b></label>
                                    <select name="competency_{{$vlkvl->id}}" id="customerExperience"
                                            class="form-control selectpicker dynamic" data-live-search="true"
                                            data-live-search-style="contains">
                                            <option value="None" selected>None</option>
                                            <option value="Beginner">Beginner</option>
                                            <option value="Intermidiate">Intermidiate</option>
                                            <option value="Advanced">Advanced</option>
                                            <option value="Expert/Leader">Expert/Leader</option>
                                    </select>
                                </div>
                            @endforeach
                        </div>
                    @endif
                @endforeach
            @endif

        </form>


        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="update-button">@lang('file.Update')</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">@lang('file.Close')</button>
        </div>
      </div>
    </div>
  </div>

@push('scriptsnew')
  <script>

    $('#companyIdEdit').change(function() {
            var companyIdEdit = $(this).val();
            if (companyIdEdit){
                $.get("{{route('performance.indicator.get-designation-by-company')}}",{company_id:companyIdEdit}, function (data) {
                    // $('#designationId').empty().html(data);

                    let all_designations = '';
                    $.each(data.designations, function (index, value) {
                        all_designations += '<option value=' + value['id'] + '>' + value['designation_name'] + '</option>';
                    });
                    $('#designationIdEdit').selectpicker('refresh');
                    $('#designationIdEdit').empty().append(all_designations);
                    $('#designationIdEdit').selectpicker('refresh');
                });
            }else{
                $('#designationIdEdit').empty().html('<option>--Select --</option>');
            }
        });
</script>
@endpush