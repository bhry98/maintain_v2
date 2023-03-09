<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8" />
    <link href="{{ $Sys['App_Logo'] == null ? env('APP_LOGO') : $Sys['App_Logo'] }}" rel="icon">
    <title>{{ $Sys['App_Name'] == null ? env('APP_NAME') : $Sys['App_Name'] }} | @yield('title', 'title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />

    <link href="{{ mix('assets/css/tabler.min.css') }}" rel="stylesheet" />
    <link href="{{ mix('assets/css/demo.min.css') }}" rel="stylesheet" />
    <link href="{{ url('assets/css/alert.css') }}" rel="stylesheet" />
</head>

<body class=" fon ">
    <div dir="{{ __('app.HTML') }}" class="page page-center">
        <div class="container-tight py-6">
            <center>
                <img class="text-center mb-4" src="{{ url('imgs/org/icon.jpg') }}" height="50"
                    alt="portal_logo">
            </center>
            @yield('form', 'form')
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
        // document.getElementById("form").submit(); 
    </script>
</body>

</html>
