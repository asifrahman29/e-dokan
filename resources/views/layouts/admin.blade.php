<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ $title ?? config('app.name', 'Laravel') }}</title>

    <link rel="icon" href="{{ asset('assets/img/kaiadmin/favicon.ico') }}" type="image/x-icon" />
    {{-- Fonts and icons  --}}
    <script src="{{ asset('assets/js/plugin/webfont/webfont.min.js') }}"></script>
    <script>
        WebFont.load({
            google: {
                families: ["Public Sans:300,400,500,600,700"]
            },
            custom: {
                families: [
                    "Font Awesome 5 Solid",
                    "Font Awesome 5 Regular",
                    "Font Awesome 5 Brands",
                    "simple-line-icons",
                ],
                urls: ["{{ asset('assets/css/fonts.min.css') }}"],
            },
            active: function() {
                sessionStorage.fonts = true;
            },
        });
    </script>

    {{-- CSS Files  --}}
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/plugins.min.css') }}" />
    <link rel="stylesheet" href="{{ asset('assets/css/kaiadmin.min.css') }}" />

    {{-- CSS Just for demo purpose, don't include it in your project  --}}
    {{-- <link rel="stylesheet" href="{{ asset('assets/css/demo.css') }}" /> --}}

    @yield('styles')
</head>

<body>
    <div class="wrapper">
        {{-- Sidebar --}}
        @include('inc.admin.sidebar')

        {{-- End Sidebar --}}

        <div class="main-panel">

            @include('inc.admin.main_header')


            <div class="container">

                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                <!-- Create Post Form -->
                {{-- page-inner --}}
                @yield('content')
                {{-- page-inner --}}
            </div>

            @include('inc.admin.footer')

        </div>

        {{-- Custom template | don't include it in your project!  --}}
        {{-- @include('inc.admin.custom') --}}
        {{-- End Custom template  --}}
    </div>

    {{-- Scripts --}}
    {{-- Core JS Files    --}}
    <script src="{{ asset('assets/js/core/jquery-3.7.1.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/core/bootstrap.min.js') }}"></script>

    {{-- jQuery Scrollbar  --}}
    <script src="{{ asset('assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js') }}"></script>

    {{-- Chart JS  --}}
    <script src="{{ asset('assets/js/plugin/chart.js/chart.min.js') }}"></script>

    {{-- jQuery Sparkline  --}}
    <script src="{{ asset('assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js') }}"></script>

    {{-- Chart Circle  --}}
    <script src="{{ asset('assets/js/plugin/chart-circle/circles.min.js') }}"></script>

    {{-- Datatables  --}}
    <script src="{{ asset('assets/js/plugin/datatables/datatables.min.js') }}"></script>

    {{-- Bootstrap Notify  --}}
    <script src="{{ asset('assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js') }}"></script>

    {{-- jQuery Vector Maps  --}}
    <script src="{{ asset('assets/js/plugin/jsvectormap/jsvectormap.min.js') }}"></script>
    <script src="{{ asset('assets/js/plugin/jsvectormap/world.js') }}"></script>

    {{-- Sweet Alert  --}}
    <script src="{{ asset('assets/js/plugin/sweetalert/sweetalert.min.js') }}"></script>

    {{-- Kaiadmin JS  --}}
    <script src="{{ asset('assets/js/kaiadmin.min.js') }}"></script>

    {{-- Kaiadmin DEMO methods, don't include it in your project!  --}}
    {{-- <script src="{{ asset('assets/js/setting-demo.js') }}"></script> --}}
    {{-- <script src="{{ asset('assets/js/demo.js') }}"></script> --}}
    <script>
        $(document).ready(function() {
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
        })
        $("#lineChart").sparkline([102, 109, 120, 99, 110, 105, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#177dff",
            fillColor: "rgba(23, 125, 255, 0.14)",
        });

        $("#lineChart2").sparkline([99, 125, 122, 105, 110, 124, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#f3545d",
            fillColor: "rgba(243, 84, 93, .14)",
        });

        $("#lineChart3").sparkline([105, 103, 123, 100, 95, 105, 115], {
            type: "line",
            height: "70",
            width: "100%",
            lineWidth: "2",
            lineColor: "#ffa534",
            fillColor: "rgba(255, 165, 52, .14)",
        });
        // 
    </script>

    @yield('scripts')
    {{-- end Scripts --}}
</body>

</html>
