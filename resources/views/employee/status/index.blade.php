<span id="status_form_result"></span>
<form method="post" id="emp_status_form" class="form-horizontal" action="{{route('employees_status.update',$employee->id)}}">
   @csrf

      <div class="row">
          <div class="col-md-3 form-group">
                <div class="mt-4 form-check">
                    <input type="radio" name="emp_status_is_active" class="form-check-input" value="Active"
                        {{ $employee->emp_status_is_active == 'Active' ? 'checked' : '' }} />
                    <label class="mr-4 form-check-label"><strong>{{ __('Active') }}</strong></label>
                </div>
            </div>
            <div class="col-md-3 form-group">
                <div class="mt-4 form-check">
                    <input type="radio" name="emp_status_is_active" class="form-check-input" value="In-Active"
                        {{ $employee->emp_status_is_active == 'In-Active' ? 'checked' : '' }} />
                    <label class="mr-4 form-check-label"><strong>{{ __('In-Active') }}</strong></label>
                </div>
            </div>
      </div>
      <div class="row mt-4" id="hideStatusField" style="display: none;">
         <div class="col-md-4 form-group">
             <label>{{__('Date Of Relieving')}} <span class="text-danger">*</span> </label>
             <input type="text" name="date_of_relieving" id=""
                autocomplete="off" class="form-control date"
                value="{{$employee->date_of_relieving }}">
          </div>
          <div class="col-md-4 form-group">
               <label>{{__('Status')}}</label>
                 <select name="emp_status_id" id="emp_status_id"
                     class="form-control selectpicker"
                     data-live-search="true"
                     data-live-search-style="contains"
                     title="{{__('Selecting',['key'=>trans('Status')])}}...">
                      @foreach($statuses as $val)
                       <option value="{{$val->id}}" {{ ($employee->emp_status_id == $val->id) ? "selected" : '' }}>{{$val->status_title}}</option>
                     @endforeach
               </select>
         </div>
         <div class="col-md-4 form-group">
            <label>{{__('Reason')}}</label>
                 <select name="emp_reason_id" id="emp_reason_id"
                   class="form-control selectpicker"
                   data-live-search="true"
                   data-live-search-style="contains"
                   title="{{__('Selecting',['key'=>trans('Reason')])}}...">
                   @foreach($employee_reason as $val)
                   <option value="{{$val->id}}" {{ ($employee->emp_reason_id == $val->id) ? "selected" : '' }}>{{$val->title}}</option>
                   @endforeach
            </select>
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
     $(document).ready(function () {
            // Function to toggle visibility based on the selected radio button
            function toggleStatusField() {
                var status = $('input[name="emp_status_is_active"]:checked').val();
                if (status === 'In-Active') {
                    $('#hideStatusField').show();
                } else {
                    $('#hideStatusField').hide();
                    $('input[name="date_of_relieving"]').val('');
                    $('#emp_status_id').val('').selectpicker('refresh');
                    $('#emp_reason_id').val('').selectpicker('refresh');
                }
            }

            // Initialize the visibility on page load
            toggleStatusField();

            // Listen for changes on the radio buttons
            $('input[name="emp_status_is_active"]').change(function () {
                toggleStatusField();
            });
        });
   (function($) {
       "use strict";

   $(document).ready(function () {
       $(".alert").slideDown(300).delay(5000).slideUp(300);
   });
   
   var form = $('#emp_status_form');
   
   
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
               $('#status_form_result').html(html);
   
           }
       });
   });
   
   })(jQuery);
</script>
@endpush