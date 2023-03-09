<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>{{ env('APP_NAME', 'Portal') }} | @yield('title', '...')</title>
    <link href="{{ mix('assets/css/tabler.min.css') }}" rel="stylesheet" />
    <link href="{{ mix('assets/css/demo.min.css') }}" rel="stylesheet" />
    <link href="{{ url('assets/css/alert.css') }}" rel="stylesheet" />
</head>

<body class=" fon ">
    <div dir="{{ __('app.HTML') }}" class="page page-center">
        <div class="container-tight ">
            <center>
                @yield('img', 'img')
                <br>
                <h1 style="font-size: 40px">
                    @yield('error', 'error')
                </h1>
                <br>
                @yield('mess', '')
            </center>
        </div>
    </div>
    <script src="{{ url('assets/js/alert.js') }}"></script>
    <script src="{{ url('assets/js/bhry98.js') }}"></script>
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
