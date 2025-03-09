<!--**********************************
    Nav header start
***********************************-->
<div class="nav-header">
    <a href="/" class="brand-logo">
        {{-- <h3 class="logo-abbr">MFC</h3> --}}
        {{-- <h3 class="logo-abbr" src="{{ asset('da/images/logo.png') }}" alt="">MFC</h3> --}}
        {{-- <img class="logo-compact" src="{{ asset('da/images/logo-text.png') }}" alt="">
        <img class="brand-title" src="{{ asset('da/images/logo-text.png') }}" alt=""> --}}
        <h3 style="color:white">{{ strtoupper(config('app.name', 'Clinical Cares')) }}</h3>
    </a>

    <div class="nav-control">
        <div class="hamburger">
            <span class="line"></span><span class="line"></span><span class="line"></span>
        </div>
    </div>
</div>
<!--**********************************
    Nav header end
***********************************-->