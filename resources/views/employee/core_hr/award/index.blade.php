<div class="row">
    <div class="col-md-3">

            <ul class="nav nav-tabs vertical" id="myTab" role="tablist">
                
                <li class="nav-item">
                    <a class="nav-link active" id="employee_award-tab" data-toggle="tab" href="#Employee_award"
                       role="tab" aria-controls="Employee_award" aria-selected="true">{{trans('file.Award')}}</a>
                </li>
                
                <li class="nav-item">
                    <a class="nav-link" href="{{route('employee_transfer.show',$employee)}}" id="employee_transfer-tab"
                       data-toggle="tab" data-table="employee_transfer" data-target="#Employee_transfer" role="tab"
                       aria-controls="Employee_transfer" aria-selected="true">{{trans('file.Transfer')}}</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('employee_promotion.show',$employee)}}"
                       id="employee_promotion-tab"
                       data-toggle="tab" data-table="employee_promotion" data-target="#Employee_promotion" role="tab"
                       aria-controls="Employee_promotion" aria-selected="false">{{trans('file.Promotion')}}</a>
                </li>
                
            </ul>

    </div>

    <div class="col-md-9">
        <div class="tab-content" id="myTabContent">
  
            <div class="tab-pane fade show active" id="Employee_award" role="tabpanel"
                 aria-labelledby="employee_award-tab">
                <!--Contents for Basic starts here-->
                {{__('Award Info')}}
                <hr>
                <div class="row">
                    <div class="table-responsive">
                        <table id="employee_award-table" class="table ">
                            <thead>
                            <tr>
                                <th>{{__('Award Name')}}</th>
                                <th>{{trans('file.Details')}}</th>
                                <th>{{trans('file.Gift')}}</th>
                                <th>{{__('Award Date')}}</th>
                                <th class="not-exported">{{trans('file.action')}}</th>
                            </tr>
                            </thead>

                        </table>
                    </div>
                </div>
                <div class="modal fade" id="employee_award_modal" tabindex="-1" role="dialog"
                     aria-labelledby="basicModal"
                     aria-hidden="true" style="margin-top: -20px;">
                    <div class="modal-dialog modal-dialog-centered modal-lg">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h4 class="modal-title" id="myModalLabel">{{__('Award Info')}}</h4>
                                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;
                                </button>
                            </div>
                            <div class="modal-body">

                                <span id="award_award_photo_id"></span>

                                <div class="row">
                                    <div class="col-md-12">

                                        <div class="table-responsive">

                                            <table class="table  table-bordered">

                                                <tr>
                                                    <th>{{trans('file.Company')}}</th>
                                                    <td id="award_company_id_show"></td>
                                                </tr>

                                                <tr>
                                                    <th>{{trans('file.Employee')}}</th>
                                                    <td id="award_employee_id_show"></td>
                                                </tr>

                                                <tr>
                                                    <th>{{trans('file.Department')}}</th>
                                                    <td id="award_department_id_show"></td>
                                                </tr>

                                                <tr>
                                                    <th>{{__('Award Type')}}</th>
                                                    <td id="award_award_type_id_show"></td>
                                                </tr>


                                                <tr>
                                                    <th>{{__('Award Info')}}</th>
                                                    <td id="award_award_information_id"></td>
                                                </tr>

                                                <tr>
                                                    <th>{{trans('file.Gift')}}</th>
                                                    <td id="award_gift_id"></td>
                                                </tr>

                                                <tr>
                                                    <th>{{trans('file.Cash')}}</th>
                                                    <td id="award_cash_id"></td>
                                                </tr>

                                                <tr>
                                                    <th>{{__('Award Date')}}</th>
                                                    <td id="award_award_date_id"></td>
                                                </tr>
                                                
                                            </table>

                                        </div>

                                    </div>
                                </div>

                            </div>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-default"
                                    data-dismiss="modal">{{trans('file.Close')}}</button>

                        </div>
                    </div>
                </div>

            </div>

            <div class="tab-pane fade" id="Employee_transfer" role="tabpanel" aria-labelledby="Employee_transfer-tab">
                {{__('Transfer Info')}}
                <hr>

                @include('employee.core_hr.transfer.index')
            </div>
            <div class="tab-pane fade" id="Employee_promotion" role="tabpanel" aria-labelledby="Employee_promotion-tab">
                {{__('Promotion Info')}}
                <hr>

                @include('employee.core_hr.promotion.index')
            </div>

        </div>
    </div>
</div>




