@extends('admin.layout.default')

@section('content')
<div class="container-fluid">
    @include('admin.elements.breadcrumb')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $data['card_title'] }}</h4>

                    <a href="{{ route('admin.event.create') }}" class="btn btn-primary">Tambah Acara</a>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table id="example5" class="display min-w850">
                        <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th class="text-center">Acara</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Jumlah Undangan</th>
                            <th class="text-center">Undangan</th>
                            <th class="text-center">Kehadiran</th>
                            <th class="text-center" width="10%">Tipe</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($data['events'] as $item )
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item['event_name'] }}</td>
                            <td class="text-center">{{ $item['date_string'] }}</td>
                            <td class="text-center"><span class="badge light badge-primary">{{ $item['members_count'] }}</span></td>
                            <td class="text-center">
                                @if($item['members_count'] > 0)
                                    @if($item['members'][0]['pivot']['image_path'] == null)
                                    <span class="badge light badge-danger" >Belum Dibuat</span>
                                    <input type="hidden" id="invitationStatus-{{ $item['id'] }}" value="0">
                                    @else
                                    <span class="badge light badge-success" id="invitationStatus" value="1">Sudah Dibuat</span>
                                    <input type="hidden" id="invitationStatus-{{ $item['id'] }}" value="1">
                                    @endif
                                @else
                                    <span class="badge light badge-danger">Tidak ada member</span>
                                    <input type="hidden" id="invitationStatus-{{ $item['id'] }}" value="2">
                                @endif
                            <td class="text-center">
                                <div class="d-flex justify-content-center">
                                    <span class="badge light badge-success mr-2">{{ $item['member_present'] }}</span>
                                    <span class="badge light badge-danger mr-2">{{ $item['member_not_present'] }}</span>
                                    <span class="badge light badge-secondary">{{ $item['member_no_answer'] }}</span>
                                </div>
                            </td>
                            <td class="text-center">
                                @if($item['event_type'] == 1)
                                <span class="badge light badge-success">Semua Member</span>
                                @else
                                <span class="badge light badge-primary">Member Pilihan</span>
                                @endif
                            <td>
                                <div class="row d-flex justify-content-center">

                                    <span data-toggle="tooltip" title="Buat Undangan">
                                            <button class="btn btn-success shadow btn-xs sharp mr-1" onclick="publishEvent(`{{ $item['id'] }}`)">
                                                <div class="spinner-border spinner-border-sm spinner-send" role="status" id="spinner-{{ $item['id'] }}">
                                                </div>
                                                <i class="fa-solid fa-paper-plane" style="color: white" id="icon-{{ $item['id'] }}"></i>
                                            </button>
                                    </span>
                                    @if($item['members_count'] > 0)
                                        @if($item['members'][0]['pivot']['image_path'] != null)
                                        <span data-toggle="tooltip" title="Hapus Undangan">
                                            <button class="btn btn-danger shadow btn-xs sharp mr-1" onclick="sweetConfirm(`event/{{ $item['id'] }}/delete-invitation`, 'Undangan')">
                                                <div class="spinner-border spinner-border-sm spinner-send" role="status" id="spinner-{{ $item['id'] }}">
                                                </div>
                                                <i class="fa-solid fa-paper-plane" style="color: white" id="icon-{{ $item['id'] }}"></i>
                                            </button>
                                        </span>
                                        @endif
                                    @endif


                                    <span data-toggle="tooltip" title="Edit">
                                        <a href="{{ route('admin.event.edit', ['event' => $item['id']]) }}"class="btn btn-warning shadow btn-xs sharp mr-1">
                                            <i class="fa-solid fa-pencil" style="color: white"></i></a>
                                    </span>

                                    <span data-toggle="tooltip" title="Hapus">
                                        <button onclick="sweetConfirm(`event/{{ $item['id'] }}/delete`, 'Acara')" class="btn btn-danger shadow btn-xs sharp mr-1"><i class="fas fa-trash"></i></button>
                                    </span>
                                </div>
                            </td>
                        </tr>
                        @endforeach
                        </tbody>
                    </table>
                    </div>
                </div>
                <div class="card-footer">
                    <div class="d-flex">
                        <p>Keterangan:
                            <span class="badge light badge-success mr-2 ml-2">Hadir</span>
                            <span class="badge light badge-danger mr-2">Tidak Hadir</span>
                            <span class="badge light badge-secondary">Belum Menjawab</span>
                        </p>
                    </div>
                </div>
                </div>
            </div>
    </div>
</div>
@endsection
@push('custom_js')
<script>
    $(document).ready(function() {
        $('.spinner-send').hide();
    });

    function publishEvent(event_id){
        if($(`#invitationStatus-${event_id}`).val() === '1'){
            return swal("Whoops!", "Undangan sudah dibuat, silahkan kirim lewat bot WA", "warning");
        } else if($(`#invitationStatus-${event_id}`).val()  === '2'){
            return swal("Whoops!", "Undangan tidak bisa dibuat, tidak ada anggota", "error");
        } else {
            $.ajax({
            url: `event/${event_id}/publish`,
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
            },
            success: function(data) {
                $(`#spinner-${event_id}`).hide();
                $(`#icon-${event_id}`).show();
                swal("Berhasil!", data.message, "success");
            },
            beforeSend: function() {
                $(`#spinner-${event_id}`).show();
                $(`#icon-${event_id}`).hide();
            },
            error: function(data) {
                $(`#spinner-${event_id}`).hide();
                $(`#icon-${event_id}`).show();
                swal("Gagal!", data.message, "error");
                console.log(data.message);
            }
        })
        }

    }

    function deleteInvitation(event_id) {
        $.ajax({
            url: `event/${event_id}/delete-invitation`,
            type: "POST",
            data: {
                _token: "{{ csrf_token() }}",
            },
            success: function(data) {
                $(`#spinner-${event_id}`).hide();
                $(`#icon-${event_id}`).show();
                swal("Berhasil!", data.message, "success");
            },
            beforeSend: function() {
                $(`#spinner-${event_id}`).show();
                $(`#icon-${event_id}`).hide();
            },
            error: function(data) {
                $(`#spinner-${event_id}`).hide();
                $(`#icon-${event_id}`).show();
                swal("Gagal!", data.message, "error");
                console.log(data.message);
            }
        })
    }
</script>
@endpush
