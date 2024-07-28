<!--**********************************
    Sidebar start
***********************************-->
<div class="quixnav">
    <div class="quixnav-scroll">
        <ul class="metismenu" id="menu">
            <li class="nav-label first">Main Menu</li>
            </li>
            @guest
                <li><a href="/login" aria-expanded="false"><i class="icon-key"></i><span class="nav-text">Login</span></a></li>
            @else
                <li><a class="has-arrow" href="javascript:void()" aria-expanded="false"><i
                    class="icon icon-single-04"></i><span class="nav-text">{{ Auth::user()->FirstName.' '.Auth::user()->SecondName }}</span></a>
                    <ul aria-expanded="false">
                        <li><a href="{{ route('user.changePassword') }}">{{ __('Change Password') }}</a></li>
                        <li>
                            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">{{ __('Logout') }}</a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li>
                    </ul>
                </li>
            @endguest

            @auth
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                {{-- <i class="icon icon-single-04"></i> --}}
                <i class="mdi mdi-view-dashboard"></i>
                <span class="nav-text">Dashboard</span></a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('home') }}">Dashboard</a></li>
                </ul>
            </li>
            <li><a href="{{ route('audit-trail.index') }}" aria-expanded="false"><i class="mdi mdi-road-variant mdi-24px"></i><span class="nav-text">Audit Trail</span></a>
            </li>
            <li class="nav-label">Patients</li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                <i class="mdi mdi-account-group mdi-24px"></i>
                {{-- <i class="icon icon-app-store"></i> --}}
                <span class="nav-text">Patients</span></a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('corporate-clients.index') }}">
                        {{ __('Corporate Clients') }}
                    </a></li>
                    <li><a href="{{ route('patients.index') }}">
                        {{ __('List of Patients') }}
                    </a></li>
                    <li><a href="{{ route('next-of-kin.index') }}">
                        {{ __('Next of Kin') }}
                    </a></li>
                    <li><a href="{{ route('referrals.index') }}">
                        {{ __('Referral Records') }}
                    </a></li>
                    {{-- <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">Email</a>
                        <ul aria-expanded="false">
                            <li><a href="./email-compose.html">Compose</a></li>
                            <li><a href="./email-inbox.html">Inbox</a></li>
                            <li><a href="./email-read.html">Read</a></li>
                        </ul>
                    </li>
                    <li><a href="./app-calender.html">Calendar</a></li> --}}
                </ul>
            </li>
            <li class="nav-label">Treatment</li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                <i class="mdi mdi-medical-bag mdi-24px"></i>
                {{-- <i class="icon icon-app-store"></i> --}}
                <span class="nav-text">Medical Services</span></a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('patient-service-records.index') }}">
                        {{ __('Medical Service Recrods') }}
                    </a></li>
                    <li><a href="{{ route('medical-services.index') }}">
                        {{ __('Services Offered') }}
                    </a></li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                <i class="mdi mdi-needle mdi-24px"></i>
                {{-- <i class="icon icon-app-store"></i> --}}
                <span class="nav-text">Treatment Records</span></a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('treatment-records.index') }}">
                        {{ __('Treatment Records') }}
                    </a></li>
                    <li><a href="{{ route('diagnosis.index') }}">
                        {{ __('Diagnosis Records') }}
                    </a></li>
                </ul>
            </li>
            <li class="nav-label">Drugs/Items</li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                <i class="mdi mdi-pill mdi-24px"></i>
                {{-- <i class="icon icon-app-store"></i> --}}
                <span class="nav-text">Drugs</span></a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('drugs.index') }}">
                        {{ __('List') }}
                    </a></li>
                    <li><a href="{{ route('drug.usedup') }}">
                        {{ __('Used Up Drugs') }}
                    </a></li>
                    <li><a href="{{ route('drug-quantities.index') }}">
                        {{ __('Drug Quanties') }}
                    </a></li>
                    <li><a href="{{ route('drug-categories.index') }}">
                        {{ __('Categories') }}
                    </a></li>
                    <li><a href="{{ route('drug-administrations.index') }}">
                        {{ __('Administration Types') }}
                    </a></li>
                    <li><a href="{{ route('drug-units.index') }}">
                        {{ __('Unit Types') }}
                    </a></li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                <i class="mdi mdi-shape mdi-24px"></i>
                {{-- <i class="icon icon-app-store"></i> --}}
                <span class="nav-text">Medical Items</span></a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('medical-items.index')}}">
                        {{ __('List') }}
                    </a></li>
                    <li><a href="{{ route('item.usedup') }}">
                        {{ __('Used Up Items') }}
                    </a></li>
                    <li><a href="{{ route('item-quantities.index') }}">
                        {{ __('Item Quanties') }}
                    </a></li>
                </ul>
            </li>
            <li class="nav-label">Payments/Debts</li>
            <li><a href="{{ route('over-the-counter.index') }}" aria-expanded="false"><i class="mdi mdi-cash mdi-24px"></i><span
                class="nav-text">Over The Counter</span></a></li>
            <li><a href="{{ route('daily_sales') }}" aria-expanded="false"><i class="mdi mdi-cash-multiple mdi-24px"></i><span
                class="nav-text">Sales</span></a></li>
             <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                <i class="mdi mdi-sale mdi-24px"></i>
                <span class="nav-text">Debts</span></a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('debts.dailypay') }}" aria-expanded="false">Shift Debt Pay</a></li>
                    <li><a href="{{ route('debts.index') }}" aria-expanded="false">Debt</a></li>
                    <li><a href="{{ route('debts.index2') }}" aria-expanded="false">Previous/Current Debts</a></li>
                </ul>
             </li>
            <li><a href="{{ route('payment-methods.index') }}" aria-expanded="false"><i class="mdi mdi-publish mdi-24px"></i><span
                class="nav-text">Payment Methods</span></a></li>
            <li class="nav-label">Schedule and Goals</li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                <i class="mdi mdi-calendar-clock mdi-24px"></i>
                {{-- <i class="icon icon-app-store"></i> --}}
                <span class="nav-text">Schedules and Appointments</span></a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('appointments.index') }}">
                        {{ __('Appointments') }}
                    </a></li>
                    <li><a href="{{ route('doctor-schedules.index') }}">
                        {{ __('Doctor Schedules') }}
                    </a></li>
                </ul>
            </li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                <i class="mdi mdi-target mdi-24px"></i>
                {{-- <i class="icon icon-app-store"></i> --}}
                <span class="nav-text">Target Goals</span></a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('target-goals.index') }}">
                        {{ __('Targets') }}
                    </a></li>
                    <li><a href="{{ route('target-goals.index') }}">
                        {{ __('Pending Targets') }}
                    </a></li>
                    <li><a href="#">
                        {{ __('Due Targets') }}
                    </a></li>
                </ul>
            </li>
            <li class="nav-label">System Settings</li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                <i class="mdi mdi-account-settings mdi-24px"></i>
                {{-- <i class="icon icon-app-store"></i> --}}
                <span class="nav-text">Users</span></a>
                <ul aria-expanded="false">
                    <li><a href="{{route('staff.index')}}">List</a></li>
                    <li><a href="{{ route('user-roles.index') }}">
                        {{ __('User Roles') }}
                    </a></li>
                </ul>
            </li>
            <li><a href="{{ route('employees.index') }}" aria-expanded="false"><i class="mdi mdi-account-box-multiple mdi-24px"></i><span
                class="nav-text">Employees</span></a></li>
            <li><a class="has-arrow" href="javascript:void()" aria-expanded="false">
                <i class="mdi mdi-tune mdi-24px"></i>
                {{-- <i class="icon icon-app-store"></i> --}}
                <span class="nav-text">More ...</span></a>
                <ul aria-expanded="false">
                    <li><a href="{{ route('departments.index') }}">
                        {{ __('Departments') }}
                    </a></li>
                    <li><a href="{{ route('titles.index') }}">
                        {{ __('System Titles') }}
                    </a></li>
                    <li></li>
                </ul>
            </li>
            @endauth
        </ul>
    </div>
</div>
<!--**********************************
    Sidebar end
***********************************-->