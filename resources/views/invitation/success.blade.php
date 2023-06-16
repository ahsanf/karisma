@extends('layout.fullwidth')

@section('content')
<div class="col-md-6">
    <div class="row justify-content-center">
        <div class="col-lg-12 text-center mb-4">
            <img class="img-fluid mb-4" width="300px"
                src="{{ asset('images/logo-full.svg') }}"
                alt="">
        </div>

        <div class="card">
            <div class="card-header" style="justify-content: center" >
                <div class="text-center mb-0">
                    <h3>Konfirmasi Kehadiran</h3>
                </div>
            </div>

            <div class="card-body">
                <p class="card-text text-center">
                    Terimakasih sudah konfirmasi ! Semoga (isi sendiri) 😁
                </p>
            </div>
        </div>
    </div>
</div>
@endsection
