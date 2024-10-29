<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Bootstrap 4.0-->
    <link rel="stylesheet" href="{{ asset('/assets/css/bootstrap.css') }}">

    <!-- Bootstrap extend-->
    <link rel="stylesheet" href="{{ asset('/assets/css/bootstrap-extend.css') }}">

    <!-- theme style -->
    <link rel="stylesheet" href="{{ asset('/assets/css/master_style.css') }}">

    <!-- Fab Admin skins -->
    <link rel="stylesheet" href="{{ asset('/assets/css/_all-skins.css') }}">

    <!-- Vector CSS -->
    <link href="{{ asset('/assets/css/jquery-jvectormap-2.0.2.css') }}" rel="stylesheet" />

    <!-- Morris charts -->
    <link rel="stylesheet" href="{{ asset('/assets/css/morris.css') }}">

    <!-- sweetalert -->
    <link rel="stylesheet" href="{{ asset('/assets/css/sweetalert.css') }}">

    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}

    {{-- icons --}}
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.css" integrity="sha512-5A8nwdMOWrSz20fDsjczgUidUBR8liPYU+WymTZP1lmY9G6Oc7HlZv156XqnsgNUzTyMefFTcsFH/tnJE/+xBg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link href="https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/css/materialdesignicons.min.css" rel="stylesheet">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/css/boxicons.min.css" integrity="sha512-pVCM5+SN2+qwj36KonHToF2p1oIvoU3bsqxphdOIWMYmgr4ZqD3t5DjKvvetKhXGc/ZG5REYTT6ltKfExEei/Q==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-icons/1.11.3/font/bootstrap-icons.min.css" integrity="sha512-dPXYcDub/aeb08c63jRq/k6GaKccl256JQy/AnOq7CAnEZ9FzSL9wSbcZkMp4R26vBsMLFYH4kQ67/bbV8XaCQ==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    <link rel="stylesheet" href="http://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">

    <link
        rel="stylesheet"
        href="https://cdnjs.cloudflare.com/ajax/libs/animate.css/4.1.1/animate.min.css" />
    <!-- toast tr -->
    <link rel="stylesheet" href="{{ asset('assets/css/jquery.toast.css') }}">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2@4.0.13/dist/css/select2.min.css" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/select2-bootstrap-5-theme@1.3.0/dist/select2-bootstrap-5-theme.min.css" />
    <!-- <link rel="stylesheet" type="text/css" href="//cdn.datatables.net/1.10.12/css/jquery.dataTables.min.css" /> -->

    @yield('css')
</head>

<body class="hold-transition">
    <div id="app">
        <div class="wrapper">
            @yield('content')
        </div>
    </div>
    <!-- jQuery 3 -->
    <script src="{{ asset('/assets/js/jquery.js') }}"></script>

    <!-- jQuery UI 1.11.4 -->
    <script src="{{ asset('/assets/js/jquery-ui/jquery-ui.js') }}"></script>

    <!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
    <script>
        $.widget.bridge('uibutton', $.ui.button);
    </script>

    <!-- popper -->
    <script src="{{ asset('/assets/js/popper.min.js') }}"></script>

    <!-- Bootstrap 4.0-->
    <script src="{{ asset('/assets/js/bootstrap.js') }}"></script>

    <!-- ChartJS -->
    <script src="{{ asset('/assets/js/Chart.min.js') }}"></script>

    <!-- Slimscroll -->
    <script src="{{ asset('/assets/js/jquery.slimscroll.js') }}"></script>

    <!-- peity -->
    <script src="{{ asset('/assets/js/jquery.peity.js') }}"></script>

    <!-- Morris.js charts -->
    <script src="{{ asset('/assets/js/raphael.min.js') }}"></script>
    <script src="{{ asset('/assets/js/morris.min.js') }}"></script>

    <!-- Fab Admin App -->
    <script src="{{ asset('/assets/js/template.js') }}"></script>


    <!-- jquerysteps -->
    <script src="{{ asset('/assets/js/jquery.validate.min.js') }}"></script>
    <script src="{{ asset('/assets/js/sweetalert2@11.js') }}"></script>

    {{-- icons --}}

    <script src="
        https://cdn.jsdelivr.net/npm/@mdi/font@7.4.47/scripts/verify.min.js
        "></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/boxicons/2.1.0/dist/boxicons.min.js"
        integrity="sha512-y8/3lysXD6CUJkBj4RZM7o9U0t35voPBOSRHLvlUZ2zmU+NLQhezEpe/pMeFxfpRJY7RmlTv67DYhphyiyxBRA=="
        crossorigin="anonymous" referrerpolicy="no-referrer"></script>

    <script src="{{asset('assets/js/jquery.toast.js')}}"></script>
    <script src="{{asset('assets/js/toastr.js')}}"></script>

    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        });

        // Example starter JavaScript for disabling form submissions if there are invalid fields
        (function() {
            'use strict'

            // Fetch all the forms we want to apply custom Bootstrap validation styles to
            var forms = document.querySelectorAll('.needs-validation')

            // Loop over them and prevent submission
            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()
    </script>

    <script src="{{asset('assets/js/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
    <script src="{{asset('assets/js/fastclick/lib/fastclick.js')}}"></script>
    <script src="{{asset('assets/js/formatter/formatter.js')}}"></script>
    <script src="{{asset('assets/js/formatter/jquery.formatter.js')}}"></script>
    <!-- Fab Admin for demo purposes -->
    <script src="{{ asset('/assets/js/demo.js') }}"></script>
    {{-- MomentJS (locale date) --}}
    <script src="{{asset('assets/js/moment-with-locales.min.js')}}"></script>
    <script src='{{asset('assets/js/fullcalendar.js')}}'></script>
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>

    @stack('js')
</body>

</html>
