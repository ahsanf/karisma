@extends('layout.fullwidth')

{{-- Content --}}
@section('content')
    <div class="col-lg-12">

        <div class="row">
            <div class="col-lg-12 text-center mb-3 mt-3">
                <img class="img-fluid" width="300px"
                    src="{{ asset('images/logo-full.svg') }}"
                    alt="">
            </div>
        </div>
        <div class="card">
            <div style="justify-content: center" class="card-header">
                <div class="text-center mb-0">
                    <h3>Buat Akun di Iklimnesia</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="basic-form">
                    <form class="form-valide-with-icon" action="{{ route('register') }}" method="post"
                        encyptype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="" class="text-label">Nama Lengkap</label>
                            <input class="form-control" type="text" name="name" placeholder="Masukkan Nama Lengkap">
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label for="" class="text-label">Username</label>
                                <input  class="form-control"  type="text" name="username" placeholder="Masukkan Username">
                            </div>
                            <div class="form-group col-md-6">
                                <label for="" class="text-label">Email</label>
                                <input  class="form-control"  type="email" name="email" placeholder="Masukkan Email Aktif">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="text-label">No. Telepon</label>
                            <div class="input-group mb-3">
                                <div class="input-group-prepend">
                                    <span class="input-group-text input-rounded">+62</span>
                                </div>
                                <input type="number" name="phone" class="form-control "
                                    placeholder="Masukkan No. Telepon" required>
                                {{-- invalid-feedback --}}

                            </div>
                            <div class="invalid-feedback animated fadeInUp" style="display: block;"></div>
                        </div>

                        <div class="form-group">
                            <label for="" class="text-label">Alamat (Opsional)</label>
                            <textarea class="form-control" name="address" placeholder="Masukkan Alamat Lengkap" id="" cols="30" rows="10"></textarea>
                        </div>
                        <div class="form-row">
                            <div class="form-group col-md-6">
                                <label class="text-label">Kata Sandi</label>
                                <input type="password" name="password" id="password" class="form-control "
                                    placeholder="Kata Sandi" required>
                                {{-- invalid-feedback --}}
                                <div class="invalid-feedback animated fadeInUp" style="display: block;"></div>
                            </div>
                            <div class="form-group col-md-6">
                                <label class="text-label" style="color: white">.</label>
                                <input type="password" name="password_confirmation" id="password-confirmation"
                                    onchange="checkPassword();" onkeyup="this.onchange();" onpaste="this.onchange();"
                                    oninput="this.onchange();" class="form-control " placeholder="Konfirmasi Kata Sandi"
                                    required>
                                {{-- invalid-feedback --}}
                                <div class="invalid-feedback animated fadeInUp" style="display: block;"
                                    id="password_confirmation_error">
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-md-12 mt-4">
                                <button type="submit" id="btn-submit" class="btn mr-2 btn-primary btn-block">Bergabung bersama Iklimnesia</button>
                            </div>
                        </div>

                        <p class="text-center mt-4 mb-0">Sudah punya akun? <a class="text-primary" href="{{ route('login') }}">Masuk</a>
                        </p>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('custom_js')
<script>
function checkPassword() {
            let password = $("#password").val();
            let passwordConf = $("#password-confirmation").val();
            if (password !== passwordConf) {
                $('#password_confirmation_error').html('Kata sandi tidak sama')
            } else {
                $('#password_confirmation_error').html('')
            }
        }
</script>
@endpush
