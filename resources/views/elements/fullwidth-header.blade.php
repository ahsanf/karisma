

<!--**********************************
Header start
***********************************-->
<nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top navbar-pl">
    <a class="navbar-brand logo-brand" href="{{ url('/') }}">
    </a>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarTogglerDemo02" aria-controls="navbarTogglerDemo02" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>

    <div class="collapse navbar-collapse flex-column flex-wrap align-content-end text-right" id="navbarTogglerDemo02">
    <ul class="navbar-nav mr-auto mt-2 mt-lg-0 p-2 align-items-center">
        <li class="nav-item mr-3">
            <a class="{{ request()->is('landing') ? 'nav-active' : '' }}" href="{{ route('landing.index') }}">Beranda</a>
        </li>
        <li class="nav-item mr-3">
            <a class="{{ request()->is('landing/finance') ? 'nav-active' : '' }}" href="{{ route('landing.finance') }}">Keuangan</a>
        </li>

        <li class="nav-item mr-2">
            <a class="{{ request()->is('landing/documentation') ? 'nav-active' : '' }}" href="{{ route('landing.documentation') }}">Dokumentasi</a>
        </li>

        <li class="nav-item mr-2">
            <a class="btn tp-btn-light btn-primary" href="{{ route('login') }}">Masuk</a>
        </li>

    </ul>
    </div>
</nav>

<!--**********************************
Header end ti-comment-alt
***********************************-->
