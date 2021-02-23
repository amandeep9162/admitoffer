<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Admit Offer : Higher Education Redefined</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
  

<!-- <link href="https://cdnjs.cloudflare.com/ajax/libs/metisMenu/3.0.4/metisMenu.css" rel="stylesheet"> -->
<link href="{{ asset('css/main.css') }}" rel="stylesheet">


<link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />
<link href="https://cdn.datatables.net/1.10.20/css/jquery.dataTables.min.css" rel="stylesheet" />

<link rel="stylesheet" href="https://code.jquery.com/ui/1.11.0/themes/smoothness/jquery-ui.css">
<link href="{{ asset('css/custom.css') }}" rel="stylesheet">
<link href="{{ asset('css/own.css') }}" rel="stylesheet">
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Poppins:100,200,300,400,500,600,700,800,900&display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900&display=swap" rel="stylesheet">
</head>
<body >
<div class="app-container app-theme-white body-tabs-shadow fixed-sidebar fixed-header" >
    @include('applicant/components/header')
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
    @include('applicant/components/setting') 
    <?php
     
        $isLogin = auth('student')->user();
        ?>
    @if($isLogin)
        <div class="app-main">
        @include('applicant/components/sidebar')
        @endif 
        <div class="app-main__outer" id="app"><br>
        @yield('content')
    </div>
</div>
<div class="modal"><!-- Place at bottom of page --></div>
@include('applicant/components/footer')
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
<script>
$body = $("body");

// $(document).on({
//     ajaxStart: function() { $body.addClass("loading");    },
//      ajaxStop: function() { $body.removeClass("loading"); }    
// });
</script>
<!-- <script src="{{ asset('js/app.js') }}" ></script> -->
<script type="text/javascript" src="{{ asset('admins/js/main.js') }}"></script>
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.20/js/jquery.dataTables.min.js"></script>
<script type="text/javascript" src="{{ asset('js/agent.js') }}"></script>
<script src="https://canvasjs.com/assets/script/canvasjs.min.js"> </script>
<script type="text/javascript" src="{{ asset('admins/js/custom.js') }}"></script>
<script type="text/javascript" src="{{ asset('admins/js/ajax.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js"></script>
<script type="text/javascript" src="{{ asset('admins/js/location.js') }}"></script>
<script src="https://code.jquery.com/ui/1.11.0/jquery-ui.js"></script>

 @yield('addjavascript')



</div>



</body>
</html> 