<!DOCTYPE html>
<html lang="en" class="h-100">

<head>
    <!-- Favicon icon -->
    <title>{{ config('dz.name') }} | @yield('title', $data['page_title'] ?? '')</title>
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon.png') }}">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/custom.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;200;300;400;500;600;700;800;900&family=Roboto:wght@100;300;400;500;700;900&display=swap" rel="stylesheet">
    @foreach ($data['action'] as $key => $action )
    @if(!empty(config('dz.public.pagelevel.css.'.$action)))
    @foreach(config('dz.public.pagelevel.css.'.$action) as $style)
    <link href="{{ asset($style) }}" rel="stylesheet" type="text/css"/>
    @endforeach
    @endif
    @endforeach
    @if(!empty(config('dz.public.global.css')))
    @foreach(config('dz.public.global.css') as $style)
    <link href="{{ asset($style) }}" rel="stylesheet" type="text/css"/>
    @endforeach
    @endif
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bxslider/4.2.15/jquery.bxslider.css" integrity="sha512-rV4fiystTwIvs71MLqeLbKbzosmgDS7VU5Xqk1IwFitAM+Aa9x/8Xil4CW+9DjOvVle2iqg4Ncagsbgu2MWxKQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    @if (!empty(config('dz.public.pagelevel.css.uc_toastr')))
    @foreach (config('dz.public.pagelevel.css.uc_toastr') as $style)
    <link href="{{ asset($style) }}" rel="stylesheet" type="text/css" />
    @endforeach
    @endif
    <link rel="stylesheet" href="{{ asset('landing/css/landing-font-awesome.min.css') }}" />
</head>
@include('elements.fullwidth-header')
<div id="preloader">
    <div class="sk-three-bounce">
        <div class="sk-child sk-bounce1"></div>
        <div class="sk-child sk-bounce2"></div>
        <div class="sk-child sk-bounce3"></div>
    </div>
</div>
<body class="h-100">
    @yield('banner')

    <div id="main-wrapper" style="background-color: white !important">

        <div class="authincation h-100">
            <div class="container h-100 w-100">

                <div class="row justify-content-center align-items-center">
                    @yield('content')
                </div>
            </div>
        </div>

        @include('elements.fullwidth-footer')
    </div>


</body>


@include('elements.footer-scripts')
{!! Toastr::message() !!}
<!--
 ____                      ___  __              __      __                  ______  __                                   ____
/\  _`\                  /'___\/\ \__          /\ \    /\ \                /\  _  \/\ \                                 /\  _`\
\ \ \/\_\  _ __    __   /\ \__/\ \ ,_\    __   \_\ \   \ \ \____  __  __   \ \ \L\ \ \ \___     ____     __      ___    \ \ \L\_\
 \ \ \/_/_/\`'__\/'__`\ \ \ ,__\\ \ \/  /'__`\ /'_` \   \ \ '__`\/\ \/\ \   \ \  __ \ \  _ `\  /',__\  /'__`\  /' _ `\   \ \  _\/
  \ \ \L\ \ \ \//\ \L\.\_\ \ \_/ \ \ \_/\  __//\ \L\ \   \ \ \L\ \ \ \_\ \   \ \ \/\ \ \ \ \ \/\__, `\/\ \L\.\_/\ \/\ \   \ \ \/
   \ \____/\ \_\\ \__/.\_\\ \_\   \ \__\ \____\ \___,_\   \ \_,__/\/`____ \   \ \_\ \_\ \_\ \_\/\____/\ \__/.\_\ \_\ \_\   \ \_\
    \/___/  \/_/ \/__/\/_/ \/_/    \/__/\/____/\/__,_ /    \/___/  `/___/> \   \/_/\/_/\/_/\/_/\/___/  \/__/\/_/\/_/\/_/    \/_/
                                                                      /\___/
                                                                      \/__/
    -->
</html>
