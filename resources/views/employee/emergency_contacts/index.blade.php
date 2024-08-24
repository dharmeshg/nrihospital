<section>

    <span id="contact_general_result"></span>


    <div class="container-fluid">
        @if(auth()->user()->can('store-details-employee') || auth()->user()->id == $employee->id)
            <button type="button" class="btn btn-info" name="create_record" id="create_contact_record"><i
                        class="fa fa-plus"></i>{{__('Add Contact')}}</button>
        @endif
    </div>


    <div class="table-responsive mt-4">
        <table id="contact-table" class="table ">
            <thead>
            <tr>
                <th>{{trans('file.Relation')}}</th>
                <th>{{trans('file.Email')}}</th>
                <th>{{trans('file.Phone')}}</th>
                <th>{{trans('file.Address')}}</th>
                <th class="not-exported">{{trans('file.action')}}</th>
            </tr>
            </thead>
        </table>
    </div>


    <div id="ContactformModal" class="modal fade" role="dialog">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">

                <div class="modal-header">
                    <h5 id="exampleModalLabel" class="modal-title">{{__('Add Contact')}}</h5>
                    <button type="button" data-dismiss="modal" id="close" aria-label="Close" class="contact-close"><i class="dripicons-cross"></i></button>
                </div>

                <div class="modal-body">
                    <span id="contact_form_result"></span>
                    <form method="post" id="contact_sample_form" class="form-horizontal" autocomplete="off">
                        @csrf
                        <div class="row">
                            <div class="col-md-6 form-group">
                                <label>{{trans('file.Relation')}} <span class="text-danger">*</span></label>
                                <select name="relation_type_id" required id="contact_relation"
                                        class="form-control selectpicker"
                                        data-live-search="true" data-live-search-style="contains"
                                        title='{{__('Selecting',['key'=>trans('file.Relation')])}}...'>
                                    @foreach($relationTypes as $item)
                                        <option value="{{$item->id}}">{{$item->type_name}}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="col-md-6 form-group">
                                <label>{{trans('file.Email')}} <span class="text-danger">*</span></label>
                                <input type="email" name="work_email" required id="contact_work_email"
                                       placeholder="{{trans('file.Email')}}"
                                       class="form-control mb-2">
                                <!-- <input type="text" name="personal_email" id="contact_personal_email"
                                       placeholder="{{trans('file.Personal')}}"
                                       required class="form-control"> -->
                            </div>

                            <!-- <div class="col-md-6 form-group">
                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="is_primary"
                                           id="contact_is_primary" value="1">
                                    <label class="custom-control-label"
                                           for="contact_is_primary">{{trans('file.Primary')}}</label>
                                </div>

                                <div class="custom-control custom-checkbox">
                                    <input type="checkbox" class="custom-control-input" name="is_dependent"
                                           id="contact_is_dependent" value="1">
                                    <label class="custom-control-label"
                                           for="contact_is_dependent">{{trans('file.Dependent')}}</label>
                                </div>

                            </div> -->


                            <!-- <div class="col-md-6 form-group">
                                <label>{{trans('file.Name')}} *</label>
                                <input type="text" name="contact_name" id="contact_name"
                                       placeholder="{{trans('file.Name')}}"
                                       required class="form-control">
                            </div> -->
                            <div class="col-md-6 form-group">
                                <label>Mobile Number <span class="text-danger">*</span></label>
                                <input type="text" name="work_phone" id="contact_work_phone"
                                       placeholder="{{__('Mobile Number')}}"
                                       required class="form-control mb-2">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Emergency Contact <span class="text-danger">*</span></label>
                                <input type="text" name="emergency_contact" id="contact_emergency_contact"
                                       placeholder="{{__('Emergency Contact')}}"
                                       required class="form-control mb-2">
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Present Address <span class="text-danger">*</span></label>
                                <input type="text" name="address_1" id="contact_address_1"
                                       placeholder="{{__('Present Address')}}" required
                                        class="form-control mb-2">
                            </div>
                             <div class="col-md-6 form-group">
                                <label>Permanent Address <span class="text-danger">*</span></label>
                                <input type="text" name="permanent_address" id="contact_permanent_address"
                                       placeholder="{{__('Permanent Address')}}" required
                                        class="form-control mb-2">
                            </div>
                            <!-- <div class="col-md-6 form-group">
                                <label>{{trans('file.Address')}} *</label>
                                <input type="text" name="address_1" id="contact_address_1"
                                       placeholder="{{__('Address Line 1')}}"
                                       required class="form-control mb-2">
                                <input type="text" name="address_2" id="contact_address_2"
                                       placeholder="{{__('Address Line 2')}}"
                                       class="form-control">
                            </div> -->

                            <!-- <div class="col-md-6 form-group">
                                <label>{{trans('file.Mobile')}} *</label>
                                <input type="text" name="work_phone" id="contact_work_phone"
                                       placeholder="{{trans('file.Work')}}"
                                       class="form-control mb-2">
                                <input type="text" name="work_phone_ext" id="contact_work_phone_ext"
                                       placeholder="{{trans('file.Ext')}}"
                                       class="form-control mb-2">
                                <input type="text" name="personal_phone" id="contact_personal_phone"
                                       placeholder="{{trans('file.Mobile')}}"
                                       required class="form-control mb-2">
                                <input type="text" name="home_phone" id="contact_home_phone"
                                       placeholder="{{trans('file.Home')}}"
                                       class="form-control ">
                            </div> -->


                            <div class="col-md-4 form-group">
                                <label>{{trans('file.City')}} </label>
                                <input type="text" name="city" id="contact_city" placeholder="{{trans('file.City')}}"
                                        class="form-control">
                            </div>

                            <div class="col-md-4 form-group">
                                <label>{{trans('file.State/Province')}} </label>
                                <input type="text" name="state" id="contact_state"
                                       placeholder="{{trans('file.State/Province')}}"
                                        class="form-control">
                            </div>

                            <div class="col-md-4 form-group">
                                <label>{{trans('file.ZIP')}} </label>
                                <input type="text" name="zip" id="contact_zip" placeholder="{{trans('file.ZIP')}}"
                                        class="form-control">
                            </div>


                            <div class="col-md-4">
                                <div class="form-group">
                                    <label>{{trans('file.Country')}}</label>
                                    <select name="country_id" id="contact_country"
                                            class="form-control selectpicker"
                                            data-live-search="true" data-live-search-style="contains"
                                            title='{{__('Selecting',['key'=>trans('file.Country')])}}...'>
                                        @foreach($countries as $country)
                                            <option value="{{$country->id}}" {{ ($employee->country == $country->id) ? "selected" : '' }}>{{$country->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>


                            <div class="container">
                                <div class="form-group" align="center">
                                    <input type="hidden" name="action" id="contact_action"/>
                                    <input type="hidden" name="hidden_id" id="contact_hidden_id"/>
                                    <input type="submit" name="action_button" id="contact_action_button"
                                           class="btn btn-warning" value={{trans('file.Add')}} />
                                </div>
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
                    <button type="button" class="contact-close" data-dismiss="modal">&times;</button>
                </div>
                <div class="modal-body">
                    <h4 align="center" style="margin:0;">{{__('Are you sure you want to remove this data?')}}</h4>
                </div>
                <div class="modal-footer">
                    <button type="button" name="ok_button"  class="btn btn-danger contact-ok">{{trans('file.OK')}}</button>
                    <button type="button" class="contact-close btn-default" data-dismiss="modal">{{trans('file.Cancel')}}</button>
                </div>
            </div>
        </div>
    </div>

</section>

