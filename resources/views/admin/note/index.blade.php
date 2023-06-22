@extends('admin.layout.default')

@section('content')
<div class="container-fluid">
    @include('admin.elements.breadcrumb')

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $data['card_title'] }}</h4>

                    <a href="{{ route('admin.note.create') }}" class="btn btn-primary">Tambah Catatan</a>

                </div>
                <div class="card-body">
                    <div class="table-responsive">
                    <table id="example5" class="display min-w850">
                        <thead>
                        <tr>
                            <th width="5%">No</th>
                            <th class="text-center">Judul</th>
                            <th class="text-center">Tanggal</th>
                            <th class="text-center">Acara</th>
                            <th class="text-center">Status</th>
                            <th class="text-center">Aksi</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach ($data['notes'] as $item )
                        <tr>
                            <td class="text-center">{{ $loop->iteration }}</td>
                            <td class="text-center">{{ $item['note_title'] }}</td>
                            <td class="text-center">{{ $item->dateString($item['note_date']) }}</td>
                            <td class="text-center">{{ $item['event']['event_name'] ?? '-' }}</td>
                            <td class="text-center">
                                @if ($item['status'] == 0)
                                    <span class="badge badge-warning light">Draft</span>
                                @elseif($item['status'] == 1)
                                    <span class="badge badge-success light">Published</span>
                                @endif
                            </td>
                            <td>
                                <div class="row d-flex justify-content-center">
                                    <span data-toggle="tooltip" title="Edit">
                                        <a href="{{ route('admin.note.edit', ['note' => $item['id']]) }}" class="btn btn-warning shadow btn-xs sharp mr-1">
                                            <i class="fa-solid fa-pencil" style="color: white"></i></a>
                                    </span>

                                    <span data-toggle="tooltip" title="Hapus">
                                        <button onclick="sweetConfirm(`note/{{ $item['id'] }}/delete`, 'Acara')" class="btn btn-danger shadow btn-xs sharp mr-1"><i class="fas fa-trash"></i></button>
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

