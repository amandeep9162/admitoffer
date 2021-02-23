<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Abroad</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/3.0.4/metisMenu.css" rel="stylesheet"> -->
<link href="{{ asset('css/main.css') }}" rel="stylesheet"></head>
<link href="{{ asset('css/custom.css') }}" rel="stylesheet"></head>
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<body >
<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header" id="app">
    @include('layouts/header')
    @if(Session::has('success'))
        <div class="btn btn-success popOver">
            <strong>Heads Up!</strong> {!!Session::get('success')!!}
        </div>
    @endif
    <div class="app-main" >
        <div class="app-main__outer"  style="padding-left:0px">
                @yield('content')
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script type="text/javascript" src="{{ asset('admins/js/main.js') }}"></script>
<script type="text/javascript" src="{{ asset('admins/js/location.js') }}"></script>
<script type="text/javascript" src="{{ asset('admins/js/custom.js') }}"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"></script>
<script src="{{ asset('js/app.js') }}" ></script>



</div>



</body>
</html> 