@extends('layout.main')
@section('content')
    <section>
        <div class="container-fluid">
            <div class="card">
                <ul class="nav nav-tabs d-flex" id="myTab" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link " href="" id="Comp_type-tab" data-toggle="tab" data-table= "competencies_type" data-target="#Comp_type" role="tab" aria-controls="Comp_type" aria-selected="true">{{__('Competencies Type')}}</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="" id="Comp-tab" data-toggle="tab" data-table= "competencies" data-target="#Comp" role="tab" aria-controls="Comp" aria-selected="false">{{__('Competencies')}}</a>
                    </li>
                </ul>
            </div>
        </div>
        <div class="tab-content" id="myTabContent">

            <div class="pt-0 tab-pane fade show active" id="Comp_type" role="tab" aria-labelledby="Comp_type-tab">
              @include('performance.competencies.partials.competencies_type')
            </div>

            <div class="pt-0 tab-pane fade " id="Comp" role="tab"  aria-labelledby="Comp-tab">
                @include('performance.competencies.partials.competencies')
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
                @include('performance.competencies.JS_DT.competencies_type_js')
                    leaveLoad = 1;
            }
        });

        $('[data-table="competencies"]').one('click', function (e) {
            @include('performance.competencies.JS_DT.competencies_js')
        });


    })(jQuery);
</script>
@endpush
