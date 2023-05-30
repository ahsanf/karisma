    <!--**********************************
    Chat box start
    ***********************************-->

    <!--**********************************
    Chat box End
    ***********************************-->

    <!--**********************************
    Header start
    ***********************************-->
    <div class="header">
    <div class="header-content">
        <nav class="navbar navbar-expand">
        <div class="collapse navbar-collapse justify-content-between">
            <div class="header-left">
            <div class="dashboard_bar">
                @yield('title', $data['page_title'] ?? 'Dashboard')
            </div>
            </div>
            <ul class="navbar-nav header-right">
            <li class="nav-item dropdown header-profile">
                <a class="nav-link" href="javascript:void(0)" role="button" data-toggle="dropdown">

                <img alt="image" src="{{ Avatar::create(Auth::user()->name ?? 'Guest')->toBase64() }}" class="rounded-circle mr-1 thumbnail-rounded user-thumbnail" width="20" alt=""/>
                <div class="header-info">
                    <span class="text-black"><strong>{{ Auth::user()->name ?? 'Guest' }}</strong></span>
                    <p class="fs-12 mb-0">
                    @if(Auth::user() != null)
                        @foreach (Auth::user()->getRoleNames() as $role)
                        {{ ucfirst($role) }}
                        @endforeach
                    @else
                        Guest
                    @endif
                    </p>
                </div>
                </a>
                <div class="dropdown-menu dropdown-menu-right">
                @if(Auth::user() != null)
                    @foreach (Auth::user()->getRoleNames() as $role)
                        @if($role == 'admin')
                        {{-- <a href="{{ route('admin.profile.index')  }}" class="dropdown-item ai-icon"><i class="fa-solid fa-user"></i> <span class="ml-2">Profil</span></a> --}}
                        @endif
                    @endforeach

                @endif

                    <form action="{{ route('logout') }}" method="post">
                    @csrf
                    <button type="submit" href="{{ route('logout') }}" class="dropdown-item ai-icon">
                        <svg id="icon-logout" xmlns="http://www.w3.org/2000/svg" class="text-danger" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path><polyline points="16 17 21 12 16 7"></polyline><line x1="21" y1="12" x2="9" y2="12"></line></svg>
                        <span class="ml-2">Logout </span>
                    </button>
                    </form>
                </div>
            </li>
            </ul>
        </div>
        </nav>
    </div>
    </div>
    <!--**********************************
    Header end ti-comment-alt
    ****
