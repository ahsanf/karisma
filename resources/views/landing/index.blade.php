@extends('layout.landing-skeleton')
@push('stylesheet')
@endpush
@section('app')
    {{-- Preloader --}}
    <div class="preloader w-100 h-100 position-fixed">
        <span class="loader"> Loading… </span>
    </div>

    {{-- Nav --}}
    <header class="header">
        <div class="header-main rounded-full">
            @include('elements.navbar-landing')
        </div>
    </header>

    {{-- Banner --}}
    <div class="banner" data-aos="fade-up" data-aos-anchor="#app">
        <div class="banner_slider">
            <div class="single_slide">
                <div class="container">
                <div class="banner-images row justify-content-between align-items-end">
                        <div class="container">
                            <div class="row pb-0">
                                <div class="col-lg-6">
                                    {{-- Event Title --}}
                                    <div class="section-title style--two">
                                        <p class="up1">UNY NALARIN</p>
                                        <p class="up2">KELUARGA <br> REMAJA <br> MASJID AL MUTTAQIN</p>
                                        <p class="up4">“The Feasibility Of Indonesian 4.0 To
                                            Reach Our SDGs
                                            Goals“</p>
                                    </div>
                                    <div>
                                        <a href="{{ route('register') }}"> <button class="btn-branch">Mulai Daftar
                                                🔥</button></a>
                                        <a class="page-scroll" href="#tentang"><button class="btn-pelajari">Pelajari
                                                lebih lanjut</button></a>
                                    </div>

                                    {{-- Social --}}
                                    <div class="mt-40">
                                        <ul class="social_icon_list">
                                            <li class="h-24">
                                                <a href="https://instagram.com/nalarinuny/">
                                                    <i class="fa fa-instagram"></i>
                                                    <span class="lh-30">
                                                        nalarinuny
                                                    </span>
                                                </a>
                                            </li>
                                            <li class="h-24">
                                                <a href="https://t.me/nalarinuny2022">
                                                    <i class="fa fa-telegram"></i>
                                                    <span class="lh-30">
                                                        t.me/nalarinuny2022
                                                    </span>
                                                </a>
                                            </li>
                                        </ul>
                                    </div>
                                </div>

                                {{-- Banner Image --}}
                                <div class="col-lg-6 order-first order-lg-last">
                                    <img class="pt-4" width="100%" src="{{ asset('img/landing.png') }}"
                                        alt="" />
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- Cabang Lomba --}}
    <section class="pt-80 pb-80" id="tentang" data-aos="fade-up" data-aos-anchor="#app">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="text-left">
                        <h2 class="section-title text-center">
                            CABANG LOMBA
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section data-aos="fade-up" data-aos-anchor="#app">
        <div class="container">

            {{-- Video Opini --}}
            <div class="row justify-content-between align-items-center pb-140" data-aos="fade-up" data-aos-anchor="#app">
                <div class="col-lg-5">
                    <div class="mb-50 mb-lg-0">
                        <img src="{{ asset('img/video_opini.png') }}" alt="" />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="section-title style--two">
                        <div class="title-border">
                            <span></span> <span></span> <span></span>
                        </div>
                        <h2 class="branch-title">Video Opini</h2>
                        <p class="branch-decs">
                            Video opini memberikan kesempatan bagi mahasiswa untuk
                            mengekspresikan pendapatnya yang berkaitan dengan The Feasibility Of Indonesian 4.0 To Reach
                            Our SDGs Goals. Gagasan yang Gagasan yang terekspresikan diharapkan mampu membuka mata
                            berbagai pihak untuk mencapai tujuan yang tercantum dalam SDGs.
                        </p>
                        <a href="{{ url('tentang/video_opini') }}">
                            <button class="btn-branch">
                                Selengkapnya
                                <i class="ml-2 fa fa-angle-right"></i>
                            </button>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Poster --}}
            <div class="row pb-140" data-aos="fade-up" data-aos-anchor="#app">
                <div class="col-lg-6">
                    <div class="section-title style--two">
                        <div class="title-border">
                            <span></span> <span></span> <span></span>
                        </div>
                        <h2 class="branch-title">Poster</h2>
                        <p class="branch-decs">
                            Menuangkan emosi dalam bentuk karya merupakan hal yang kerap dilakukan untuk menyampaikan
                            pesan tersirat. Poster menjadi salah satu karya yang mampu menyampaikan pesan dengan cara
                            apik dan menarik bagi kalangan masyarakat. Dalam lomba ini UNY mengharapkan
                            mahasiswa turut andil menyuarakan emosinya terkait The Feasibility Of Indonesian 4.0 To
                            Reach Our SDGs Goals.
                        </p>
                        <a href="{{ url('tentang/poster') }}">
                            <button class="btn-branch">
                                Selengkapnya
                                <i class="ml-2 fa fa-angle-right"></i>
                            </button>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 order-first order-lg-last">
                    <div class="mb-50 mb-lg-0">
                        <img src="{{ asset('img/poster.png') }}" alt="" />
                    </div>
                </div>
            </div>

            {{-- Speech --}}
            <div class="row justify-content-between align-items-center pb-140" data-aos="fade-up" data-aos-anchor="#app">
                <div class="col-lg-5">
                    <div class="mb-50 mb-lg-0">
                        <img src="{{ asset('img/speech.png') }}" alt="" />
                    </div>
                </div>
                <div class="col-lg-6">
                    <div class="section-title style--two">
                        <div class="title-border">
                            <span></span> <span></span> <span></span>
                        </div>
                        <h2 class="branch-title">Speech Competition</h2>
                        <p class="branch-decs">
                            Speech Competition bertujuan untuk mengasah kemampuan mahasiswa untuk berpikir kreatif,
                            inovatif, meningkatkan kemampuan komunikasi dalam bahasa inggris, serta mendukung
                            perubahan yang akan dilakukan untuk mewujudkan Indonesia di era industri 4.0.
                        </p>
                        <a href="{{ url('tentang/speech') }}">
                            <button class="btn-branch">
                                Selengkapnya
                                <i class="ml-2 fa fa-angle-right"></i>
                            </button>
                        </a>
                    </div>
                </div>
            </div>

            {{-- Essay --}}
            <div class="row" data-aos="fade-up" data-aos-anchor="#app">
                <div class="col-lg-6">
                    <div class="section-title style--two">
                        <div class="title-border">
                            <span></span> <span></span> <span></span>
                        </div>
                        <h2 class="branch-title">Essay</h2>
                        <p class="branch-decs">
                            Esai merupakan cabang lomba dari kegiatan Nalar.In yang diselengarakan oleh Universitas
                            Negeri Yogyakarta. Dengan mengusung tema The Feasibility of Indonesian 4.0 To Reach Our SDGs
                            Goals, UNY mengharapkan adanya inovasi yang dapat disalurkan melalui esai sebagai wadah
                            mahasiswa untuk menuangkan gagasannya.
                        </p>
                        <a href="{{ url('tentang/essay') }}">
                            <button class="btn-branch">
                                Selengkapnya
                                <i class="ml-2 fa fa-angle-right"></i>
                            </button>
                        </a>
                    </div>
                </div>
                <div class="col-lg-6 order-first order-lg-last">
                    <div class="mb-50 mb-lg-0">
                        <img src="{{ asset('img/essay.png') }}" alt="" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    {{-- Update Info --}}
    <section class="pt-140" id="info" data-aos="fade-up" data-aos-anchor="#app">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2 class="section-title">
                            UPDATE INFO
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pt-40" data-aos="fade-up" data-aos-anchor="#app">
        <div class="container">
            @if (count($event) > 0)
                <div class="row d-flex justify-content-center">
                    @foreach ($event as $row)
                        <div class="col-sm-4">
                            <div class="card card-shadow">
                                <div class="card-header">
                                    <h5 class="card-title mt-2 text-capitalize">{{ $row->name }}</h5>
                                    {{-- {{ $row->name }} --}}
                                </div>
                                <div class="card-body">
                                    <p class="card-text pb-20 branch-decs update">
                                        {!! strlen(str_replace('&nbsp;', '', strip_tags($row->desc))) > 150 ? substr(str_replace('&nbsp;', '', strip_tags($row->desc)), 0, 150) . '...' : str_replace('&nbsp;', '', strip_tags($row->desc)) !!}
                                    </p>
                                    <a href="#"
                                        class="btn btn-primary btn-branch">
                                        Selengkapnya
                                        <i class="ml-2 fa fa-angle-right"></i></a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty-state text-center">
                    <img src="{{ asset('img/empty_info.png') }}" alt="" srcset="">
                    <h4 class="pt-2">Saat ini belum ada info tersedia.</h4>
                </div>
            @endif

            {{-- <div class="row">
                    <div class="col-lg-4">
                        <div class="single-service">
                            <div class="date-news">
                                <p>12 Februari 2022</p>
                            </div>
                            <div class="content">
                                <h3><a href="#">Pengumuman Pengunduran Jadwal Pemanasan Divisi Keamanan Siber</a></h3>
                                <button class="btn-branch">Pelajari lebih lanjut</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="single-service">
                            <div class="date-news">
                                <p>12 Februari 2022</p>
                            </div>
                            <div class="content">
                                <h3><a href="service-details.html">Pengumuman Pengunduran Jadwal Pemanasan Divisi Keamanan
                                        Siber</a></h3>
                                <button class="btn-branch">Pelajari lebih lanjut</button>
                            </div>
                        </div>
                    </div>
                    <div class="col-lg-4">
                        <div class="single-service">
                            <div class="date-news">
                                <p>12 Februari 2022</p>
                            </div>
                            <div class="content">
                                <h3><a href="service-details.html">Pengumuman Pengunduran Jadwal Pemanasan Divisi Keamanan
                                        Siber</a></h3>
                                <button class="btn-branch">Pelajari lebih lanjut</button>
                            </div>
                        </div>
                    </div>
                </div> --}}
        </div>
    </section>

    {{-- FAQ --}}
    <section class="pt-40" id="faq" data-aos="fade-up" data-aos-anchor="#app">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2 class="section-title pt-80 pb-40">
                            FAQ
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section data-aos="fade-up" data-aos-anchor="#app">
        <div class="container">
            <div class="row mb-40">
                <div class="col-lg-12">
                    <div class="accordion" id="accordionExample">
                        <div class="card">
                            <div class="card-header" id="headingOne" data-toggle="collapse" data-target="#collapseOne"
                                aria-expanded="false" aria-controls="collapseOne">
                                <h2 class="mb-0">
                                    <button class="btn-link" type="button">
                                        Apakah seluruh peserta akan mendapatkan sertifikat?
                                    </button>
                                </h2>
                            </div>

                            <div id="collapseOne" class="collapse" aria-labelledby="headingOne"
                                data-parent="#accordionExample">
                                <div class="card-body">
                                    Ya, seluruh peserta akan mendapatkan sertifikat keikutsertaan.
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingTwo" data-toggle="collapse" data-target="#collapseTwo"
                                aria-expanded="false" aria-controls="collapseTwo">
                                <h2 class="mb-0">
                                    <button class="btn-link collapsed" type="button">
                                        Apakah seluruh peserta wajib registrasi?
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo"
                                data-parent="#accordionExample">
                                <div class="card-body">
                                    Cukup ketua tim yang melakukan registrasi.
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingThree" data-toggle="collapse"
                                data-target="#collapseThree" aria-expanded="false" aria-controls="collapseThree">
                                <h2 class="mb-0">
                                    <button class="btn-link collapsed" type="button">
                                        Bagaimana cara mengetahui Kode PT?
                                    </button>
                                </h2>
                            </div>
                            <div id="collapseThree" class="collapse" aria-labelledby="headingThree"
                                data-parent="#accordionExample">
                                <div class="card-body">
                                    Silahkan cek pada bagian Kode PT dan masukkan perguruan tinggi asal.
                                </div>
                            </div>
                        </div>
                        <div class="card">
                            <div class="card-header" id="headingFour" data-toggle="collapse" data-target="#collapseFour"
                                 aria-expanded="false" aria-controls="collapseFour">
                                <h2 class="mb-0">
                                    <button class="btn-link" type="button">
                                        Bagaimana contoh surat tugas?
                                    </button>
                                </h2>
                            </div>

                            <div id="collapseFour" class="collapse" aria-labelledby="headingFour"
                                 data-parent="#accordionExample">
                                <div class="card-body">
                                    Surat tugas merupakan surat pengantar seperti yang tercantum pada lampiran.
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row mt-10">
                <div class="col-lg-12 text-center mt-10">
                    <a href="https://t.me/nalarinuny2022" class="btn-branch"><i class="fa fa-telegram"></i> Ajukan
                        pertanyaan</a>
                </div>
            </div>
        </div>
    </section>

    {{-- Unduhan --}}
    <section class="pt-140" id="unduhan" data-aos="fade-up" data-aos-anchor="#app">
        <div class="container">
            <div class="row">
                <div class="col-6">
                    <div class="section-title text-left">
                        <h2 class="section-title mb-20">
                            UNDUHAN
                        </h2>
                    </div>
                </div>
                <div class="col-6">
                    <div class="more text-right">

                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pb-120" data-aos="fade-up" data-aos-anchor="#app">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 pb-30">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-stretch">
                                <div class="file-thumbnail">
                                    <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                </div>
                                <div class="ml-2">
                                    <p class="col p-2 m-0 unduhan text-left">
                                        Pedoman Lomba Nalar.in
                                    </p>
                                    <a class="text-left unduh"
                                        href="#">
                                        Unduh
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 pb-30">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-stretch">
                                <div class="file-thumbnail">
                                    <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                </div>
                                <div class="ml-2">
                                    <p class="col p-2 m-0 unduhan text-left">
                                        Surat Pengantar Universitas
                                    </p>
                                    <a class="text-left unduh"
                                        href="#">

                                        Unduh
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 pb-30">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-stretch">
                                <div class="file-thumbnail">
                                    <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                </div>
                                <div class="ml-2">
                                    <p class="col p-2 m-0 unduhan text-left">
                                        Lembar Orisinalitas
                                    </p>
                                    <a class="text-left unduh"
                                        href="#">
                                        Unduh
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 pb-30">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-stretch">
                                <div class="file-thumbnail">
                                    <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                </div>
                                <div class="ml-2">
                                    <p class="col p-2 m-0 unduhan text-left">
                                        Pedoman Finalis Lomba Nalar.in
                                    </p>
                                    <a class="text-left unduh"
                                    target="_blank" href="https://drive.google.com/file/d/1JlhuHwP6mzvX4Fm3X6oI17YDENdZY-RA/view?usp=sharing" rel="noopener noreferrer">
                                        Unduh
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-sm-4 pb-30">
                    <div class="card">
                        <div class="card-body">
                            <div class="d-flex align-items-stretch">
                                <div class="file-thumbnail">
                                    <i class="fa fa-file-pdf-o" aria-hidden="true"></i>
                                </div>
                                <div class="ml-2">
                                    <p class="col p-2 m-0 unduhan text-left">
                                        SK Finalis Lomba Nalar.in
                                    </p>
                                    <a class="text-left unduh"
                                    target="_blank" href="https://drive.google.com/file/d/1IpvlSH96NfaFIWM_g7JXGRDEszol_dnY/view?usp=sharing" rel="noopener noreferrer">
                                        Unduh
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </section>

    {{-- Gallery Section --}}
    {{-- <section class="pt-140" data-aos="fade-up" data-aos-anchor="#app">
        <div class="container">
            <div class="row">
                <div class="col-12">
                    <div class="section-title text-center">
                        <h2 class="section-title">
                            GALERI
                        </h2>
                    </div>
                </div>
            </div>
        </div>
    </section>
    <section class="pb-140" data-aos="fade-up" data-aos-anchor="#app">
        <div class="container">
            <div class="row">
                <div class="col-sm-4 pb-30">
                    <div class="card">
                        <img class="galeri" src="{{ asset('img/bigrect.svg') }}" alt="">
                    </div>
                </div>
                <div class="col-sm-4 pb-30">
                    <div class="card">
                        <img class="galeri" src="{{ asset('img/bigrect.svg') }}" alt="">
                    </div>
                </div>
                <div class="col-sm-4 pb-30">
                    <div class="card">
                        <img class="galeri" src="{{ asset('img/bigrect.svg') }}" alt="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4 pb-30">
                    <div class="card">
                        <img class="galeri" src="{{ asset('img/bigrect.svg') }}" alt="">
                    </div>
                </div>
                <div class="col-sm-4 pb-30">
                    <div class="card">
                        <img class="galeri" src="{{ asset('img/bigrect.svg') }}" alt="">
                    </div>
                </div>
                <div class="col-sm-4 pb-30">
                    <div class="card">
                        <img class="galeri" src="{{ asset('img/bigrect.svg') }}" alt="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 text-center">
                    <button class="gl"><a class="more" href="#">Lihat lebih banyak</a></button>
                </div>
            </div>
        </div>
    </section> --}}

    {{-- Footer --}}
    <footer class="footer c1-bg">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-sm-6">
                    <div class="widget widget_about">
                        <div class="widget-logo">
                            <img src="{{ asset('img/logo.svg') }}" data-rjs="2" alt="" />
                        </div>

                        <div style="padding-bottom: 10px"><b style="color: white; font-size: 24px">NALAR.IN</b></div>
                        <div class="about-text">
                            {{-- <p>
                                    Kompetisi ini diselenggarakan oleh Universitas Negeri Yogyakarta dengan tujuan mengajak
                                    seluruh mahasiswa Indonesia berperan serta dalam mewujudkan kelayakan dan/atau
                                    kesiapan tujuan SDGs di era industri digital 4.0.
                                </p> --}}
                            <p>
                                Gedung Rektorat Lantai 2 Sayap Timur <br>
                                Jalan Colombo No. 1, Karangmalang, Depok, Sleman, <br>
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
                            <li>
                                <a href="https://t.me/nalarinuny2022"><i class="fa fa-telegram"></i>
                                    t.me/nalarinuny2022
                                </a>
                            </li>
                            <li>
                                <a href="https://api.whatsapp.com/send/?phone=6289619341118"><i class="fa fa-phone"></i>
                                    +62 896 1934 1118 (Mina)
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
                <div class="col-lg-6 col-sm-6 d-flex align-items-center justify-content-end">
                    <div>
                        <ul class="nav">
                            <li class="nav-item">
                                <a class="nav-link" href="#tentang">Tentang</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link page-scroll" href="#info">Update</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link page-scroll" href="#faq">FAQ</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link page-scroll" href="#unduhan">Unduhan</a>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <hr color="white" style="opacity: 0.2">
            <div class="row">
                <div class="col-12">
                    <p class="text-center txt-footer">
                        Made with
                        <i class="fa fa-heart" aria-hidden="true"></i>
                        by
                        <a href="https://hello.infiniteuny.id/">
                            INFINITE UNY
                        </a>
                        | Universitas Negeri Yogyakarta &copy;
                        {{ date('Y') }}
                    </p>
                </div>
            </div>
        </div>
    </footer>
@endsection

@push('javascript')
@endpush
