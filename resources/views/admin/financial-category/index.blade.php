@extends('admin.layout.default')

@section('content')
<div class="container-fluid">
    @include('admin.elements.breadcrumb')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $data['card_title'] }}</h4>

                    <button data-toggle="modal" data-target="#addCategoryModal" class="btn btn-primary">Tambah Tag</button>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table id="example5" class="display min-w850">
                        <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama Kategori</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($data['financial_categories'] as $item )
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item['category_name'] }}</td>
                            <td>
                                <div class="row d-flex justify-content-center">
                                    <span data-toggle="tooltip" title="Edit">
                                        <button data-toggle="modal" data-target="#editCategoryModal-{{ $item['id'] }}" class="btn btn-warning shadow btn-xs sharp mr-1">
                                            <i class="fa-solid fa-pencil" style="color: white"></i></button>
                                    </span>

                                    <span data-toggle="tooltip" title="Hapus">
                                        <button onclick="sweetConfirm(`financial-category/{{ $item['id'] }}/delete`, 'Kategori')" class="btn btn-danger shadow btn-xs sharp mr-1"><i class="fas fa-trash"></i></button>
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
<div class="modal fade" id="addCategoryModal" style="display: none;" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Tambah Kategori</h5>
            <button type="button" class="close" data-dismiss="modal"><span>×</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="single-upload"action="{{ route('admin.financial-category.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="basic-form">
                        <div class="form-group">
                            <label class="text-label">Nama Kategori</label>
                            <input type="text" class="form-control" placeholder="Masukkan Nama Kategori" name="category_name" required>
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

@foreach ($data['financial_categories'] as $category )
<div class="modal fade" id="editCategoryModal-{{ $category['id'] }}" style="display: none;" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Edit Kategori</h5>
            <button type="button" class="close" data-dismiss="modal"><span>×</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="single-upload"action="{{ route('admin.financial-category.update', ['financial_category' => $category]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('put')
                <div class="basic-form">
                        <div class="form-group">
                            <label class="text-label">Nama Kategori</label>
                            <input type="text" class="form-control" placeholder="Masukkan Nama Kategori" name="category_name" value="{{ $category['category_name'] }}" required>
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

