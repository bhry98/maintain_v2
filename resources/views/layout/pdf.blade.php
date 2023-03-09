<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <link href="{{ $Sys['App_Logo'] == null ? env('APP_LOGO') : $Sys['App_Logo'] }}" rel="icon">
    <title>{{ $Sys['App_Name'] == null ? env('APP_NAME') : $Sys['App_Name'] }} | @yield('title', 'title')</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, viewport-fit=cover" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    @yield('css')
    <style>
        .center {
            text-align: center
        }

        .font-11 {
            font-size: 11px;
            font-weight: normal;
        }

        .font-10 {
            font-size: 10px;
            font-weight: normal;
        }

        .col {
            box-sizing: border-box;
            float: left;
            width: 50%;
            padding: 10px;
            height: 300px;
        }

        .row:after {
            box-sizing: border-box;
            content: "";
            display: table;
            clear: both;
        }

        .bor {
            border: 1px solid;
            font-size: 12px;
            text-align: center;
        }

        table {
            width: 100%;
            border-collapse: collapse;
        }

        .bg-gray {
            background-color: rgb(226, 226, 226)
        }

        @page {
            header: page-header;
            footer: page-footer;
        }
    </style>
</head>

<body dir="{{ __('app.HTML') }}">
    @yield('body')
    @yield('js')
</body>

</html>
