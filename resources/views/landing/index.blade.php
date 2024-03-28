@extends('layout.app-fullwidth')

@section('content')
    <div class="bg-white pt-4">
            <div class="container pt-5 pb-5">
                <div class="row">
                    <div class="col-md-6 d-flex flex-column align-items-start justify-content-center pb-2">
                        <h2 class="linear-wipe">KELUARGA <br> REMAJA <br> MASJID AL MUTTAQIN</h2>
                        <p class="card-text mt-2">“The Feasibility Of Indonesian 4.0 To
                            Reach Our SDGs
                            Goals</p>
                    </div>
                    <div class="col-md-6">
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
                    <div class="col-md-6">
                        <h3 class="pt-2 pb-2"><b>Karisma ?</b></h3>
                        <p>
                            Karisma (Keluarga Remaja Masjid Al Muttaqin) adalah organisasi pemuda non-profit di
                            Desa Kemirisewu yang menjadi wadah bagi remaja dan pemuda desa untuk berkarya dan mengembangkan potensi diri.
                            Didirikan dengan semangat keislaman dan kecintaan terhadap desa, Karisma berkomitmen untuk mencetak generasi muda yang
                            tangguh, berkarakter, dan peduli terhadap lingkungan sekitar.
                        </p>
                    </div>
                    <div class="col-md-6">
                        <img src="{{ asset('landing/img/video_opini.png') }}" alt="" class="img-fluid">
                    </div>
                </div>
            </div>


            <div class="container pt-5 pb-5">
                <div class="row">
                    <div class="col-md-6">
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
    </div>
@endsection
