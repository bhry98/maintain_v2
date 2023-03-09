<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link href="{{ $Sys['App_Logo'] == null ? env('APP_LOGO') : $Sys['App_Logo'] }}" rel="icon">
    <title>{{ $Sys['App_Name'] == null ? env('APP_NAME') : $Sys['App_Name'] }} | @yield('title', 'title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    {{-- @if ($User)
        <meta name="user" content="{{ $User }}">
    @endif --}}
    {{--  --}}
    <link href="{{ mix('assets/css/tabler.min.css') }}" rel="stylesheet" />
    <link href="{{ mix('assets/css/tabler-vendors.min.css') }}" rel="stylesheet" />
    <link href="{{ mix('assets/css/demo.min.css') }}" rel="stylesheet" />
    <link href="{{ url('assets/css/alert.css') }}" rel="stylesheet" />
    <link href="{{ url('assets/css/tabler-flags.min.css') }}" rel="stylesheet" />
    <link href="{{ url('assets/css/tabler-payments.min.css') }}" rel="stylesheet" />
    {{--  --}}
    
    @yield('css')
    @livewireStyles
    {{-- @powerGridStyles --}}
</head>

<body>
    {{-- {{ array_keys(config('roles.Roles')) }} --}}
    {{-- @foreach (config('roles.Roles') as $k => $item)
        {{ __("roles.Names.$k") }}
        <br>
        ..............................

        <br>
        @foreach ($item as $kk => $i)
            {{ $i['ar'] }} ({{ $k }}-{{ $kk }})<br>
        @endforeach

        ......................
        <br>
    @endforeach --}}
    <div class="page">
        @auth('emp')
            @include('layout.header.emp')
            @include('layout.nav.emp')
        @endauth
        @auth('cli')
            @include('layout.header.cli')
            @include('layout.nav.cli')
        @endauth
        <div dir="{{ __('app.HTML') }}" class="page-wrapper">
            <div class="container-xl">
                <div class="page-header d-print-none">
                    <div class="row align-items-center">
                        <div class="col">
                            <h2 class="page-title">
                                @yield('pagetitle', 'pagetitle')
                            </h2>
                            <p>
                                @yield('subptittle')
                            </p>
                        </div>
                        <div class="col-auto ms-auto d-print-none">
                            @yield('action')
                        </div>
                    </div>
                </div>
            </div>
            <div class="page-body">
                <div class="container-xl">
                    @yield('page', 'page')
                </div>

            </div>
            {{-- @include('layout.footer') --}}
        </div>
    </div>
    {{-- <script src="{{ mix('assets/js/app.js') }}"></script> --}}
    <script src="{{ mix('assets/js/tabler.min.js') }}"></script>
    <script src="{{ mix('assets/js/demo.min.js') }}"></script>
    <script src="{{ url('assets/js/alert.js') }}"></script>
    <script src="{{ url('assets/js/bhry98.js') }}"></script>
    <script src="{{ url('assets/js/chart.js') }}"></script>
    <script src="{{ url('assets/js/chart-tabler.js') }}"></script>
    @yield('js')
    {{-- <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
    <script defer src="https://unpkg.com/@alpinejs/focus@3.x.x/dist/cdn.min.js"></script> --}}
    {{-- @livewire('livewire-ui-modal') --}}
    @livewireScripts
    {{-- @powerGridScripts --}}
    {{-- @livewire('livewire-ui-modal') --}}
    <script>
        hent = "{{ Session::get('hent') }}";
        if (hent == 1) {
            theme = "{{ Session::get('theme') }}";
            title = "{{ Session::get('title') }}";
            mess = "{{ Session::get('mess') }}";
            hint_(theme, title, mess)
            console.log('hent');
        }
        alert = "{{ session('alert') }}";
        if (alert == 1) {
            mess = "<center>{!! Session::get('mess') !!}</center>";
            style_ = "{{ Session::get('style') }}";
            alert_(mess, style_)
            console.log('alert');
        }
    </script>
</body>

</html>
