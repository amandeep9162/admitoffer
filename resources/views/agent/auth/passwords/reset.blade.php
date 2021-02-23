<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta http-equiv="Content-Language" content="en">
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Admit Offer</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
    <meta name="description" content="This is an example dashboard created using build-in elements and components.">
    <meta name="msapplication-tap-highlight" content="no">

    
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

<link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet">

    <!-- Custom styles for this template -->
<link href="{{ asset('css/stroke.css')}}" rel="stylesheet">
<script src="https://use.fontawesome.com/72451ebe5b.js"></script><link href="https://use.fontawesome.com/72451ebe5b.css" media="all" rel="stylesheet">
<link href="{{ asset('css/signin.css')}}" rel="stylesheet">
<link href="{{ asset('css/own.css')}}" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet">
<link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900&display=swap" rel="stylesheet">
</head>

<body class="text-center">
@if(Session::has('success'))
          <div class="btn btn-success popOver float-right ">
              <div class="btn btn-success">
                  <strong class="text-white">Heads Up!</strong><span class="text-white"> {!!Session::get('success')!!}</span>
              </div>
          </div>
      @endif
  <div class="container">
  
  <div class="row" >
  
   <div class="col-12 col-md-12 col-lg-10 offset-lg-1">
   <div class="sec1" style="margin-top:90px;">  
   
     <div class="row ">
   <div class="col-12 col-md-12 col-lg-12 part1">
     <div class="login_form">
      <img src="{{ asset('images/logo.png')}}">
                     <form method="POST" action="{{ route('agent.password.request') }}" aria-label="{{ __('Reset Password') }}">
                        @csrf

                        <input type="hidden" name="token" value="{{ $token }}">

                        <div class="form-group row">
                            <label for="email" class="col-md-4 col-form-label text-md-right">{{ __('E-Mail Address') }}</label>

                            <div class="col-md-6">
                                <input id="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $email ?? old('email') }}" required autofocus>

                                @if ($errors->has('email'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('email') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-4 col-form-label text-md-right">{{ __('Password') }}</label>

                            <div class="col-md-6">
                                <input id="password" type="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>

                                @if ($errors->has('password'))
                                    <span class="invalid-feedback" role="alert">
                                        <strong>{{ $errors->first('password') }}</strong>
                                    </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">{{ __('Confirm Password') }}</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn-block btn2">
                                    {{ __('Reset Password') }}
                                </button>
                            </div>
                        </div>
                    </form>

    
    
   </div>
    </div>
    
    
   </div>
  </div> <!-------- sec1 end --------->
</div>
</div>


</div>


</body>
</html> 
