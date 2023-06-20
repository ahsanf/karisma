@extends('admin.layout.default')

@section('content')
<div class="container-fluid">
    @include('admin.elements.breadcrumb')
    <div class="row">
        <div class="col-xl-12 col-xxl-12">
            <div class="card">
                <div class="card-header">
                        <h4 class="card-title">{{ $data['card_title'] }}</h4>
                        <span class="badge light badge-success">
                            <div class="d-flex justify-content-center align-items-center">
                                <div class="spinner-border spinner-border-sm mr-2" role="status" id="spinnerAutoSave"></div>
                                <i class="fa-solid fa-circle-check mr-2" id="checkAutoSave"></i>
                                Autosave
                            </div>
                        </span>
                </div>
                <div class="card-body">
                    <div class="basic-form">
                        <form action="" method="post" id="noteForm">
                            @csrf
                            @method('post')
                            <div class="form-row">
                                <div class="form-group col-md-6">
                                    <label for="" class="text-label">Judul Catatan</label>
                                    <input type="text" class="form-control" name="note_title" value="{{ old('note_tile') }}" placeholder="Masukkan Judul Catatan">
                                </div>
                                <div class="form-group col-md-6">
                                    <label class="text  -label">Tanggal</label>
                                    <input type="text" class="form-control" placeholder="Masukkan Tanggal" id="mdate" name="note_date" value="{{ old('event_date') }}" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label for="" class="text-label">Pilih Acara (Opsional)</label>
                                <select id="eventSelect" name="event_id" class="default-select">
                                    <option></option>
                                    @foreach ($data['events'] as $event)
                                    <option value="{{ $event->id }}">{{ $event->event_name }}</option>
                                    @endforeach
                                </select>
                            </div>


                    </div>
                    <textarea id="summernoteNote" name="note_content"></textarea>
                </div>
                <input id="note_id" type="hidden" name="note_id">
                <input type="hidden" name="status" value="1">
                <div class="card-footer">
                    <div class="d-flex justify-content-end">
                        <a href="{{ route('admin.note.index') }}" class="btn btn-danger">Batal</a>
                        <button onclick="saveNote()" id="saveButton"class="btn btn-primary ml-2">Simpan</button>
                    </div>

                </div>
            </form>
            </div>
        </div>
    </div>
</div>
@endsection
@push('custom_js')
<script>
    $(document).ready(function() {
        $("#spinnerAutoSave").hide();
        $("#checkAutoSave").hide();
        $("#saveButton").prop("disabled", true);
        setInterval(triggerSave, 15000);
    });

    $("#eventSelect").select2({
        placeholder: "Pilih Acara",
        tags: true,
        cache: true
    });

    $("#summernoteNote").summernote({
        placeholder: 'Tuliskan catatan disini...',
        height: 1000,
        minHeight: null,
        maxHeight: null,
        focus: !1,
        toolbar: [
            ['style', ['style']],
            ['font', ['bold', 'underline', 'clear']],
            ['color', ['color']],
            ['para', ['ul', 'ol', 'paragraph']],
            ['table', ['table']],
            ['insert', ['link', 'picture', 'video']],
            ['view', ['fullscreen', 'codeview', 'help']]
        ]
    });

    function triggerSave(){
        $("#saveButton").prop("disabled", false);
        $("#spinnerAutoSave").show();
            $("#checkAutoSave").hide();
            autoSave();
            setTimeout(function() {
                $("#spinnerAutoSave").hide();
                $("#checkAutoSave").show();
            }, 3000);
    }

    function autoSave() {
        var note_title = $("input[name=note_title]").val();
        var note_date = $("input[name=note_date]").val();
        var note_content = $("#summernoteNote").val();
        var event_id = $("#eventSelect").val();
        var _token = $("input[name=_token]").val();
        var method = $("input[name=_method]").val();
        var note_id = $("#note_id").val();

        if (note_id == undefined) {
            note_id = '';
        }

        var requestData = {
            id: note_id,
            note_title: note_title,
            note_date: note_date,
            note_content: note_content,
            event_id: event_id,
            status: 0,
            _token: _token,
            _method: method
        }

        $.ajax({
            url: `{{ url('admin/note/autosave') }}`,
            method: "POST",
            headers: {
                'X-CSRF-TOKEN': "{{csrf_token()}}"
            },
            data: requestData,
            success: function(data) {
                if (data) {
                    $("#note_id").val(data.id);
                }

            },
            error: function(data) {
                console.log(data);
            }
        });
    }

    function saveNote()
    {
        var note_id = $("#note_id").val();
        var url = `{{ url('admin/note/${note_id}/store') }}`;
        $("#noteForm").attr('action', url);
        $('#noteForm').submit();
    }
</script>
@endpush
