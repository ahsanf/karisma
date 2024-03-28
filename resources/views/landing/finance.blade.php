@extends('layout.app-fullwidth')

@section('content')
<div class="container pt-5 pb-5">
    <div class="d-flex justify-content-center mb-10 mt-10">
        <h2><b>KEUANGAN KARISMA</b></h2>
    </div>
</div>
<div class="container pt-5 pb-5">
    <div class="row">
        <div class="col">
            <p>
                Di Karisma, kami menjunjung tinggi prinsip transparansi dan akuntabilitas dalam pengelolaan keuangan organisasi.
                Sebagai organisasi non profit, kami mengandalkan dukungan donasi dari para dermawan dan masyarakat.
                Oleh karena itu, kami berkomitmen untuk memastikan setiap rupiah yang diterima digunakan secara bertanggung jawab untuk mendukung program-program kami.
            </p>
        </div>
        <div class="col">
            <img src="{{ asset('landing/img/video_opini.png') }}" alt="" class="img-fluid">
        </div>
    </div>
</div>
<div class="container-fluid">
    <div class="row">
        <div class="col">
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
        <div class="col">
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
        <div class="col">
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
                <div class="card-header d-block pb-0 border-0">
                    <div class="d-sm-flex flex-wrap align-items-center justify-content-between d-block mb-md-3 mb-0">
                        <div class="basic-form">
                            <form class="form-inline" method="get">
                                <div class="form-group mb-3 mr-3">
                                    <select class="form-control default-select filter-select" name="financial_type" id="filterType">

                                        <option disabled @if(empty(Request::get('financial_type')))selected @endif>Filter Tipe</option>
                                        <option value="income" @if(Request::get('financial_type') == 'income') selected @endif>Pemasukan</option>
                                        <option value="expense" @if(Request::get('financial_type') == 'expense') selected @endif>Pengeluaran</option>
                                    </select>
                                </div>

                                <div class="form-group mb-3 mr-3">
                                    <select class="form-control default-select filter-select" name="financial_year" id="filterType">

                                        <option disabled @if(empty(Request::get('financial_year')))selected @endif>Filter Tahun</option>
                                        @php
                                            $years = [2021, 2022, 2023, 2024];
                                        @endphp
                                        @foreach ($years as $item)
                                        <option value="{{ $item }}" @if(Request::get('financial_year') == $item) selected @endif>{{ $item }}</option>
                                        @endforeach

                                    </select>
                                </div>

                                <div class="form-group mb-3 mr-3">
                                    <select multiple class="form-control default-select filter-select" name="financial_category_id[]" id="filterCategory">
                                        @php
                                            $selected = Request::get('financial_category_id') ?? [];
                                        @endphp
                                        @foreach ($data['categories'] as $category)
                                            <option value="{{ $category['id'] }}" @if(in_array($category['id'], $selected)) selected @endif>{{ $category['category_name'] }}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button data-toggle="tooltip" title="Terapkan Filter" type="submit" class="btn rounded btn-primary mb-3 mr-3"><i class="fas fa-filter"></i></button>
                                @if(!empty(Request::all()))
                                <a data-toggle="tooltip" title="Reset filter" href="{{ route('landing.finance') }}" class="btn rounded btn-danger mb-3 mr-3"><i class="fas fa-undo"></i></a>
                                @endif
                            </form>

                        </div>
                      </div>

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
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($data['financials'] as $item )
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item['financial_name'] }}</td>
                            <td class="text-center">{{ "Rp " . number_format($item['financial_amount'],0,',','.') }}</td>
                            <td class="text-center">{{ $item->dateString($item['financial_date']) }}</td>
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
@endsection
