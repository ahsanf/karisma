@extends('layout.app-fullwidth')

@section('content')
<div class="container pt-5 pb-5">
    <div class="d-flex justify-content-center mb-10 mt-10">
        <h2><b>DOKUMENTASI KARISMA</b></h2>
    </div>
</div>
<div class="container pt-5 pb-5">
    <div class="row">
        <div class="col">
            <p>
                Halaman dokumentasi acara kami menyajikan laporan lengkap dari berbagai kegiatan Karisma.
                Berisi detail acara, tujuan, rundown, materi, foto, dan testimoni, dokumentasi ini berfungsi sebagai arsip sekaligus sumber inspirasi bagi pengurus dan anggota di masa depan. Dokumentasi juga menjadi wadah untuk membagikan kisah sukses kami kepada masyarakat luas dalam upaya menginspirasi lebih banyak pihak untuk membina generasi muda Muslim yang berkualitas.
        </div>
        <div class="col">
            <img src="{{ asset('landing/img/video_opini.png') }}" alt="" class="img-fluid">
        </div>
    </div>
</div>
<div class="container-fluid">

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header d-block pb-0 border-0">
                    <h4 class="card-title">Dokumentasi</h4>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table id="example5" class="display min-w850">
                        <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama</th>
                            <th class="text-center">Link</th>
                            <th class="text-center">Tanggal</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($data['documentations'] as $item )
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item['name'] }}</td>
                            <td class="text-center"><a href="{{ $item['url'] }}" target="_blank" rel="noopener noreferer">{{ $item['url'] }}</a></td>
                            <td class="text-center">{{ $item->dateString($item->date) }}</td>

                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
                </div>
            </div>
    </div>
</div>
@endsection
