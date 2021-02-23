<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Admit Offer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an admitoffer panel.">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
<link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css" rel="stylesheet" />

  

<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/3.0.4/metisMenu.css" rel="stylesheet"> -->
<link href="{{ asset('css/main.css') }}" rel="stylesheet"></head>
<link href="{{ asset('css/custom.css') }}" rel="stylesheet">
<link href="{{ asset('css/own.css') }}" rel="stylesheet">
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header" >
    @include('admin/components/header')
    @if(Session::has('success'))
        <div class="btn btn-success popOver">
            <strong>{!!Session::get('success')!!}</strong> 
        </div>
    @endif
    @if(Session::has('error'))
        <div class="btn btn-danger popOver">
            <strong>{!!Session::get('error')!!}</strong> 
        </div>
    @endif
    @include('admin/components/setting') 
    <?php
        $isLogin = \Auth::user();
        $roleType = config('multiauth.prefix');
        if($roleType =="admin"){
            $isLogin = auth('admin')->user();
        }
        ?>
    @if($isLogin)
        <div class="app-main">
        @include('admin/components/sidebar')
    @endif 
        <div class="app-main__outer" id="app"><br>
            @yield('content')
        </div>
    </div>
</div>
<script type="text/javascript" src="{{ asset('admins/js/main.js') }}"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('admins/js/location.js') }}"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="{{ asset('admins/js/custom.js') }}"></script>
<script type="text/javascript" src="{{ asset('admins/js/admin.js') }}"></script>
<!-- <script src="{{asset('js/app.js') }}" ></script> -->
@yield('addjavascript')


</div>



</body>
</html>