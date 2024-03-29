@extends('layout.app-fullwidth')

@section('content')
    <div class="bg-white pt-4">
            <div class="container pt-5 pb-5">
                <div class="row">
                    <div class="col-md-6 col-xl-6 col-sm-12 col-xs-12 d-flex flex-column align-items-start justify-content-center pb-2">
                        <h2 class="linear-wipe">KELUARGA <br> REMAJA <br> MASJID AL MUTTAQIN</h2>
                        <p class="card-text mt-2">“The Feasibility Of Indonesian 4.0 To
                            Reach Our SDGs
                            Goals</p>
                    </div>
                    <div class="col-md-6 col-xl-6 col-sm-12 col-xs-12">
                        <img class="img-fluid" height="90%" src="{{ asset('landing/img/landing.png') }}" alt="">
                    </div>
                </div>
            </div>
            <hr>
            <div class="container pt-5 pb-5">
                <div class="d-flex justify-content-center mb-20 mt-20">
                    <h2><b>TENTANG</b></h2>
                </div>
            </div>
            <div class="container pt-5 pb-5">
                <div class="row">
                    <div class="col-md-6 col-xl-6 col-sm-12 col-xs-12">
                        <h3 class="pt-2 pb-2"><b>Apa itu Karisma</b></h3>
                        <p>
                            Karisma (Keluarga Remaja Masjid Al Muttaqin) adalah organisasi pemuda non-profit di
                            Desa Kemirisewu yang menjadi wadah bagi remaja dan pemuda desa untuk berkarya dan mengembangkan potensi diri.
                            Didirikan dengan semangat keislaman dan kecintaan terhadap desa, Karisma berkomitmen untuk mencetak generasi muda yang
                            tangguh, berkarakter, dan peduli terhadap lingkungan sekitar.
                        </p>
                    </div>
                    <div class="col-md-6 col-xl-6 col-sm-12 col-xs-12">
                        <img src="{{ asset('landing/img/video_opini.png') }}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>


            <div class="container pt-5 pb-5">
                <div class="row">
                    <div class="col-md-6 col-xl-6 col-sm-12 col-xs-12">
                        <img src="{{ asset('landing/img/poster.png') }}" alt="" class="img-fluid">
                    </div>
                    <div class="col-md-6">
                        <h3 class="pt-2 pb-2"><b>Program</b></h3>
                        <p>
                            Melalui berbagai program dan kegiatan positif, Karisma mengajak para
                            pemuda desa untuk terlibat aktif dalam membangun masyarakat yang lebih baik.
                            Dari kegiatan keagamaan hingga pengembangan keterampilan, Karisma
                            menjadi rumah bagi setiap remaja yang ingin mengembangkan diri dan
                            memberikan kontribusi nyata bagi kemajuan desa.
                        </p>
                    </div>

                </div>
            </div>

            <hr>

            <div class="container pt-5">
                <div class="d-flex justify-content-center mb-20 mt-20">
                    <h2><b>STATISTIK</b></h2>
                </div>
            </div>

            <div class="container pt-5 ">
                <div class="row">
                    <div class="col-xl-4 col-lg-6 col-sm-6">
                        <div class="widget-stat card bg-danger">
                          <div class="card-body  p-4">
                            <div class="media">
                              <span class="mr-3">
                                <i class="flaticon-381-calendar-1"></i>
                              </span>
                              <div class="media-body text-white text-right">
                                <p class="mb-1">Acara</p>
                                <h3 class="text-white">{{ $data['event_count'] }}</h3>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <div class="col-xl-4 col-lg-6 col-sm-6">
                        <div class="widget-stat card bg-success">
                          <div class="card-body p-4">
                            <div class="media">
                              <span class="mr-3">
                                <i class="flaticon-381-diamond"></i>
                              </span>
                              <div class="media-body text-white text-right">
                                <p class="mb-1">Pemasukan</p>
                                <h3 class="text-white">{{ "Rp " . number_format($data['financial_count'],0,',','.') }}</h3>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>

                      <div class="col-xl-4 col-lg-6 col-sm-6">
                        <div class="widget-stat card bg-primary">
                          <div class="card-body p-4">
                            <div class="media">
                              <span class="mr-3">
                                <i class="flaticon-381-user-7"></i>
                              </span>
                              <div class="media-body text-white text-right">
                                <p class="mb-1">Anggota</p>
                                <h3 class="text-white">{{ $data['member_count'] }}</h3>
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                </div>
            </div>
            <hr>

            <div class="container pt-5">
                <div class="d-flex justify-content-center mb-20 mt-20">
                    <h2><b>GALERI</b></h2>
                </div>
            </div>

            <div class="container pt-5 pb-5">
                <div class="d-flex justify-content-center mb-20 mt-20">
                <div class="row">

                    @for ($i = 1; $i <= 8; $i++)
                    <div class="col-lg-3 col-md-4 col-xs-6 thumb d-flex align-items-center justify-content-center pt-2">
                        <a id="inline" href="{{ asset('images/gallery_'.$i.'.jpg') }}" class="fancybox" rel="ligthbox">
                            <img  src="{{ asset('images/gallery_'.$i.'.jpg') }}" class="zoom img-fluid " style="max-height:147px;"  alt="">
                        </a>
                    </div>
                    @endfor

               </div>
            </div>
            <div class="container pt-4 pb-5">
                <div class="d-flex justify-content-center mb-20 mt-20">
                    <a href="{{ route('landing.documentation') }}" class="btn btn-primary">Selengkapnya</a>
                </div>
            </div>



    </div>
@endsection
@push('custom_js')
<script>
    $(document).ready(function(){
        $(".fancybox").fancybox({
            openEffect: "none",
            closeEffect: "none"
        });

        $(".zoom").hover(function(){

            $(this).addClass('transition');
        }, function(){

            $(this).removeClass('transition');
        });
    });

</script>

@endpush
