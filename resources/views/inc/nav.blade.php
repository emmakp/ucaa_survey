<nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Clinical Cares') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    @auth
                        <ul class="navbar-nav mr-auto pl-5 ml-5">
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Patients<span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item nav-link" href="{{ route('corporate-clients.index') }}">
                                        {{ __('Corporate Clients (Insurance)') }}
                                    </a>
                                    <a class="dropdown-item nav-link" href="{{ route('patients.index') }}">
                                        {{ __('List of Patients') }}
                                    </a>
                                    <a class="dropdown-item nav-link" href="{{ route('next-of-kin.index') }}">
                                        {{ __('Next of Kin') }}
                                    </a>
                                    <a class="dropdown-item nav-link" href="{{ route('treatment-records.index') }}">
                                        {{ __('Treatment Records') }}
                                    </a>
                                    <a class="dropdown-item nav-link" href="{{ route('patient-service-records.index') }}">
                                        {{ __('Medical Service Recrods') }}
                                    </a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Drugs<span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item nav-link" href="{{ route('drugs.index') }}">
                                        {{ __('List') }}
                                    </a>
                                    <a class="dropdown-item nav-link" href="{{ route('drug-categories.index') }}">
                                        {{ __('Categories') }}
                                    </a>
                                    <a class="dropdown-item nav-link" href="{{ route('drug-quantities.index') }}">
                                        {{ __('Drug Quanties') }}
                                    </a>
                                    <a class="dropdown-item nav-link" href="{{ route('item-quantities.index') }}">
                                        {{ __('Item Quanties') }}
                                    </a>
                                    <a class="dropdown-item nav-link" href="{{ route('drug-administrations.index') }}">
                                        {{ __('Administration Types') }}
                                    </a>
                                </div>
                            </li>
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Payments / Debts<span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item nav-link" href="{{ route('over-the-counter.index') }}">
                                        {{ __('Over The Counter') }}
                                    </a>
                                    <a class="dropdown-item nav-link" href="{{ route('sales.index') }}">
                                        {{ __('All Payments') }}
                                    </a>
                                    <a class="dropdown-item nav-link" href="{{ route('debts.index') }}">
                                        {{ __('All Debts') }}
                                    </a>
                                    <a class="dropdown-item nav-link" href="{{ route('payment-methods.index') }}">
                                        {{ __('Payment Methods') }}
                                    </a>
                                    {{-- <a class="dropdown-item nav-link" href="{{ route('payment-methods.index') }}">
                                        {{ __('List') }}
                                    </a>
                                    <a class="dropdown-item nav-link" href="{{ route('payment-methods.create') }}">
                                        {{ __('Create New') }}
                                    </a> --}}
                                </div>
                            </li>
                            
                            {{-- <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Target Goals<span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item nav-link" href="{{ route('target-goals.index') }}">
                                        {{ __('All Targets') }}
                                    </a>
                                    <a class="dropdown-item nav-link" href="{{ route('target-goals.index') }}">
                                        {{ __('All Pending Targets') }}
                                    </a>
                                    <a class="dropdown-item nav-link" href="#">
                                        {{ __('Due Targets') }}
                                    </a>
                                </div>
                            </li> --}}
                            
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    Sytem Settings<span class="caret"></span>
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    @if (Auth::user()->user_role->RoleName === 'Administrator')
                                        <a href="{{route('staff.index')}}" class="nav-link">Users</a>
                                        <a class="dropdown-item nav-link" href="{{ route('user-roles.index') }}">
                                            {{ __('User Roles') }}
                                        </a>
                                        <a class="dropdown-item nav-link" href="{{ route('employees.index') }}">
                                            {{ __('Employees') }}
                                        </a>
                                        <a class="dropdown-item nav-link" href="{{ route('titles.index') }}">
                                            {{ __('Employee Titles') }}
                                        </a>
                                    @endif
                                    <a class="dropdown-item nav-link" href="{{ route('departments.index') }}">
                                        {{ __('Departments') }}
                                    </a>
                                    <a class="dropdown-item nav-link" href="{{ route('medical-services.index') }}">
                                        {{ __('Medical Service Records') }}
                                    </a>
                                    <a class="dropdown-item nav-link" href="{{ route('drug-units.index') }}">
                                        {{ __('Unit Types') }}
                                    </a>
                                    <a class="dropdown-item nav-link" href="{{ route('referrals.index') }}">
                                        {{ __('Referral Records') }}
                                    </a>
                                    <a class="dropdown-item nav-link" href="{{ route('diagnosis.index') }}">
                                        {{ __('Diagnosis Records') }}
                                    </a>
                                </div>
                            </li>
                        </ul>
                    @endauth
                        
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            {{-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif --}}
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->FirstName.' '.Auth::user()->SecondName }} <span class="caret"></span>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('user.changePassword') }}">
                                        {{ __('Change Password') }}
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>