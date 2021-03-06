<?php
    $user = \Illuminate\Support\Facades\Session::get('user');
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="Jimmy Parker">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="icon" href="{{ url('/images') }}/favicon.png" sizes="16x16" type="image/png">
    <title>CSMC Logo Contest</title>
    <!-- Custom styles for this template -->
    <link href="{{ url('/css') }}/bootstrap.css" rel="stylesheet">
    <link href="{{ url('/css') }}/font-awesome.css" rel="stylesheet">
    <link href="{{ url('/css') }}/loader.css" rel="stylesheet">
    <link rel="stylesheet" href="{{ url('/plugins/bootstrap-editable/css/bootstrap-editable.css') }}">
    @yield('css')

    <style>
        fieldset {
            margin-top: 12px;
            border: 1px solid #39c;
            padding: 12px;
            -moz-border-radius: 8px;
            border-radius: 8px;
        }
        legend {
            color: #39c;
            font-style: italic;
            padding-left: 12px;
            padding-right: 12px;
            font-size:0.9em;
            width: auto !important;
        }
    </style>
</head>

<body>
<div id="loader-wrapper">
    <div id="loader"></div>
</div>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark fixed-top">
    <div class="container">
        <a class="navbar-brand" href="{{ url('/') }}">CSMC<font class="text-yellow"> Logo Contest</font></a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarResponsive">
            <ul class="navbar-nav ml-auto">

                <li class="nav-item {{ ($menu=='home') ? 'active':'' }}">
                    <a class="nav-link" href="{{ url('/') }}"><i class="fa fa-home"></i> Home</a>
                </li>
                @if($user->level=='admin')
                <li class="nav-item {{ ($menu=='add_entry') ? 'active':'' }}">
                    <a class="nav-link" href="{{ url('/entry/add') }}"><i class="fa fa-file-photo-o"></i> Manage Entries</a>
                </li>
                <li class="nav-item {{ ($menu=='add_judge') ? 'active':'' }}">
                    <a class="nav-link" href="{{ url('/judge') }}"><i class="fa fa-user-plus"></i> Manage Judges</a>
                </li>

                @endif

                @if($user->level=='judge')
                <li class="nav-item {{ ($menu=='view_entry') ? 'active':'' }}">
                    <a class="nav-link" href="{{ url('/entry/view') }}"><i class="fa fa-file-photo-o"></i> View Entries</a>
                </li>
                @endif
                <li class="nav-item">
                    <a class="nav-link" href="{{ url('/logout') }}"><i class="fa fa-sign-out"></i> Logout</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

<!-- Header -->
<header class="bg-success py-3 mb-5">
    <div class="container h-100">
        <div class="row h-100 align-items-center">
            <div class="col-lg-12">
                <div class="banner mt-5">
                    <img src="{{ url('/images') }}/banner.png" alt="" class="img-fluid">
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Page Content -->
<div class="wrapper pb-5">
    <div class="container">
        <div class="loading"></div>
        @yield('body')
    </div>
</div>

@yield('modal')
<!-- /.container -->
<!-- Footer -->
<footer class="py-md-3 bg-dark footer">
    <div class="container">
        <font class="text-white">Copyright &copy; TDH iHOMP 2020</font>
    </div>
    <!-- /.container -->
</footer>

<!-- Bootstrap core JavaScript -->
<script src="{{ url('/js') }}/jquery.min.js"></script>
<script src="{{ url('/js') }}/bootstrap.bundle.min.js"></script>
<script src="{{ url('/plugins/bootstrap-editable/js/bootstrap-editable.min.js') }}"></script>
@yield('js')

<script>

</script>

</body>

</html>
