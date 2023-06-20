@extends('admin.layout.default')

@section('content')
<div class="container-fluid">
    @include('admin.elements.breadcrumb')
    <div class="row">

        <div class="col-sm-4">
            <div class="card avtivity-card">
            <div class="card-body">
                <div class="media align-items-center">
                <span class="activity-icon bgl-success mr-md-4 mr-3">
                    <i class="fa-solid fa-right-to-bracket fa-xl" style="color: #2BC155;"></i>
                </span>
                <div class="media-body">
                    <p class="fs-14 mb-2">Pemasukan</p>
                    <span class="title text-black font-w600">{{ "Rp " . number_format($data['total_income'],0,',','.') }}</span>
                </div>
                </div>
                <div class="progress" style="height:5px;">
                <div class="progress-bar bg-success" style="width: 0%; height:5px;" role="progressbar">
                    <span class="sr-only"></span>
                </div>
                </div>
            </div>
            <div class="effect bg-success"></div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card avtivity-card">
            <div class="card-body">
                <div class="media align-items-center">
                <span class="activity-icon bgl-danger mr-md-4 mr-3">
                    <i class="fa-solid fa-right-from-bracket fa-xl" style="color: #F94687;"></i>
                </span>
                <div class="media-body">
                    <p class="fs-14 mb-2">Pengeluaran</p>
                    <span class="title text-black font-w600">{{ "Rp " . number_format($data['total_expense'],0,',','.') }}</span>
                </div>
                </div>
                <div class="progress" style="height:5px;">
                <div class="progress-bar bg-danger" style="width: 0%; height:5px;" role="progressbar">
                    <span class="sr-only"></span>
                </div>
                </div>
            </div>
            <div class="effect bg-danger"></div>
            </div>
        </div>
        <div class="col-sm-4">
            <div class="card avtivity-card">
            <div class="card-body">

                <div class="media align-items-center">
                    <span class="activity-icon bgl-primary mr-md-4 mr-3">
                        <i class="fa-solid fa-money-bill-wave fa-xl" style="color: #0B2A97;"></i>
                    </span>
                <div class="media-body">
                    <p class="fs-14 mb-2">Saldo</p>
                    <span class="title text-black font-w600">{{ "Rp " . number_format($data['total_balance'],0,',','.') }}</span>
                </div>
                </div>
                <div class="progress" style="height:5px;">
                <div class="progress-bar bg-primary" style="width: 0%; height:5px;" role="progressbar">
                    <span class="sr-only"></span>
                </div>
                </div>
            </div>
            <div class="effect bg-primary"></div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $data['card_title'] }}</h4>

                    <button data-toggle="modal" data-target="#addFinanceModal" class="btn btn-primary">Tambah Data</button>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table id="example5" class="display min-w850">
                        <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th>Nama</th>
                            <th class="text-center">Jumlah</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Tipe</th>
                            <th class="text-center">Kategori</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($data['financials'] as $item )
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item['financial_name'] }}</td>
                            <td class="text-center">{{ "Rp " . number_format($item['financial_amount'],0,',','.') }}</td>
                            <td class="text-center">{{ $item['financial_date'] }}</td>
                            <td class="text-center">
                                @if($item['financial_type'] == 'income')
                                <span class="badge badge-success light">
                                    Pemasukan
                                </span>
                                @elseif($item['financial_type'] == 'expense')
                                <span class="badge badge-danger light">
                                    Pengeluaran
                                </span>
                                @endif
                            </td>
                            <td class="text-center">
                                <span class="badge badge-primary light">
                                    {{ $item['category']['category_name'] }}
                                </span>
                            </td>
                            <td>
                                <div class="row d-flex justify-content-center">
                                    @if($item['file_path'] != null)
                                    <span data-toggle="tooltip" title="Lihat File">
                                        <button class="btn btn-success shadow btn-xs sharp mr-1" onclick="showFile(`{{ \Crypt::encryptString($item['id']) }}`)"><i class="fas fa-eye"></i></button>
                                    </span>
                                    @endif
                                    <span data-toggle="tooltip" title="Edit">
                                        <button data-toggle="modal" data-target="#editFinanceModal-{{ $item['id'] }}" class="btn btn-warning shadow btn-xs sharp mr-1">
                                            <i class="fa-solid fa-pencil" style="color: white"></i></button>
                                    </span>

                                    <span data-toggle="tooltip" title="Hapus">
                                        <button onclick="sweetConfirm(`finance/{{ $item['id'] }}/delete`, 'Keuangan')" class="btn btn-danger shadow btn-xs sharp mr-1"><i class="fas fa-trash"></i></button>
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

<div class="modal fade" id="addFinanceModal" style="display: none;" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Tambah Keuangan</h5>
            <button type="button" class="close" data-dismiss="modal"><span>×</span>
            </button>
        </div>
        <div class="modal-body">
            <form id="single-upload"action="{{ route('admin.finance.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="basic-form">
                    <div class="form-group">
                        <label class="text-label">Nama</label>
                        <input type="text" class="form-control" placeholder="Masukkan Nama" name="financial_name" required>
                    </div>

                    <div class="form-group">
                        <label class="text-label">Tanggal</label>
                        <input type="text" class="form-control" placeholder="Masukkan Tanggal" id="mdate" name="financial_date" value="{{ old('event_date') }}" required>
                    </div>

                    <div class="form-group">
                        <label for="" class="text-label">Jumlah</label>
                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text">Rp</span>
                            </div>
                            <input type="text" class="form-control" id="inputAmount" placeholder="Masukkan Jumlah" required>
                            </div>
                        <input type="hidden" id="amountVal" name="financial_amount">
                    </div>

                    <div class="form-group">
                        <label for="" class="text-label">Tipe</label>
                        <div class="d-flex">
                            <div class="btn-group btn-group-toggle" data-toggle="buttons">
                                <label class="btn btn-outline-success btn-sm">
                                    <input type="radio" name="financial_type" id="option1" autocomplete="off" value="income"> Pemasukan
                                </label>
                                <label class="btn btn-outline-danger btn-sm">
                                    <input type="radio" name="financial_type" id="option2" autocomplete="off" value="expense"> Pengeluaran
                                </label>
                            </div>
                        </div>
                    </div>

                    <div class="form-group">
                        <label for="" class="text-label">Pilih Kategori</label>
                        <select id="selectCategory" name="financial_category_id" >
                            <option disabled selected>Silahkan Pilih Kategori<option>
                            @foreach ($data['categories'] as $category)
                            <option value="{{ $category['id'] }}">{{ $category['category_name'] }}</option>
                            @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="" class="text-label">Upload file</label>
                            <div class="input-group mb-3">

                                <div class="input-group-prepend">
                                    <span class="input-group-text">Upload</span>
                                </div>
                                <div class="custom-file">
                                    <input type="file" id="inputFile" name="financial_file" class="custom-file-input" onchange="showPreview(event);">
                                    <label class="custom-file-label">Pilih file</label>
                                </div>

                            </div>
                            <small class="text-danger">*Ekstensi file harus jpg,jpeg, atau png. Maksimal 2 MB</small>
                    </div>

                    <div class="row">
                        <img id="imgPreview" src="#" alt="Image" style="display:none;width:0%;"/>
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

<div class="modal fade" id="showImage" style="display: none;" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Preview</h5>
            <button type="button" class="close" data-dismiss="modal"><span>×</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="row">
                <img id="financeImage" src="" alt="Image" style="width:100%;"/>
            </div>

        </div>

        <div class="modal-footer">
            <button type="button" class="btn btn-danger light" data-dismiss="modal">Tutup</button>
        </div>
    </div>
</div>
@endsection
@push('custom_js')
<script>
    $(document).ready(function() {
        $('#inputAmount').keyup(function() {
            const value = $(this).val();
            $('#amountVal').val(value.replace(/\./g, ''));
            $(this).val(formatRupiah(value, undefined));
        });

        $('#selectCategory').select2({
            dropdownParent: $('#addFinanceModal'),
            placeholder: "Pilih Kategori",
        });

        $('#inputFile').onchange = evt => {
        const [file] = imgInp.files
        if (file) {
            imgPreview.src = URL.createObjectURL(file)
            }
        }
    } );

    function showPreview(event){
        if(event.target.files.length > 0){
            var src = URL.createObjectURL(event.target.files[0]);
            var preview = $("#imgPreview");
            preview.attr('src', src);
            preview.css('display', 'block');
        }
    }

    function showFile(id){
        $.ajax({
            url: `{{ url('/misc') }}/${id}/image`,
            type: 'GET',
            dataType: 'json',
            cache: true,
            success: function(result) {
                console.log(result);
                $('#financeImage').attr('src', result.data);
                $('#showImage').modal('show');
            }
        })
    }

    function formatRupiah(angka, prefix){
        var number_string = angka.replace(/[^,\d]/g, '').toString(),
        split   		= number_string.split(','),
        sisa     		= split[0].length % 3,
        rupiah     		= split[0].substr(0, sisa),
        ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);

        if(ribuan){
            separator = sisa ? '.' : '';
            rupiah += separator + ribuan.join('.');
        }
        rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
        return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
		}
</script>

@endpush

