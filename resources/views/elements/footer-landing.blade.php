<footer class="footer">
    <div class="container">
        <div class="row">
            <div class="col-lg-6 col-sm-6">
                <div class="widget widget_about">
                    <div class="widget-logo">
                        <img src="{{ asset('images/logo-white.svg') }}" data-rjs="2" alt="" />
                    </div>

                    <div style="padding-bottom: 10px"><b style="color: white; font-size: 24px"> <img src="{{ asset('images/logo-text-white.svg') }}" data-rjs="2" alt="" /></b></div>
                    <div class="about-text">

                        <p>
                           Kemirisewu Sidorejo Godean Sleman 55264<br>
                            Daerah Istimewa Yogyakarta
                        </p>
                    </div>
                </div>
                <div class="widget widget_social_icon">
                    <div style="padding-bottom: 10px"><b style="color: white; font-size: 16px">Kontak</b></div>
                    <ul class="">
                        <li>
                            <a href="https://instagram.com/nalarinuny/"><i class="fa fa-instagram"></i>
                                nalarinuny
                            </a>
                        </li>
                    </ul>
                </div>
            </div>
            <div class="col-lg-6 col-sm-6 d-flex align-items-center justify-content-end">
                <div>
                    <ul class="nav">
                        <li class="nav-item">
                            <a class="nav-link page-scroll" href="{{ route('landing.finance') }}">Keuangan</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link page-scroll" href="{{ route('landing.documentation') }}">FAQ</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link page-scroll" href="{{ route('login') }}">Masuk</a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <hr color="white" style="opacity: 0.2">
        <div class="row">
            <div class="col-12">
                <p class="text-center txt-footer">
                    Crafted with
                    <i class="fa fa-heart" aria-hidden="true"></i>
                    by
                    <a href="https://instagram.com/ahsanf_">
                        アシャン
                    </a>
                    | Yogyakarta &copy;
                    {{ date('Y') }}
                </p>
            </div>
        </div>
    </div>
</footer>
