<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@lang('app.name')</title>

    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ $app_icon }}">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>

<body class="fix-header fix-sidebar card-no-border">

<!-- Preloader - style you can find in spinners.css -->
<div class="preloader">
    <svg class="circular" viewBox="25 25 50 50">
        <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="2" stroke-miterlimit="10"/>
    </svg>
</div>

<div id="main-wrapper">
    @include('layouts._header')

    @include('layouts._sidebar')

    <div class="page-wrapper">
        <div class="container-fluid">
            @yield('content')
        </div>

        @include('layouts._footer')
    </div>
</div>
</body>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>

<script type="text/javascript">
    moment.locale('{{ App::getLocale() }}');
</script>

@include('layouts._confirm_delete')
@include('layouts._is_number')
@include('layouts._toast_message')
@include('layouts._datatables')
@include('layouts._dropify')

@yield('extra_scripts')

</html>
