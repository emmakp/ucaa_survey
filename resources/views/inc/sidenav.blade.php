<!--**********************************
    Sidebar start
***********************************-->
{{-- <div class="quixnav">
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

            @endauth
        </ul>
    </div>
</div> --}}


<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                {{-- <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="index.html">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">Interface</div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                    <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                    Layouts
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a> --}}
                {{-- <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="{{ url('audit-trail') }}">Static Navigation</a>
                        <a class="nav-link" href="layout-sidenav-light.html">Light Sidenav</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Pages
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                            Authentication
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="login.html">Login</a>
                                <a class="nav-link" href="register.html">Register</a>
                                <a class="nav-link" href="password.html">Forgot Password</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                            Error
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="401.html">401 Page</a>
                                <a class="nav-link" href="404.html">404 Page</a>
                                <a class="nav-link" href="500.html">500 Page</a>
                            </nav>
                        </div>
                    </nav>
                </div> --}}
                <div class="sb-sidenav-menu-heading">Tabs / Links</div>
                <a class="nav-link" href="{{route('home')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Dashboard
                </a>
                <a class="nav-link" href="{{url('audiences')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-users"></i></div>
                    Audiences
                </a>
                <!-- <a class="nav-link" href="{{url('jurisdictions')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-map"></i></div>
                    Jurisdictions
                </a> -->
                <a class="nav-link" href="{{url('departments')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-industry"></i></div>
                   Departments
                </a>

                <a class="nav-link" href="{{url('surveys')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-clipboard-list"></i></div>
                    Surveys
                </a>
                <a class="nav-link" href="{{url('questionaires')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-clipboard-question"></i></div>
                    Questionaires
                </a>
                {{-- <a class="nav-link" href="{{url('question-types')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-check-square"></i></div>
                    Question Types
                </a> --}}
                <!-- <a class="nav-link" href="{{ route('question-type.index') }}">
    <div class="sb-nav-link-icon"><i class="fas fa-check-square"></i></div>
    Question Types
</a> -->
                <a class="nav-link" href="{{url('questions')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-question"></i></div>
                    Questions
                </a>
                {{-- <a class="nav-link" href="{{url('answers')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-reply"></i></div>
                    Answers
                </a> --}}
                {{-- <a class="nav-link" href="{{url('answers')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-folder"></i></div>
                    Reports
                </a> --}}
                <a class="nav-link" href="{{url('answers')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-reply"></i></div>
                    Answers
                </a>
                <a class="nav-link" href="{{url('audit-trail')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-history"></i></div>
                    Audit Trail
                </a>
                <a class="nav-link" href="{{url('staff')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-user"></i></div>
                    Staff
                </a>
                <a class="nav-link" href="{{url('titles')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-heading"></i></div>
                    Titles
                </a>
                <a class="nav-link" href="{{url('user-roles')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-user-plus"></i></div>
                    User Roles
                </a>
                {{-- <a class="nav-link" href="{{url('employees')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Employees
                </a> --}}
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            {{ auth()->user()->FirstName }} {{ auth()->user()->SecondName }}
        </div>
    </nav>
</div>

<!--**********************************
    Sidebar end
***********************************-->
