<!--**********************************
Sidebar start
***********************************-->
<div class="deznav">
<div class="deznav-scroll">
    <ul class="metismenu" id="menu">
    {{-- <li><a class="ai-icon" href="{{ route('admin.dashboard.index') }}" aria-expanded="false">
        <i class="flaticon-381-pad"></i>
        <span class="nav-text">Dashboard</span>
    </a>
    </li> --}}
    <li><a class="ai-icon" href="{{ route('admin.event.index') }}" aria-expanded="false">

        <i class="flaticon-381-blueprint"></i>
        <span class="nav-text">Acara</span>
    </a>
    </li>

    <li><a class="ai-icon" href="{{ route('admin.finance.index') }}" aria-expanded="false">
        <i class="flaticon-381-list-1"></i>
        <span class="nav-text">Keuangan</span>
    </a>
    </li>

    <li><a class="ai-icon" href="{{ route('admin.note.index') }}" aria-expanded="false">
        <i class="flaticon-381-networking"></i>
        <span class="nav-text">Catatan</span>
    </a>

    </li>
    <li><a class="ai-icon" href="{{ route('admin.member.index') }}" aria-expanded="false">
        <i class="flaticon-381-user-9"></i>
        <span class="nav-text">Member</span>
    </a>

    </li>

    <li><a class="ai-icon" href="{{ route('admin.tag.index') }}" aria-expanded="false">
        <i class="flaticon-381-price-tag"></i>
        <span class="nav-text">Tag</span>
    </a>

    </li>



    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
        <i class="flaticon-381-settings-2"></i>
        <span class="nav-text">Lain lain</span>
    </a>
    <ul aria-expanded="false">
        <li><a href="{{ route('admin.financial-category.index') }}">Kategori Finansial</a></li>
        <li><a href="{{ route('admin.user.index') }}">Manajemen Admin</a></li>
    </ul>
    </li>


    </ul>
    <div class="add-menu-sidebar">
        <a href="{{ route('admin.event.create') }}" class="d-flex align-items-center">
            <img src="{{ asset('images/calendar.png') }}" alt="" class="mr-3">
            <p class="font-w500 mb-0">Buat Acara</p>
        </a>
    </div>
    <div class="copyright">
    <p><strong>Karisma Admin Dashboard</strong> © {{ now()->year }} All Rights Reserved</p>
    <p>Made with 💙 by アシャン</p>
    </div>
</div>
</div>
<!--**********************************
Sidebar end
***********************************-->
