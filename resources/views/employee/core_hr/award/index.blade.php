<div class="row">
    <div class="col-md-3">

            <ul class="nav nav-tabs vertical" id="myTab" role="tablist">
                
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
  

            <div class="tab-pane fade show active" id="Employee_transfer" role="tabpanel" aria-labelledby="Employee_transfer-tab">
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




