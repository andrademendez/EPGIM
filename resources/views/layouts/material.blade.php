<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>EPGIM - {{ $title }}</title>
    <link rel="shortcut icon" href="{{ asset('images/gim.png') }}" type="image/x-icon">
    <!--     Fonts and icons     -->
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@300;400;500;700&display=swap" rel="stylesheet">
    {{--
    <link href="https://fonts.googleapis.com/css2?family=Material+Icons" rel="stylesheet"> --}}
    {{--
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css"> --}}
    <!-- CSS Files -->
    <link href="{{ asset('material/css/material-dashboard.css?v=2.1.2') }}" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <link href="{{ mix('css/toastr.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('css/pikaday.css') }}">
    <style>
        .bootstrap-select:not([class*="col-"]):not([class*="form-control"]):not(.input-group-btn) {
            width: 100%;
        }

        ion-icon {
            font-size: 64px;
        }
    </style>
    @livewireStyles
    @stack('styles')
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

<body class=" flex items-center justify-center bg-white ">
    <livewire:toasts />

    <div class="w-full">
        @include('layouts.navbars.sidebar')
        <div class=" main-panel ">
            @include('layouts.navbars.navs.auth')
            {{ $slot }}
        </div>
    </div>
    @livewireScripts
    @toastScripts

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('material/js/core/popper.min.js') }}"></script>

    <script src="{{ asset('material/js/core/bootstrap-material-design.min.js') }}"></script>
    <script src="{{ asset('material/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('material/js/plugins/bootstrap-selectpicker.js') }}"></script>
    <script src="{{ asset('material/js/plugins/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('material/js/plugins/bootstrap-tagsinput.js') }}"></script>
    <script src="{{ asset('material/js/plugins/fullcalendar.min.js') }}"></script>
    <script src="{{ asset('material/js/material-dashboard.js?v=2.1.0') }}" type="text/javascript"></script>
    <script src="{{ asset('material/js/application.js') }}"></script>

    <script src="{{ asset('js/offcanvas.js') }}"></script>
    <script src="{{ asset('js/toast.js') }}"></script>
    <!--  -->
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>
    <script src="https://unpkg.com/flowbite@1.4.6/dist/flowbite.js"></script>
    @stack('js')

</body>

</html>
