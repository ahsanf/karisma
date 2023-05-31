@extends('admin.layout.default')

@section('content')
<div class="container-fluid">
    @include('admin.elements.breadcrumb')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $data['card_title'] }}</h4>

                    <button data-toggle="modal" data-target="#addMemberModal" class="btn btn-primary">Tambah Member</button>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table id="example5" class="display min-w850">
                        <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama</th>
                            <th>No HP</th>
                            <th class="text-center">Tag</th>
                            <th class="text-center" width="10%">RT</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($data['members'] as $item )
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item['member_name'] }}</td>
                            <td>{{ $item['member_phone'] }}</td>
                            <td class="text-center">
                                <div class="row d-flex justify-content-center">
                                    @foreach ($item['tag'] as $tag)
                                    <span class="badge light badge-primary mr-2">{{ $tag->tag_name }}</span>
                                    @endforeach
                                </div>

                            </td>
                            <td class="text-center">
                                <span class="badge light badge-success">RT {{ $item['member_neighborhood'] }}</span>
                            <td>
                                <div class="row d-flex justify-content-center">
                                    <span data-toggle="tooltip" title="Edit">
                                        <button class="btn btn-warning shadow btn-xs sharp mr-1">
                                            <i class="fa-solid fa-pencil" style="color: white"></i></button>
                                    </span>

                                    <span data-toggle="tooltip" title="Hapus">
                                        <button onclick="sweetConfirm(`member/{{ $item['id'] }}/delete`, 'Member')" class="btn btn-danger shadow btn-xs sharp mr-1"><i class="fas fa-trash"></i></button>
                                    </span>
                                </div>
                            </td>
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
<div class="modal fade" id="addMemberModal" style="display: none;" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Tambah Member</h5>
            <button type="button" class="close" data-dismiss="modal"><span>×</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="single-upload"action="{{ route('admin.member.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="basic-form">
                        <div class="form-group">
                            <label class="text-label">Nama Lengkap</label>
                            <input type="text" class="form-control" placeholder="Masukkan Nama Lengkap" name="member_name" required>
                        </div>

                        <div class="form-group">
                            <label for="" class="text-label">No HP</label>
                            <input type="text" class="form-control" placeholder="Masukkan No HP, contoh: 628121212121" name="member_phone" required>
                        </div>

                        <div class="form-group">
                            <label for="" class="text-label">Pilih Tag (Opsional)</label>
                            <select id="multi-select-tag" name="tags[]" class="multi-select-tag" multiple="multiple">
                                <option></option>
                                @foreach ($data['tags'] as $tag)
                                <option value="{{ $tag->id }}">{{ $tag->tag_name }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="" class="text-label">Pilih RT (Opsional)</label>
                            <select id="select-neighboor" name="member_neighborhood">
                                <option></option>
                                @php
                                    $neighborhoods = ['00', '01', '02', '05', '06'];
                                @endphp
                                @foreach ( $neighborhoods as $neighborhood )
                                <option value="{{ $neighborhood }}">RT {{ $neighborhood }}</option>
                                @endforeach
                            </select>
                        </div>


                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger light" data-dismiss="modal">Cancel</button>
            <button type="submit" class="btn btn-primary">Tambah</button>
        </div>
    </form>
        </div>
    </div>
    </div>
@endsection

@push('custom_js')
<script>
    $(document).ready(function(){
        $(".select2-search__field").css({"width": "300%","margin-left": "5%"});
        $.fn.modal.Constructor.prototype._enforceFocus = function() {};
        $("#multi-select-tag").select2({
            dropdownParent: $('#addMemberModal'),
            placeholder: "Pilih Tag",
            tags: true,
            cache: true
        });

        $("#select-neighboor").select2({
            placeholder: "Pilih RT",
            tags: true,
            cache: true
        });
    })
</script>
@endpush
