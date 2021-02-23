<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta http-equiv="Content-Language" content="en">
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
        <title>Admit Offer</title>
        <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, shrink-to-fit=no" />
        
        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <link href="{{ asset('css/bootstrap.min.css')}}" rel="stylesheet">
        <!-- Custom styles for this template -->
        <link href="{{ asset('css/stroke.css')}}" rel="stylesheet">
        <script src="https://use.fontawesome.com/72451ebe5b.js"></script>
        <link href="https://use.fontawesome.com/72451ebe5b.css" media="all" rel="stylesheet">
        <link href="{{ asset('css/signin.css')}}" rel="stylesheet">
        <link href="{{ asset('css/custom.css')}}" rel="stylesheet">
        <link href="{{ asset('css/signup.css')}}" rel="stylesheet">
        <link href="{{ asset('css/own.css')}}" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Montserrat:100,200,300,400,500,600,700,800,900&amp;display=swap" rel="stylesheet">
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,300,400,600,700,800,900&display=swap" rel="stylesheet">
    </head>
    <style>
    .blahSize {
        display: none;
        width: 100px;
        height: 100px;
        padding: 8px;
        border-radius: unset;
        border: 2px solid #eaeaea;
        margin-bottom: 10px;
    }
    .blah {
        border-radius: unset;
    }
    </style>
    <body class="text-center signUpbody">
        @if(Session::has('success'))
            <div class="btn btn-success popOver float-right ">
                <div class="btn btn-success">
                    <strong class="text-white">Heads Up!</strong><span class="text-white"> {!!Session::get('success')!!}</span>
                </div>
            </div>
        @endif
        <div class="container ">
            <div class="row">
                <div class="col-12 col-md-12 col-lg-10 offset-lg-1">
                    <div class="sec1">
                        <div class="row no-gutters">
                            <div class="col-12 col-md-12 col-lg-12 part1 border-radius10">
                                <a href="{{route('applicant.login')}}" class="btn btn-danger float-right registerBackBtn"><i class="fa fa-arrow-left"></i> Back</a>
                                <div class="login_form">
                                    <h4>Welcome To</h4>
                                    <a href="{{route('agent.login')}}"><img src="{{ asset('images/logo.png')}}"></a>
                                    <div class="small_txt">
                                        <p>Register for most advanced Overseas Education Admission Portal.</p>
                                    </div>
                                    @if ($errors->any())
                                        <div class="alert alert-danger">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li><small>{{ $error }}</small></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    @endif
                                    <form class="form-signin signUp" enctype="multipart/form-data" method="POST" action="{{ route('applicant.register') }}" aria-label="{{ __('Register') }}">
                                        @csrf
                                        <div class="login_input">  
                                            <i class="icon icon-User"></i>
                                            <label for="name" class="sr-only">Name </label>  
                                            <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}"  placeholder="Name" required autofocus>
                                            @if ($errors->has('name'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('name') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                       
                                        <div class="login_input">
                                            <i class="icon icon-mail"></i>
                                            <label for="inputEmail" class="sr-only">Email address</label>
                                            <input type="email" id="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email address" name="email" value="{{ old('email') }}" required="">
                                            @if ($errors->has('email'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('email') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="login_input">
                                            <i class="fa fa-phone"></i>
                                            <label for="mobile" class="sr-only">Phone</label>
                                            <input  type="number" id="mobile" placeholder="Phone"  class="form-control{{ $errors->has('mobileno') ? ' is-invalid' : '' }}" name="mobileno" value="{{ old('mobileno') }}" required>
                                            @if ($errors->has('mobileno'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('mobileno') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                      
                                        <div class="login_input">
                                            <i class="icon icon-ClosedLock"></i>
                                            <label for="inputPassword" class="sr-only">Password</label>
                                            <input type="password" id="inputPassword" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" placeholder="Password" name="password" required="">
                                            @if ($errors->has('password'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <div class="login_input">
                                            <i class="icon icon-ClosedLock"></i>
                                            <label for="inputConfirmPassword" class="sr-only">Confirm Password</label>
                                            <input type="password" id="inputConfirmPassword" class="form-control{{ $errors->has('ConfirmPassword') ? ' is-invalid' : '' }}" placeholder="Confirm Password" name="password_confirmation" required="">
                                            @if ($errors->has('password_confirmation'))
                                            <span class="invalid-feedback" role="alert">
                                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                        <p class="form-control" style="height:200px;overflow: scroll;"  >Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever. Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever.
                                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever.
                                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever.
                                                &nbsp;
                                        Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever.
                                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever.
                                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever.
                                                Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever.        
                                        </p>
                                        <div class="checkbox mb-3 float-left small_txt" >
                                           
                                                <label class="containerCheckBox"><small style="color:#b1b1b1" ><span style="font-size: 12px; color: #b1b1b1; margin-bottom: 0;"></span>I have read the Terms & Conditions and i Agree to them & I Shall Abide by the rules of the company.</span></small>
                                                    <input id="gender" type="checkbox" name="checkprivacy" class="checkprivacy mb-2 displayNone" value="remember-me"  required  >    
                                                    <span class="checkmarked"></span>
                                                </label>
                                        </div>
                                        <button class="btn btn-lg  btn-block btn2" id="checkprivacy" type="submit" disabled>Register</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-------- sec1 end --------->
                </div>
            </div>
            <div class="row loginRegisterFooter" >
                <div class="col-md-12">
                    <div class="footer text-center" >
                        <div class="small_txt">
                            <p>© Copyright 2019 . All Rights Reserved by Supernova Edu Technologies Inc.</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        </div>
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script type="text/javascript" src="{{ asset('admins/js/custom.js')}}" ></script>
        <script type="text/javascript" src="{{ asset('admins/js/location.js')}}" ></script>
    </body>
</html>