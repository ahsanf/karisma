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
                            <th>Acara</th>
                            <th>Tanggal</th>
                            <th class="text-center" width="10%">Tipe</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($data['events'] as $item )
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td>{{ $item['event_name'] }}</td>
                            <td>{{ $item['event_date'] }}</td>
                            <td class="text-center">
                                @if($item['event_type'] == 1)
                                <span class="badge light badge-success">Semua Member</span>
                                @else
                                <span class="badge light badge-warning">Member Pilihan</span>
                                @endif
                            <td>
                                <div class="row d-flex justify-content-center">
                                    <span data-toggle="tooltip" title="Edit">
                                        <button class="btn btn-warning shadow btn-xs sharp mr-1">
                                            <i class="fa-solid fa-pencil" style="color: white"></i></button>
                                    </span>

                                    <span data-toggle="tooltip" title="Hapus">
                                        <button onclick="sweetConfirm(`event/{{ $item['id'] }}/delete`, 'Event')" class="btn btn-danger shadow btn-xs sharp mr-1"><i class="fas fa-trash"></i></button>
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
@endsection