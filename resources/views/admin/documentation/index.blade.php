@extends('admin.layout.default')

@section('content')
<div class="container-fluid">
    @include('admin.elements.breadcrumb')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $data['card_title'] }}</h4>

                    <button data-toggle="modal" data-target="#addDocumentation" class="btn btn-primary">Tambah Data</button>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table id="example5" class="display min-w850">
                        <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama</th>
                            <th>Url</th>
                            <th>Tanggal</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($data['documentations'] as $item )
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item['name'] }}</td>
                            <td><a href="{{ $item['url'] }}" target="_blank" rel="noopener noreferer">{{ $item['url'] }}</a></td>
                            <td>{{ $item->dateString($item->date) }}</td>
                            <td>
                                <div class="row d-flex justify-content-center">
                                    <span data-toggle="tooltip" title="Edit">
                                        <button data-toggle="modal" data-target="#editDocumentation-{{ $item['id'] }}" class="btn btn-warning shadow btn-xs sharp mr-1">
                                            <i class="fa-solid fa-pencil" style="color: white"></i></button>
                                    </span>

                                    <span data-toggle="tooltip" title="Hapus">
                                        <button onclick="sweetConfirm(`documentation/{{ $item['id'] }}/delete`, 'Dokumentasi')" class="btn btn-danger shadow btn-xs sharp mr-1"><i class="fas fa-trash"></i></button>
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
<div class="modal fade" id="addDocumentation" style="display: none;" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Tambah Data</h5>
            <button type="button" class="close" data-dismiss="modal"><span>×</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="single-upload"action="{{ route('admin.documentation.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="basic-form">
                        <div class="form-group">
                            <label class="text-label">Nama</label>
                            <input type="text" class="form-control" placeholder="Masukkan Nama" name="name" required>
                        </div>

                        <div class="form-group">
                            <label class="text-label">Url</label>
                            <input type="text" class="form-control" placeholder="Masukkan Url" name="url" required>
                        </div>

                        <div class="form-group">
                            <label class="text-label">Tanggal</label>
                            <input type="text" class="form-control" placeholder="Masukkan Tanggal" name="date" id="mdate">
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

@foreach ($data['documentations'] as $item )
<div class="modal fade" id="editDocumentation-{{ $item['id'] }}" style="display: none;" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Dokumentasi</h5>
            <button type="button" class="close" data-dismiss="modal"><span>×</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="single-upload"action="{{ route('admin.documentation.update', ['documentation' => $item]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="basic-form">
                        <div class="form-group">
                            <label class="text-label">Nama</label>
                            <input type="text" class="form-control" placeholder="Masukkan Nama" name="name" value="{{ $item['name'] }}" required>
                        </div>

                        <div class="form-group">
                            <label class="text-label">Url</label>
                            <input type="text" class="form-control" placeholder="Masukkan Url" name="name" value="{{ $item['url'] }}" required>
                        </div>

                        <div class="form-group">
                            <label class="text-label">Tanggal</label>
                            <input type="text" class="form-control" placeholder="Masukkan Tanggal" name="name" value="{{ $item['date'] }}" required>
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

