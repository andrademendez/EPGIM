<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>{{ config('app.name', 'EPGIM') }}</title>
    <link rel="shortcut icon" href="{{ asset('images/gim.png') }}" type="image/x-icon">
    <!--     Fonts and icons     -->
    <link rel="stylesheet" type="text/css" href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Roboto+Slab:400,700|Material+Icons" />
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css">
    <!-- CSS Files -->
    <link href="{{ asset('material/css/material-dashboard.css?v=2.1.2') }}" rel="stylesheet" />
    <!-- Styles -->

    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    @livewireStyles
    @method('styles')

</head>
<body>
    <div class="w-xl w-full">
        @include('layouts.navbars.sidebar')
        <div class="main-panel ">
            @include('layouts.navbars.navs.auth')
            {{ $slot }}
            @include('layouts.footers.auth')
        </div>
    </div>

    </div>

    <script src="{{ asset('js/app.js') }}"></script>
    <script src="{{ asset('material/js/core/jquery.min.js') }}"></script>
    <script src="{{ asset('material/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('material/js/plugins/moment.min.js') }}"></script>
    <script src="//code.jquery.com/ui/1.11.2/jquery-ui.js"></script>

    <script src="{{ asset('material/js/core/bootstrap-material-design.min.js') }}"></script>
    <script src="{{ asset('material/js/plugins/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('material/js/plugins/jquery.validate.min.js') }}"></script>
    <!-- Plugin for the Wizard, full documentation here: https://github.com/VinceG/twitter-bootstrap-wizard -->
    <script src="{{ asset('material/js/plugins/jquery.bootstrap-wizard.js') }}"></script>
    <!--	Plugin for Select, full documentation here: http://silviomoreto.github.io/bootstrap-select -->
    <script src="{{ asset('material/js/plugins/bootstrap-selectpicker.js') }}"></script>
    <!--  Plugin for the DateTimePicker, full documentation here: https://eonasdan.github.io/bootstrap-datetimepicker/ -->
    <script src="{{ asset('material/js/plugins/bootstrap-datetimepicker.min.js') }}"></script>
    <script src="{{ asset('material/js/plugins/bootstrap-tagsinput.js') }}"></script>
    <!-- Plugin for Fileupload, full documentation here: http://www.jasny.net/bootstrap/javascript/#fileinput -->
    <script src="{{ asset('material/js/plugins/jasny-bootstrap.min.js') }}"></script>
    <script src="{{ asset('material/js/plugins/fullcalendar.min.js') }}"></script>
    <!-- Library for adding dinamically elements -->
    <script src="{{ asset('material/js/plugins/arrive.min.js') }}"></script>
    <!-- Control Center for Material Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{ asset('material/js/material-dashboard.js?v=2.1.0') }}" type="text/javascript"></script>

    <script src="{{ asset('material/js/application.js') }}"></script>
    <script src="{{ asset('js/offcanvas.js') }}"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@9"></script>
    <script src="{{ asset('js/toast.js') }}"></script>
    @livewireScripts
    @method('js')

    <script src="{{ asset("js/pikaday.js") }}"></script>
    <script src="{{ asset("js/campanias.js") }}"></script>


    <link rel="stylesheet" type="text/css" href="{{ asset("css/pikaday.css") }}">
    <style>
        .uk-active {

            color: #121312;
            border-bottom: #5f1366 2px;
            border-style: solid;
        }

        .bootstrap-select:not([class*="col-"]):not([class*="form-control"]):not(.input-group-btn) {
            width: 100%;
        }

    </style>

</body>
</html>
