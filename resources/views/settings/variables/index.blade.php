@extends('layout.main')
@section('content')
    <section>
        <div class="container-fluid">
            <div class="card">
                <ul class="nav nav-tabs d-flex justify-content-between" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link " href="{{route('leave_type.index')}}" id="Leave_type-tab" data-toggle="tab" data-table= "leave" data-target="#Leave_type" role="tab" aria-controls="Leave_type" aria-selected="true">{{__('Leave Type')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="{{route('status_type.index')}}" id="Status_type-tab" data-toggle="tab" data-table= "status" data-target="#Status_type" role="tab" aria-controls="Status_type" aria-selected="false">{{__('Employee Status')}}</a>
                    </li>
                <!-- </ul>
                <ul class="nav nav-tabs d-flex justify-content-between" id="myTab" role="tablist"> -->
                    <li class="nav-item">
                        <a class="nav-link " href="{{route('document_type.index')}}" id="Document_type-tab" data-toggle="tab" data-table= "document" data-target="#Document_type" role="tab" aria-controls="Document_type" aria-selected="false">{{__('Document Type')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#" id="Company_type-tab" data-toggle="tab" data-table="company_type" data-target="#Company_type" role="tab" aria-controls="Company_type" aria-selected="false">{{__('Company Type')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#" id="Relation_type-tab" data-toggle="tab" data-table="relation_type" data-target="#Relation_type" role="tab" aria-controls="Relation_type" aria-selected="false">{{__('Relation Type')}}</a>
                    </li>
                    
                    <li class="nav-item">
                        <a class="nav-link " href="#" id="jobExperience-tab" data-toggle="tab" data-table="job_experience" data-target="#jobExperience" role="tab" aria-controls="jobExperience" aria-selected="false">{{__('Job Experience Type')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#" id="employeeType-tab" data-toggle="tab" data-table="employee_type" data-target="#employeeType" role="tab" aria-controls="employeeType" aria-selected="false">{{__('Employee Type')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#" id="costCenter-tab" data-toggle="tab" data-table="cost_center" data-target="#costCenter" role="tab" aria-controls="costCenter" aria-selected="false">{{__('Cost Center')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#" id="grade-tab" data-toggle="tab" data-table="grade" data-target="#grades" role="tab" aria-controls="grades" aria-selected="false">{{__('Grade')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#" id="qualification-tab" data-toggle="tab" data-table="qualification" data-target="#qualifications" role="tab" aria-controls="qualifications" aria-selected="false">{{__('Qualifications')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " href="#" id="Loan_type-tab" data-toggle="tab" data-table="loan_type" data-target="#Loan_type" role="tab" aria-controls="Loan_type" aria-selected="false">{{__('Loan Type')}}</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="tab-content" id="myTabContent">

            <div class="pt-0 tab-pane fade show active" id="Leave_type" role="tab" aria-labelledby="Leave_type-tab">
              @include('settings.variables.partials.leave_type')
            </div>
            <div class="pt-0 tab-pane fade " id="Award_type" role="tab"  aria-labelledby="Award_type-tab">
               @include('settings.variables.partials.award_type')
            </div>

            <div class="pt-0 tab-pane fade " id="Warning_type" role="tab"  aria-labelledby="Warning_type-tab">
                @include('settings.variables.partials.warning_type')
            </div>

            <div class="pt-0 tab-pane fade " id="Termination_type" role="tab"  aria-labelledby="Termination_type-tab">
                @include('settings.variables.partials.termination_type')
            </div>

            <div class="pt-0 tab-pane fade " id="Expense_type" role="tab"  aria-labelledby="Expense_type-tab">
                @include('settings.variables.partials.expense_type')
            </div>

            <div class="pt-0 tab-pane fade " id="Status_type" role="tab"  aria-labelledby="Status_type-tab">
                @include('settings.variables.partials.status_type')
            </div>

            <div class="pt-0 tab-pane fade " id="Document_type" role="tab"  aria-labelledby="Document_type-tab">
                @include('settings.variables.partials.document_type')
            </div>

            <div class="pt-0 tab-pane fade " id="Company_type" role="tab"  aria-labelledby="Company_type-tab">
                @include('settings.variables.partials.company_type')
            </div>

            <div class="pt-0 tab-pane fade " id="Relation_type" role="tab"  aria-labelledby="Relation_type-tab">
                @include('settings.variables.partials.relation_type')
            </div>

            <div class="pt-0 tab-pane fade " id="Loan_type" role="tab"  aria-labelledby="Loan_type-tab">
                @include('settings.variables.partials.loan_type')
            </div>

            <div class="pt-0 tab-pane fade " id="Deduction_type" role="tab"  aria-labelledby="Deduction_type-tab">
                @include('settings.variables.partials.deduction_type')
            </div>

            <div class="pt-0 tab-pane fade " id="depositCategory" role="tab"  aria-labelledby="depositCategory-tab">
                @include('settings.variables.partials.deposit_category')
            </div>

            <div class="pt-0 tab-pane fade " id="jobExperience" role="tab"  aria-labelledby="jobExperience-tab">
                @include('settings.variables.partials.job_experience')
            </div>
            <div class="pt-0 tab-pane fade " id="employeeType" role="tab"  aria-labelledby="employeeType-tab">
                @include('settings.variables.partials.employee_type')
            </div>
            <div class="pt-0 tab-pane fade " id="costCenter" role="tab"  aria-labelledby="costCenter-tab">
                @include('settings.variables.partials.cost_center')
            </div>
             <div class="pt-0 tab-pane fade " id="grades" role="tab"  aria-labelledby="grade-tab">
                @include('settings.variables.partials.grade')
            </div>
            <div class="pt-0 tab-pane fade " id="qualifications" role="tab"  aria-labelledby="qualification-tab">
                @include('settings.variables.partials.qualification')
            </div>
        </div>
    </section>


@endsection

@push('scripts')
<script type="text/javascript">
    (function($) {
        "use strict";

        let leaveLoad = 0;
        $(document).ready(function() {
            if (leaveLoad == 0) {
                @include('settings.variables.JS_DT.leave_type_js')
                    leaveLoad = 1;
            }
        });


        $('[data-table="award"]').one('click', function (e) {
            @include('settings.variables.JS_DT.award_type_js')
        });

        $('[data-table="warning"]').one('click', function (e) {
            @include('settings.variables.JS_DT.warning_type_js')
        });

        $('[data-table="termination"]').one('click', function (e) {
            @include('settings.variables.JS_DT.termination_type_js')
        });

        $('[data-table="expense"]').one('click', function (e) {
            @include('settings.variables.JS_DT.expense_type_js')
        });

        $('[data-table="status"]').one('click', function (e) {
            @include('settings.variables.JS_DT.status_type_js')
        });

        $('[data-table="document"]').on('click', function (e) {
            @include('settings.variables.JS_DT.document_type_js')
        });

        $('[data-table="company_type"]').on('click', function (e) {
            @include('settings.variables.JS_DT.company_type_js')
        });

        $('[data-table="relation_type"]').on('click', function (e) {
            @include('settings.variables.JS_DT.relation_type_js')
        });

        $('[data-table="loan_type"]').on('click', function (e) {
            @include('settings.variables.JS_DT.loan_type_js')
        });

        $('[data-table="deduction_type"]').on('click', function (e) {
            @include('settings.variables.JS_DT.deduction_type_js')
        });

        $('[data-table="deposit_category"]').on('click', function (e) {
            @include('settings.variables.JS_DT.deposit_category_js')
        });

        $('[data-table="job_experience"]').on('click', function (e) {
            @include('settings.variables.JS_DT.job_experience_js')
        });

        $('[data-table="employee_type"]').on('click', function (e) {
            @include('settings.variables.JS_DT.employee_type_js')
        });

        $('[data-table="cost_center"]').on('click', function (e) {
            @include('settings.variables.JS_DT.cost_center_js')
        });

        $('[data-table="grade"]').on('click', function (e) {
            @include('settings.variables.JS_DT.grade_js')
        });

        $('[data-table="qualification"]').on('click', function (e) {
            @include('settings.variables.JS_DT.qualification_js')
        });


    })(jQuery);
</script>
@endpush
