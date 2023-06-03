{{-- Extends layout --}}
@extends('layout.fullwidth')

{{-- Content --}}
@section('content')
    <div class="col-md-6">

        <div class="row">
            <div class="col-lg-12 text-center mb-4">
                <img class="img-fluid" width="300px"
                    src="{{ asset('images/logo-full.svg') }}"
                    alt="">
            </div>
        </div>
        <div class="card">
            <div style="justify-content: center" class="card-header">
                <div class="text-center mb-0">
                    <h3>Masuk ke Iklimnesia</h3>
                </div>
            </div>
            <div class="card-body">
                <div class="basic-form">

                    <form class="form-valide-with-icon" action="{{ route('staff.login') }}" method="post">
                        @csrf

                        <div class="form-group">
                            <label class="text-label">Email</label>
                            <div class="input-group">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-user"></i> </span>
                                </div>
                                <input type="text" class="form-control" id="val-email" name="email"
                                    placeholder="Masukkan Email">
                            </div>
                        </div>
                        <div class="form-group">
                            <label class="text-label">Password</label>
                            <div class="input-group transparent-append">
                                <div class="input-group-prepend">
                                    <span class="input-group-text"> <i class="fa fa-lock"></i> </span>
                                </div>
                                <input type="password" class="form-control" id="dz-password" name="password"
                                    placeholder="Masukkan Password">
                                <div class="input-group-append show-pass ">
                                    <span class="input-group-text ">
                                        <i class="fa fa-eye-slash"></i>
                                        <i class="fa fa-eye"></i>
                                    </span>
                                </div>
                            </div>
                        </div>
                        <div class="form-group">
                            <div class="form-check">
                                <input id="checkbox1" class="form-check-input" type="checkbox">
                                <label for="checkbox1" class="form-check-label" name="remember">Ingat saya</label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <button type="submit" class="btn mr-2 btn-primary btn-block">Masuk sebagai Staff</button>
                                <hr>
                                <a href="{{ route('login') }}" class="btn mr-2 btn-outline-primary btn-block">Masuk sebagai Peternak</a>
                            </div>


                        </div>
                        <p class="text-center mt-2 mb-0">Belum punya akun ? <a class="text-primary" href="{{ route('register') }}">Bergabung ke Iklimnesia</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
@push('custom_js')
<script>
    $('.show-pass').on('click',function(){
        $(this).toggleClass('active');
        if($('#dz-password').attr('type') == 'password'){
            $('#dz-password').attr('type','text');
        }else if($('#dz-password').attr('type') == 'text'){
            $('#dz-password').attr('type','password');
        }
    });
</script>
@endpush