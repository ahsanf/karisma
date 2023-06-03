<!--**********************************
Sidebar start
***********************************-->
<div class="deznav">
<div class="deznav-scroll">
    <ul class="metismenu" id="menu">
    <li><a class="ai-icon" href="{{ route('admin.dashboard.index') }}" aria-expanded="false">
        <i class="flaticon-381-pad"></i>
        <span class="nav-text">Dashboard</span>
    </a>
    </li>
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


    <li><a class="ai-icon" href="javascript:void(0)" aria-expanded="false">
        <i class="flaticon-381-networking"></i>
        <span class="nav-text">Inventaris</span>
    </a>

    </li>

    <li><a class="has-arrow ai-icon" href="javascript:void()" aria-expanded="false">
        <i class="flaticon-381-settings-2"></i>
        <span class="nav-text">Lain lain</span>
    </a>
    <ul aria-expanded="false">
        <li><a href="javascript:void(0)">Admin Management</a></li>
        {{-- <li><a href="javascript:void(0)" class="has-arrow" aria-expanded="false">Trash</a>
        <ul aria-expanded="false">
            <li><a href="{{ route('admin.trash.index', ['type' => 'icon']) }}">Icon</a></li>
            <li><a href="{{ route('admin.trash.index', ['type' => 'category']) }}">Category</a></li>
            <li><a href="{{ route('admin.trash.index', ['type' => 'style']) }}">Style</a></li>
            <li><a href="{{ route('admin.trash.index', ['type' => 'hashtag']) }}">Hashtag</a></li>
        </ul>
        </li> --}}
    </ul>
    </li>


    </ul>
    {{-- <div class="add-menu-sidebar">
    <img src="{{ asset('images/calendar.png') }}" alt="" class="mr-3">
    <p class="	font-w500 mb-0">Create Workout Plan Now</p>
    </div> --}}
    <div class="copyright">
    <p><strong>Karisma Admin Dashboard</strong> © {{ now()->year }} All Rights Reserved</p>
    <p>Made with 💙 by アシャン</p>
    </div>
</div>
</div>
<!--**********************************
Sidebar end
***********************************-->
