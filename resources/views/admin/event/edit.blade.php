@extends('admin.layout.default')

@section('content')
<div class="container-fluid">
    @include('admin.elements.breadcrumb')
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $data['card_title'] }}</h4>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="{{ route('admin.event.update', ['event' => $data['event']['id']]) }}" method="post">
                        @csrf
                        @method('put')
                            <div class="form-group">
                                <label class="text-label">Nama Acara</label>
                                <input type="text" class="form-control" placeholder="Masukkan Nama Acara" name="event_name" value="{{ old('event_name', $data['event']['event_name']) }}" required>
                            </div>

                            <div class="form-group">
                                <label for="" class="text-label">Deskripsi Acara (Opsional)</label>
                                <textarea class="form-control" name="event_description" id="" cols="30" rows="10" placeholder="Masukkan Deskripsi Acara">
                                    {{ $data['event']['event_description'] }}
                                </textarea>
                            </div>

                            <div class="form-group">
                                <label class="text-label">Tempat Acara</label>
                                <input type="text" class="form-control" placeholder="Masukkan Tempat Acara" name="event_place" value="{{ old('event_place', $data['event']['event_place'] ) }}" required>
                            </div>

                            <div class="form-group">
                                <label class="text-label">Tanggal Acara</label>
                                <input type="text" class="form-control" placeholder="Masukkan Tanggal Acara" id="mdate" name="event_date" value="{{ old('event_date', $data['event']['event_date']) }}" required>
                            </div>

                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="" class="text-label">Waktu Mulai</label>
                                    <input class="form-control" id="event_start" placeholder="Masukkan Waktu Mulai" name="event_start" value="{{ old('event_start', $data['event']['event_start']) }}" required>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="" class="text-label">Waktu Selesai</label>
                                    <input class="form-control" id="event_end" placeholder="Masukkan Waktu Selesai" name="event_end" value="{{ old('event_start', $data['event']['event_end']) }}" required>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="text-label">Catatan (Opsional)</label>
                                <textarea class="form-control" name="event_note" id="" cols="30" rows="10" placeholder="Masukkan Catatan">
                                    {{ $data['event']['event_note'] }}
                                </textarea>
                            </div>

                            <div class="form-group">
                                <label for="" class="text-label">Tipe Undangan</label>
                                <div class="d-flex">
                                    <div class="btn-group">
                                        <button type="button" id="disable-btn" class="btn btn-sm btn-outline-primary">Semua Member</button>
                                        <button type="button" id="enable-btn" class="btn btn-sm btn-outline-primary">Pilihan</button>
                                    </div>
                                    <input type="hidden" name="event_type" id="eventType">
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="" class="text-label">Pilih Berdasarkan Tag</label>
                                <select id="multi-select-tag" name="tag_id" class="multi-select-tag">
                                    <option></option>
                                    @foreach ($data['tags'] as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->tag_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="" class="text-label">Pilih Berdasarkan Member (Bisa lebih dari satu)</label>
                                <select id="multi-select-member" name="member_id[]" class="multi-select-member" multiple="multiple">
                                    @foreach ($data['members'] as $member)
                                    <option value="{{ $member->id }}">{{ $member->member_name }}</option>
                                    @endforeach
                                </select>
                            </div>

                            <div class="card-footer">
                                <button type="submit" class="btn btn-primary btn-block">Edit Acara</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@push('custom_js')
<script>
    $(document).ready(function(){

        var tagEvent = $("#multi-select-tag").select2({
        placeholder: "Pilih Tag",
        tags: true,
        cache: true
        });

        var memberEvent = $("#multi-select-member").select2({
            placeholder: "Pilih Member",
            tags: true,
            cache: true
        });

        var eventId = `{{ $data['event']['id'] }}`;
        selectedMembers(eventId);
    });

    function selectedMembers(event_id) {
        var url = `{{ url('/misc') }}/event/${event_id}/member`;

        $.ajax({
            url: url,
            type: "get",
            success: function (response) {
                console.log(response);
                $("#multi-select-member").val(response).trigger("change");
            }
        })
    }
</script>
@endpush
