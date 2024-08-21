<span id="profile_form_result"></span>
<form method="post" id="social_sample_form" class="form-horizontal" action="{{route('social_profile.store',$employee->id)}}">
   @csrf
   <div class="row">
      <div class="col-md-3 form-group">
         <div class="mt-4 form-check">
            <input type="checkbox" name="rtl_layout" class="form-check-input" value="1" />
            <label class="mr-4 form-check-label"><strong>{{__('OT')}}</strong></label>
         </div>
      </div>
      <div class="col-md-3 form-group">
         <div class="mt-4 form-check">
            <input type="checkbox" name="rtl_layout" class="form-check-input" value="1" />
            <label class="mr-4 form-check-label"><strong>{{__('COFF')}}</strong></label>
         </div>
      </div>
      <div class="col-md-3 form-group">
         <div class="mt-4 form-check">
            <input type="checkbox" name="rtl_layout" class="form-check-input" value="1" />
            <label class="mr-4 form-check-label"><strong>{{__('PF')}}</strong></label>
         </div>
      </div>
      <div class="col-md-3 form-group">
         <div class="mt-4 form-check">
            <input type="checkbox" name="rtl_layout" class="form-check-input" value="1" />
            <label class="mr-4 form-check-label"><strong>{{__('ESI')}}</strong></label>
         </div>
      </div>
      <div class="col-md-3 form-group">
         <div class="mt-4 form-check">
            <input type="checkbox" name="rtl_layout" class="form-check-input" value="1" />
            <label class="mr-4 form-check-label"><strong>{{__('Manual Attendance')}}</strong></label>
         </div>
      </div>
       <div class="col-md-3 form-group">
         <div class="mt-4 form-check">
            <input type="checkbox" name="rtl_layout" class="form-check-input" value="1" />
            <label class="mr-4 form-check-label"><strong>{{__('Leaves')}}</strong></label>
         </div>
      </div>
       <div class="col-md-3 form-group">
         <div class="mt-4 form-check">
            <input type="checkbox" name="rtl_layout" class="form-check-input" value="1" />
            <label class="mr-4 form-check-label"><strong>{{__('Sms')}}</strong></label>
         </div>
      </div>
      </div>
      <div class="row">
          <div class="col-md-3 form-group">
             <div class="mt-4 form-check">
                <input type="radio" name="rtl_layout" class="form-check-input" value="1" />
                <label class="mr-4 form-check-label"><strong>{{__('Auto Shift')}}</strong></label>
             </div>
          </div>
          <div class="col-md-3 form-group">
             <div class="mt-4 form-check">
                <input type="radio" name="rtl_layout" class="form-check-input" value="1" />
                <label class="mr-4 form-check-label"><strong>{{__('Shift')}}</strong></label>
             </div>
          </div>
          <div class="col-md-3 form-group">
             <div class="mt-4 form-check">
                <input type="radio" name="rtl_layout" class="form-check-input" value="1" />
                <label class="mr-4 form-check-label"><strong>{{__('Roaster Based')}}</strong></label>
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
       $(".alert").slideDown(300).delay(5000).slideUp(300);
   });
   
   var form = $('#social_sample_form');
   
   
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
               $('#social_form_result').html(html);
   
           }
       });
   });
   
   })(jQuery);
</script>
@endpush