@extends('admin.layout.default')

@section('content')
<div class="container-fluid">
    @include('admin.elements.breadcrumb')
    <!-- row -->
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
        <div class="card">
            <div class="card-header">
            <h4 class="card-title">{{ $data['card_title'] }}</h4>
            </div>
            <div class="card-body">
            <div id="smartwizard" class="form-wizard order-create">
                <ul class="nav nav-wizard">
                <li><a class="nav-link" href="#step-1">
                    <span>1</span>
                </a></li>
                <li><a class="nav-link" href="#step-2">
                    <span>2</span>
                </a></li>

                </ul>
                <div class="tab-content">
                    <form action="{{ route('admin.event.store') }}" method="post" enctype="multipart/form">
                        @csrf
                    <div id="step-1" class="tab-pane" role="tabpanel">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="text-label">Nama Acara</label>
                                    <input type="text" class="form-control" placeholder="Masukkan Nama Acara" name="event_name" value="{{ old('event_name') }}" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="" class="text-label">Deskripsi Acara (Opsional)</label>
                                    <textarea class="form-control" name="event_description" id="" cols="30" rows="10" placeholder="Masukkan Deskripsi Acara"></textarea>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="text-label">Tempat Acara</label>
                                    <input type="text" class="form-control" placeholder="Masukkan Tempat Acara" name="event_place" value="{{ old('event_place') }}" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label class="text-label">Tanggal Acara</label>
                                    <input type="text" class="form-control" placeholder="Masukkan Tanggal Acara" id="mdate" name="event_date" value="{{ old('event_date') }}" required>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-row">
                                    <div class="form-group col-md-6">
                                        <label for="" class="text-label">Waktu Mulai</label>
                                        <input class="form-control" id="event_start" placeholder="Masukkan Waktu Mulai" name="event_start" value="{{ old('event_start', '19:00') }}" required>
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="" class="text-label">Waktu Selesai</label>
                                        <input class="form-control" id="event_end" placeholder="Masukkan Waktu Selesai" name="event_end" value="{{ old('event_start', '21:00') }}" required>
                                    </div>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="" class="text-label">Kategori Event</label>
                                    <select class="form-control default-select" id="sel1" name="event_category">
                                        <option disabled selected>Pilih Kategori</option>
                                        <option value="1">Rapat Biasa</option>
                                        <option value="2">Sinoman</option>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="" class="text-label">Catatan (Opsional)</label>
                                    <textarea class="form-control" name="event_note" id="" cols="30" rows="10" placeholder="Masukkan Catatan"></textarea>
                                </div>
                            </div>

                        </div>
                    </div>
                <div id="step-2" class="tab-pane" role="tabpanel">
                    <div class="row">
                        <div class="col-md-12">
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
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="" class="text-label">Pilih Berdasarkan Tag</label>
                                <select id="multi-select-tag" name="tag_id" class="multi-select-tag">
                                    <option></option>
                                    @foreach ($data['tags'] as $tag)
                                    <option value="{{ $tag->id }}">{{ $tag->tag_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="" class="text-label">Pilih Berdasarkan Member (Bisa lebih dari satu)</label>
                                <select id="multi-select-member" name="member_id[]" class="multi-select-member" multiple="multiple">
                                    @foreach ($data['members'] as $member)
                                    <option value="{{ $member->id }}">{{ $member->member_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                        <div class="col-md-12 mt-3">
                            <button type="submit" class="btn btn-primary btn-block">Tambah Acara</button>
                        </div>

                    </div>
                </div>
                </form>
                </div>
            </div>
            </div>
        </div>
        </div>
    </div>
</div>
@endsection
@push('custom_js')
<script>
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


    $(document).ready(function () {

        tagEvent.prop("disabled", true);
        memberEvent.prop("disabled", true);
        $('.select-member').select2({
            placeholder: "Pilih Member",
            tags: true,
            cache: true,
        });

        $('.select-tag').select2({
            placeholder: "Pilih Tag",
            tags: true,
            cache: true,
        });

        $('#event_start').bootstrapMaterialDatePicker({
            format: 'HH:mm',
            time: true,
            date: false
        });

        $('#event_end').bootstrapMaterialDatePicker({
            format: 'HH:mm',
            time: true,
            date: false
        });

        $("#disable-btn").on("click", () => {
            $("#disable-btn").addClass('active');

            if($("#disable-btn").hasClass('active')){
                $("#enable-btn").removeClass('active');
            }
            $("#eventType").val(1);
            stateEventType(true);
        });

        $("#enable-btn").on("click", () => {
            $("#enable-btn").addClass('active');

            if($("#enable-btn").hasClass('active')){
                $("#disable-btn").removeClass('active');
            }
            $("#eventType").val(0);
            stateEventType(false);

        });


    });

    function stateEventType(bool){
        tagEvent.val('').trigger('change');
        memberEvent.val('').trigger('change');
        tagEvent.prop("disabled", bool);
        memberEvent.prop("disabled", bool);
    }

    $('.multi-select-tag').on('change', function(e){
        var tagId = $(this).val();
        $.ajax({
            url: `{{ url('/misc') }}/tag/${tagId}/member`,
            type: "GET",
            dataType: 'json',
            cache: true,

            success: function (data) {

                let temp = [];
                $.each(data, function(key){
                    temp.push(data[key].id);
                });
                memberEvent.val(temp).trigger('change');
            }
        });

    });

</script>
@endpush
