<!DOCTYPE html>
<html class="no-js" lang="zxx">

<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="meta description">
    <!-- <meta name="csrf-token" content="{{ csrf_token() }}" /> -->
    <title>@yield('title')</title>
    @stack('styles')
    <!--=== Favicon ===-->
    <link rel="shortcut icon" href="{{ URL::asset('Auth/img/favicon.ico') }}" type="image/x-icon" />
    <!--=== All Plugins CSS ===-->
    <link href="{{ URL::asset('Auth/css/plugins.css') }}" rel="stylesheet">
    <!--=== All Vendor CSS ===-->
    <link href="{{ URL::asset('Auth/css/vendor.css') }}" rel="stylesheet">
    <!--=== Main Style CSS ===-->
    <link href="{{ URL::asset('Auth/css/style.css') }}" rel="stylesheet">
    {{-- Custom style --}}
    <!-- Modernizer JS -->
    <script src="{{ URL::asset('Auth/js/modernizr-2.8.3.min.js') }}"></script>
    <!-- Notification css (Toastr) -->
    <link href="{{ asset('admin/assets/libs/toastr/toastr.min.css') }}" rel="stylesheet" type="text/css" />
    <script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.29.3/moment.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!-- <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery-cookie/1.4.1/jquery.cookie.min.js">
    </script> -->
    @stack('cssAuth')
</head>

<body>
    @php
        use App\Models\CategoryModel;
        $categories = CategoryModel::where('m_id_parent', 0)->get();
    @endphp
    @include('Auth.components.header')
    @yield('content')
    @include('Auth.components.footer')
    <!--=======================Javascript============================-->
    <!--=== All Vendor Js ===-->
    <script src="{{ URL::asset('Auth/js/vendor.js') }}"></script>
    <!--=== All Plugins Js ===-->
    <script src="{{ URL::asset('Auth/js/plugins.js') }}"></script>
    <!--=== Active Js ===-->
    <script src="{{ URL::asset('Auth/js/active.js') }}"></script>
    <script src="{{ asset('admin/assets/libs/toastr/toastr.min.js') }}"></script>
    <script>
        toastr.options = {
            "closeButton": false,
            "debug": false,
            "newestOnTop": false,
            "progressBar": false,
            "positionClass": "toast-top-right",
            "preventDuplicates": false,
            "onclick": null,
            "showDuration": "300",
            "hideDuration": "1000",
            "timeOut": "5000",
            "extendedTimeOut": "1000",
            "showEasing": "swing",
            "hideEasing": "linear",
            "showMethod": "fadeIn",
            "hideMethod": "fadeOut"
        };

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });
    </script>
    @stack('scriptsPrev')
    @stack('scripts')
    <script>
        $("#desktop-menu li").each(function() {
            var pageUrl = window.location.href.split(/[?#]/)[0];
            if ($(this).find('a')[0].href == pageUrl) {
                $(this).addClass("active");
            }
        });
    </script>
</body>

</html>
