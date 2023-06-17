{{-- Extends layout --}}
@extends('admin.layout.default')

{{-- Content --}}
@section('content')
<div class="container-fluid">
    @include('admin.elements.breadcrumb')
    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h4 class="card-title">{{ $data['page_title'] }}</h4>
                    <button class="btn btn-primary" data-toggle="modal" data-target="#userNewModal">Add New Admin<i class="fa-solid fa-plus ml-2"></i></button>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table id="example" class="display min-w850">
                            <thead>
                                <tr>
                                    <th width="5%">No</th>
                                    <th>Name</th>
                                    <th>Username</th>
                                    <th>Email</th>
                                    <th>Action</th>
                                </tr>
                            </thead>
                            <tbody>

                                @foreach ($data['users'] as $item )
                                <tr>
                                    <td class="text-center">
                                        {{ $loop->iteration }}
                                       </td>
                                    <td>{{ $item->name }}</td>
                                    <td class="text-center">{{ $item->username ?? '-'}}</td>
                                    <td class="text-center">{{ $item->email ?? '-'}}</td>

                                    <td class="text-center">
                                        @if($item->email != 'admin@admin.com')
                                        <div class="d-flex justify-content-center">
                                        <span data-toggle="modal" data-target="#userEditModal-{{$item->id}}">

                                                <button type="button"  data-toggle="tooltip" data-placement="top" title="Edit" class="btn btn-primary shadow btn-xs sharp mr-1" ><i class="fa fa-pencil"></i> </a>
                                            </span>

                                            <button type="button" onclick="sweetConfirm('/admin/user/{{ $item->id }}/destroy', 'Admin')" class="btn btn-danger shadow btn-xs sharp" data-toggle="tooltip" data-placement="top" title="Delete"><i class="fa fa-trash"></i></button>

                                          </div>
                                          @else
                                          -
                                          @endif
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
<div class="modal fade" id="userNewModal" style="display: none;" aria-modal="true">
    <div class="modal-dialog modal-lg" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title">Add Admin</h5>
          <button type="button" class="close" data-dismiss="modal"><span>×</span>
          </button>
        </div>
        <div class="modal-body">
            <form action="{{ route('admin.user.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="basic-form">
                    <div class="form-group">
                        <label class="text-label">Name</label>
                        <input type="text" class="form-control" placeholder="Fill Name" name="name">
                    </div>
                    <div class="form-group">
                        <label class="text-label">Email</label>
                        <input type="email" class="form-control" placeholder="Fill Email" name="email">
                    </div>

                    <div class="form-row">

                        <div class="form-group col-md-6">
                            <label class="text-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control "
                                placeholder="Fill Password" required>
                            {{-- invalid-feedback --}}
                            <div class="invalid-feedback animated fadeInUp" style="display: block;"></div>
                        </div>
                        <div class="form-group col-md-6">
                            <label class="text-label" style="color: white">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password-confirmation"
                                onchange="checkPassword();" onkeyup="this.onchange();" onpaste="this.onchange();"
                                oninput="this.onchange();" class="form-control " placeholder="Confirm Password"
                                required>
                            {{-- invalid-feedback --}}
                            <div class="invalid-feedback animated fadeInUp" style="display: block;"
                                id="password_confirmation_error">
                            </div>
                        </div>
                    </div>
                </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-danger light" data-dismiss="modal">Cancel</button>
          <button type="submit" class="btn btn-primary">Add</button>
        </div>
    </form>
      </div>
    </div>
</div>
@foreach ($data['users'] as $item )
    <div class="modal fade" id="userEditModal-{{ $item->id }}" style="display: none;" aria-modal="true">
        <div class="modal-dialog modal-lg" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Admin</h5>
                <button type="button" class="close" data-dismiss="modal"><span>×</span>
                </button>
            </div>
            <div class="modal-body">
                <form action="{{ route('admin.user.update', $item) }}" method="post" enctype="multipart/form-data">
                    @csrf
                    @method('put')
                    <div class="basic-form">
                    <div class="form-group">
                        <label class="text-label">Name</label>
                        <input type="text" class="form-control" placeholder="Fill Name" name="name" value="{{ $item->name }}">
                    </div>
                    <div class="form-group">
                        <label class="text-label">Email</label>
                        <input type="email" class="form-control" placeholder="Fill Email" name="email" value="{{ $item->email }}">
                    </div>
                    <div class="form-group">
                        <label class="text-label">Password</label>
                        <div class="d-flex">
                            <button type="button" class="btn btn-primary btn-sm change-password" >Change Password</button>
                            <button type="button" style="display:none;" class="btn btn-danger btn-sm light close-change-password ml-2">Cancel</button>
                        </div>
                    </div>
                    <div class="form-row password-form" style="display:none;">
                        <div class="form-group col-md-6 ">
                            <label for="password">New Password</label>
                            <input class="form-control password" type="password" name="password" placeholder="Fill New Password">
                        </div>
                        <div class="form-group col-md-6">
                            <label class="text-label">Confirm New Password</label>
                            <input class="form-control confirm-password" type="password" aria-describedbytype="messagae" name="password_confirmation"
                                onchange="checkPassword();" onkeyup="this.onchange();" onpaste="this.onchange();"
                                oninput="this.onchange();" class="form-control " placeholder="Confirm New Password"/>
                            <div class="invalid-feedback animated fadeInUp" style="display: block;">
                            </div>
                        </div>
                    </div>
                    </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-danger light" data-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Save</button>
            </div>
        </form>
        </div>
        </div>
    </div>
@endforeach
@endsection
@push('custom_js')
<script>


    function checkPassword() {
            let password = $("#password").val();
            let passwordConf = $("#password-confirmation").val();
            if (password !== passwordConf) {
                $('#password_confirmation_error').html('Kata sandi tidak sama')
            } else {
                $('#password_confirmation_error').html('')
            }
    }

    $('.change-password').on('click', function() {
            $('.password-form').css("display", "");
            $('.close-change-password').css("display", "");
        });

        $('.close-change-password').on('click', function() {
            $('.password-form').css("display", "none");
            $('.password, .confirm-password').val('');
            $(this).hide();
        });;

</script>

@endpush
