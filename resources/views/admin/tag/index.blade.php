@extends('admin.layout.default')

@section('content')
<div class="container-fluid">
    @include('admin.elements.breadcrumb')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $data['card_title'] }}</h4>

                    <button data-toggle="modal" data-target="#addTagModal" class="btn btn-primary">Tambah Tag</button>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table id="example5" class="display min-w850">
                        <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Tag</th>
                            <th class="text-center">Jumlah Member</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($data['tags'] as $item )
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item['tag_name'] }}</td>
                            <td class="text-center">
                                <span class="badge badge-success light">
                                    {{ $item['members_count'] }}</td>
                                </span>
                            <td>
                                <div class="row d-flex justify-content-center">
                                    <span data-toggle="tooltip" title="Edit">
                                        <button data-toggle="modal" data-target="#editTagModal-{{ $item['id'] }}" class="btn btn-warning shadow btn-xs sharp mr-1">
                                            <i class="fa-solid fa-pencil" style="color: white"></i></button>
                                    </span>

                                    <span data-toggle="tooltip" title="Hapus">
                                        <button onclick="sweetConfirm(`tag/{{ $item['id'] }}/delete`, 'Tag')" class="btn btn-danger shadow btn-xs sharp mr-1"><i class="fas fa-trash"></i></button>
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
<div class="modal fade" id="addTagModal" style="display: none;" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Tambah Tag</h5>
            <button type="button" class="close" data-dismiss="modal"><span>×</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="single-upload"action="{{ route('admin.tag.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="basic-form">
                        <div class="form-group">
                            <label class="text-label">Nama Tag</label>
                            <input type="text" class="form-control" placeholder="Masukkan Nama Tag" name="tag_name" required>
                        </div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger light" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Tambah</button>
        </div>
    </form>
        </div>
    </div>
</div>

@foreach ($data['tags'] as $tag )
<div class="modal fade" id="editTagModal-{{ $tag['id'] }}" style="display: none;" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Tag</h5>
            <button type="button" class="close" data-dismiss="modal"><span>×</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="single-upload"action="{{ route('admin.tag.update', ['tag' => $tag]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="basic-form">
                        <div class="form-group">
                            <label class="text-label">Nama Tag</label>
                            <input type="text" class="form-control" placeholder="Masukkan Nama Tag" name="tag_name" value="{{ old('tag_name', $tag['tag_name']) }}" required>
                        </div>
                </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-danger light" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-primary">Edit</button>
        </div>
    </form>
        </div>
    </div>
</div>
@endforeach
@endsection

