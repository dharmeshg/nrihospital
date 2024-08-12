<nav class="side-navbar">
    <div class="side-navbar-wrapper">
        <!-- Sidebar Header    -->
        <!-- Sidebar Navigation Menus-->
        <div class="main-menu">
            <ul id="side-main-menu" class="side-menu list-unstyled mb-5">

                @if(auth()->user()->role_users_id ==1)
                    <li class="{{ (request()->is('admin/dashboard*')) ? 'active' : '' }}"><a
                                href="{{route('admin.dashboard')}}"> <i
                                    class="dripicons-meter"></i><span>{{trans('file.Dashboard')}}</span></a>
                    </li>
                @else
                    <li class="{{ (request()->is('employee/dashboard*')) ? 'active' : '' }}"><a
                                href="{{url('/employee/dashboard')}}"> <i
                                    class="dripicons-meter"></i><span>{{trans('file.Dashboard')}}</span></a>
                    </li>
                @endif




                @can('user')
                    <li class="has-dropdown @if(request()->is('user*')){{ (request()->is('user*')) ? 'active' : '' }}@elseif(request()->is('add-user*')){{ (request()->is('add-user*')) ? 'active' : '' }}@endif">
                        @if(auth()->user()->can('view-user'))
                            <a href="#users" aria-expanded="false" data-toggle="collapse">
                                <i class="dripicons-user"></i>
                                <span>{{trans('file.User')}}</span>
                            </a>
                        @endif
                        <ul id="users" class="collapse list-unstyled ">
                            @can('view-user')
                                <li id="users-menu"><a href="{{route('users-list')}}">{{__('Users List')}}</a></li>
                            @endcan
                            {{-- @can('role-access-user')
                                <li id="user-roles"><a
                                            href={{route('user-roles')}}>{{__('User Roles and Access')}}</a></li>
                            @endcan --}}
                           
                            @can('last-login-user')
                                <li id="user-last-login"><a
                                            href="{{route('login-info')}}">{{__('Users Last Login')}}</a>
                                </li>
                            @endcan

                        </ul>
                    </li>
                @endcan

                @can('view-details-employee')
                    <li class="has-dropdown {{ (request()->is('staff*')) ? 'active' : '' }}">
                        <a href="#employees" aria-expanded="false" data-toggle="collapse"> <i class="dripicons-user-group"></i><span>{{trans('file.Employees')}}</span></a>
                        <ul id="employees" class="collapse list-unstyled ">
                            @can('view-details-employee')
                                <li id="employee_list"><a href="{{route('employees.index')}}">{{__('Employee Lists')}}</a></li>
                            @endcan
                            @can('import-employee')
                                <li id="user-import"><a href="{{route('employees.import')}}">{{__('Import Employees')}}</a>
                                </li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('customize-setting')
                    <li class="has-dropdown {{ (request()->is('settings*')) ? 'active' : '' }}">


                        @if(auth()->user()->can('view-role')||auth()->user()->can('view-general-setting')||auth()->user()->can('access-language')||auth()->user()->can('access-variable_type')||auth()->user()->can('access-variable_method')||auth()->user()->can('view-general-setting'))
                            <a href="#Customize_settings" aria-expanded="false" data-toggle="collapse">
                                <i class="dripicons-toggles"></i><span>{{__('Customize Setting')}}</span>
                            </a>
                        @endif
                        {{-- <a href="#Customize_settings" aria-expanded="false" data-toggle="collapse">
                            <i class="dripicons-toggles"></i><span>{{__('Customize Setting')}}</span>
                        </a> --}}

                        <ul id="Customize_settings" class="collapse list-unstyled ">
                            
                            @can('view-general-setting')
                                <li id="general_settings"><a
                                            href="{{route('general_settings.index')}}">{{__('General Settings')}}</a>
                                </li>
                            @endcan

                            @can('access-variable_type')
                                <li id="variable_type"><a
                                            href="{{route('variables.index')}}">{{__('Variable Type')}}</a>
                                </li>
                            @endcan
                            @can('access-variable_method')
                                <li id="variable_method"><a
                                            href="{{route('variables_method.index')}}">{{__('Variable Method')}}</a>
                                </li>
                            @endcan
                           
                        </ul>
                    </li>
                @endcan



                <li class="has-dropdown {{ (request()->is('organization*')) ? 'active' : '' }}"><a href="#Organization" aria-expanded="false" data-toggle="collapse">
                        <i
                                class="dripicons-view-thumb"></i><span>{{trans('file.Organization')}}</span></a>
                    <ul id="Organization" class="collapse list-unstyled ">
                        @can('view-location')
                            <li id="location"><a href="{{route('locations.index')}}">{{trans('file.Location')}}</a></li>
                        @endcan
                        @can('view-company')
                            <li id="company"><a href="{{route('companies.index')}}">{{trans('file.Company')}}</a></li>
                        @endcan
                        @can('view-department')
                            <li id="department"><a
                                        href="{{route('departments.index')}}">{{trans('file.Department')}}</a>
                            </li>
                        @endcan

                        @can('view-designation')
                            <li id="designation"><a
                                        href="{{route('designations.index')}}">{{trans('file.Designation')}}</a>
                            </li>
                        @endcan

                   
                    </ul>
                </li>

                @can('core_hr')
                <li class="has-dropdown {{ (request()->is('core_hr*')) ? 'active' : '' }}">

                    @if(auth()->user()->can('view-promotion')||auth()->user()->can('view-award') || auth()->user()->can('view-travel')||auth()->user()->can('view-transfer')||auth()->user()->can('view-resignation')||auth()->user()->can('view-complaint')||auth()->user()->can('view-warning')||auth()->user()->can('view-termination'))
                        <a href="#Core_hr" aria-expanded="false" data-toggle="collapse">
                            <i class="dripicons-briefcase"></i><span>{{__('Core HR')}}</span>
                        </a>
                    @endcan

                    <ul id="Core_hr" class="collapse list-unstyled">

                        @can('view-promotion')
                            <li id="promotion"><a
                                        href="{{route('promotions.index')}}">{{trans('file.Promotion')}}</a>
                            </li>
                        @endcan
                        
                        @can('view-transfer')
                            <li id="transfer"><a href="{{route('transfers.index')}}">{{trans('file.Transfer')}}</a>
                            </li>
                        @endcan
                        @can('view-resignation')
                            <li id="resignation"><a
                                        href="{{route('resignations.index')}}">{{trans('file.Resignations')}}</a>
                            </li>
                        @endcan
                    
                        @can('view-termination')
                            <li id="termination"><a
                                        href="{{route('terminations.index')}}">{{trans('file.Terminations')}}</a>
                            </li>
                        @endcan

                    </ul>
                </li>
            @endcan

                @can('timesheet')
                    <li class="has-dropdown {{ (request()->is('timesheet*')) ? 'active' : '' }}"><a href="#Timesheets"
                                                                                                    aria-expanded="false"
                                                                                                    data-toggle="collapse">
                            <i class="dripicons-clock"></i><span>{{trans('file.Timesheets')}}</span></a>
                        <ul id="Timesheets" class="collapse list-unstyled ">

                            @can('view-office_shift')
                                <li id="office_shift"><a
                                            href="{{route('office_shift.index')}}">{{__('Office Shift')}}</a>
                                </li>
                            @endcan
                            @can('view-holiday')
                                <li id="holiday"><a href="{{route('holidays.index')}}">{{__('Manage Holiday')}}</a></li>
                            @endcan
                            @can('view-leave')
                                <li id="leave"><a href="{{route('leaves.index')}}">{{__('Manage Leaves')}}</a></li>
                            @endcan
                        </ul>
                    </li>
                @endcan

                @can('performance')
                        <li class="has-dropdown {{ (request()->is('performance*')) ? 'active' : '' }}">
                            @if(auth()->user()->can('view-goal-type') || auth()->user()->can('view-goal-tracking') || auth()->user()->can('view-indicator') || auth()->user()->can('view-appraisal'))
                                <a href="#performance" aria-expanded="false" data-toggle="collapse"> <i class="fa fa-bar-chart"></i>
                                    <span>Performance</span>
                                </a>
                            @endif
                            <ul id="performance" class="collapse list-unstyled ">
                                @can('view-goal-type')
                                    <li id="goal-type"><a href="{{route('performance.goal-type.index')}}">{{__('Goal type')}}</a></li>
                                @endcan
                                @can('view-goal-tracking')
                                    <li id="goal-tracking"><a href="{{route('performance.goal-tracking.index')}}">{{__('Goal Tracking')}}</a></li>
                                @endcan
                                @can('view-indicator')
                                    <li id="indicator"><a href="{{route('performance.indicator.index')}}">{{__('Indicator')}}</a></li>
                                @endcan
                                @can('view-appraisal')
                                    <li id="appraisal"><a href="{{route('performance.appraisal.index')}}">{{__('Appraisal')}}</a></li>
                                @endcan
                            </ul>
                        </li>
                    @endcan

               

                    <li class="has-dropdown {{ (request()->is('report*')) ? 'active' : '' }}"><a href="#HR_Reports"
                                                                                                 aria-expanded="false"
                                                                                                 data-toggle="collapse">
                            <i class="dripicons-document"></i><span>{{__('HR Reports')}}</span></a>
                        <ul id="HR_Reports" class="collapse list-unstyled ">

                            
                            @can('report-employee')
                                <li id="employees_report"><a
                                            href="{{route('report.employees')}}">{{__('Employees Report')}}</a>
                                </li>
                            @endcan
                           
                        </ul>
                    </li>
                
            </ul>
        </div>
    </div>
</nav>
