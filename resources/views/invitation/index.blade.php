@extends('layout.fullwidth')

@section('content')
<div class="col-md-6">
    <div class="row">
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
                    @if($data['presence_status'] == 0)
                    Hai <b>{{ $data['member']['member_name'] }}</b>, apakah kamu akan hadir pada acara  {{ $data['event']['event_name'] }} pada hari {{ $data['event']['event_day'] }}, {{ $data['date_string'] }} ?
                    @elseif($data['presence_status'] == 1)
                    Kamu sudah konfirmasi kehadiran pada acara {{ $data['event']['event_name'] }} pada hari {{ $data['event']['event_day'] }}, {{ $data['date_string'] }}.
                    @endif
                </p>
            </div>
            @if($data['presence_status'] == 0)
            <div class="card-footer">
                <div class="row">
                    @php
                        $presence = ['Hadir', 'Gaskan', 'Meluncur', 'Cuskan'];
                        $random = array_rand($presence);
                    @endphp
                    <div class="col-md-6">
                        <button id="yes" class="btn btn-success btn-block mt-2">{{ $presence[$random] }}</button>
                    </div>
                    <div class="col-md-6">
                        <button id="no" class="btn btn-danger btn-block mt-2">Tidak hadir</button>
                    </div>
                </div>
            </div>
            @endif

        </div>
    </div>
</div>
<form id="formPresence" action="{{ route('storeInvitation', ['key' => $data['key']]) }}" method="post">
    @csrf
    <input type="hidden" id="presence" name="presence" value="">
</form>
@endsection
@push('custom_js')
<script>
    $(document).ready(function() {
    // Fungsi untuk menangani aksi ketika tombol "Hadir" diklik
    $("#yes").click(function() {
        $('#presence').val('1');
        $('#formPresence').submit();
    });

    // Fungsi untuk menangani aksi ketika tombol "Tidak Hadir" diklik
    $("#no").click(function() {
        $('#presence').val('0');
        $('#formPresence').submit();
    });
});
</script>
@endpush
