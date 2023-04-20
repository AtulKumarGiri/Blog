<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    
    <link href="{{ asset('assets/css/styles.css') }}" rel="stylesheet" >

    <!-- Scripts -->
    <script src="https://use.fontawesome.com/releases/v6.3.0/js/all.js" crossorigin="anonymous"></script>
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <!-- Summernote Link -->
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.css" rel="stylesheet">

    <!-- DataTables Link -->
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.4/css/jquery.dataTables.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.13.4/css/dataTables.bootstrap5.min.css">
    <style>
        .dataTables_wrapper .dataTables_paginate .paginate_button {
            margin: 0 !important;
            padding: 0 !important;
        }
        div.dataTables_wrapper div.dataTables_length select {
            width: 50% !important;
            display: inline-block;
        }
    </style>
</head>
<body>
    @include('layouts.inc.admin-navbar')
    <div id="layoutSidenav">
        @include('layouts.inc.admin-sidebar')
        <div id="layoutSidenav_content">
            <main>
                @yield('content')
            </main>
            @include('layouts.inc.admin-footer')
        </div>
    </div>
    <script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}" crossorigin="anonymous"></script>
    <script src="{{ asset('assets/js/scripts.js')}} "></script>
    <script src="{{ asset('assets/js/jquery-3.6.0.min.js')}} "></script>
    <!-- Summernote Link  -->
    <script src="https://cdn.jsdelivr.net/npm/summernote@0.8.18/dist/summernote-lite.min.js"></script>
    <script>
        $(document).ready(function() {
            $("#my_summernote").summernote();
            $('.dropdown-toggle').dropdown();
        });
    </script>

    <!-- DataTable Link  -->
    <script src="//cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js" ></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap5.min.js "></script>
    <script>
        $(document).ready( function () {
            $('#myDataTable').DataTable();
        });
    </script>
</body>
</html>