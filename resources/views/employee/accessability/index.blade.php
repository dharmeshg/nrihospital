<span id="accessability_form_result"></span>
  <form method="post" id="accessability_sample_form" class="form-horizontal" action="{{route('accessability.update',$employee->id)}}">
   @csrf
   <div class="row">
      <div class="col-md-3 form-group">
         <div class="mt-4 form-check">
            <input type="checkbox" name="access_ot" class="form-check-input" value="Yes" />
             <input type="checkbox" name="access_ot" class="form-check-input" value="Yes" {{ $employee->access_ot == 'Yes' ? 'checked' : '' }} />
            <label class="mr-4 form-check-label"><strong>{{__('OT')}}</strong></label>
         </div>
      </div>
      <div class="col-md-3 form-group">
         <div class="mt-4 form-check">
            <input type="checkbox" name="access_coff" class="form-check-input" value="Yes" {{ $employee->access_coff == 'Yes' ? 'checked' : '' }} />
            <label class="mr-4 form-check-label"><strong>{{__('COFF')}}</strong></label>
         </div>
      </div>
      <div class="col-md-3 form-group">
         <div class="mt-4 form-check">
             <input type="checkbox" name="access_pf" class="form-check-input" value="Yes" {{ $employee->access_pf == 'Yes' ? 'checked' : '' }} />
            <label class="mr-4 form-check-label"><strong>{{__('PF')}}</strong></label>
         </div>
      </div>
      <div class="col-md-3 form-group">
         <div class="mt-4 form-check">
            <input type="checkbox" name="access_esi" class="form-check-input" value="Yes" {{ $employee->access_esi == 'Yes' ? 'checked' : '' }} />
            <label class="mr-4 form-check-label"><strong>{{__('ESI')}}</strong></label>
         </div>
      </div>
      <div class="col-md-3 form-group">
         <div class="mt-4 form-check">
            <input type="checkbox" name="access_manual_attendance" class="form-check-input" value="Yes" {{ $employee->access_manual_attendance == 'Yes' ? 'checked' : '' }} />
            <label class="mr-4 form-check-label"><strong>{{__('Manual Attendance')}}</strong></label>
         </div>
      </div>
       <div class="col-md-3 form-group">
         <div class="mt-4 form-check">
            <input type="checkbox" name="access_leaves" class="form-check-input" value="Yes" {{ $employee->access_leaves == 'Yes' ? 'checked' : '' }} />
            <label class="mr-4 form-check-label"><strong>{{__('Leaves')}}</strong></label>
         </div>
      </div>
       <div class="col-md-3 form-group">
         <div class="mt-4 form-check">
            <input type="checkbox" name="access_sms" class="form-check-input" value="Yes" {{ $employee->access_sms == 'Yes' ? 'checked' : '' }} />
            <label class="mr-4 form-check-label"><strong>{{__('Sms')}}</strong></label>
         </div>
      </div>
      </div>
       <div class="row">
         <div class="col-md-3 form-group">
            <div class="mt-4 form-check">
               <input type="radio" name="access_shift" class="form-check-input" value="Auto Shift" {{ $employee->access_shift == 'Auto Shift' ? 'checked' : '' }} />
             
               <label class="mr-4 form-check-label"><strong>{{ __('Auto Shift') }}</strong></label>
            </div>
         </div>
         <div class="col-md-3 form-group">
            <div class="mt-4 form-check">
               <input type="radio" name="access_shift" class="form-check-input" value="Shift" {{ $employee->access_shift == 'Shift' ? 'checked' : '' }} />
               <label class="mr-4 form-check-label"><strong> 
                   <select class="form-control selectpicker" data-live-search="true" data-live-search-style="contains" name="access_shift_details" title="{{__('Selecting',['key'=>trans('Shift')])}}...">
                     @foreach($shift as $val)
                     <option value="{{ $val->id }}" {{ $employee->access_shift_details == $val->id ? 'selected' : '' }}>
                        {{ $val->shift_name }}
                    </option>
                     @endforeach
                  </select>
               </strong>
            </label>
            </div>
         </div>
         <div class="col-md-3 form-group">
            <div class="mt-4 form-check">
               <input type="radio" name="access_shift" class="form-check-input" value="Roaster Based" {{ $employee->access_shift == 'Roaster Based' ? 'checked' : '' }} />
               <label class="mr-4 form-check-label"><strong>{{ __('Roaster Based') }}</strong></label>
            </div>
         </div>
      </div>
      <div class="row mt-3"> 
      <div class="form-group row">
         <div class="form-group row mb-0">
            <div class="col-md-6 offset-md-4">
               <button type="submit" class="btn btn-primary">
               {{trans('file.Save')}}
               </button>
            </div>
         </div>
      </div>
      </div>
</form> 
@push('scripts')
<script type="text/javascript">


   (function($) {
       "use strict";
   
   $(document).ready(function () {
       
    $('input[name="access_shift"]').change(function () {
        if ($(this).val() !== 'Shift') {
            // Clear the dropdown value if "Shift" is not selected
            $('select[name="access_shift_details"]').val('').trigger('change');
        }
    });

    // Listen for changes on the dropdown
    $('select[name="access_shift_details"]').change(function () {
        // Check if a value is selected
        if ($(this).val() !== '') {
            // Automatically check the "Shift" radio button
            $('input[name="access_shift"][value="Shift"]').prop('checked', true);
        }
    });

       $(".alert").slideDown(300).delay(5000).slideUp(300);
   });
   
   var form = $('#accessability_sample_form');
   
   
   form.submit(function (event) {
       event.preventDefault();
       $.ajax({
           type: form.attr('method'),
           url: form.attr('action'),
           data: form.serialize(),
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
               }
               $('#accessability_form_result').html(html);
   
           }
       });
   });
   
   })(jQuery);
</script>
@endpush