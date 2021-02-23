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
   
     <div class="row no-gutters">
   <div class="col-12 col-md-12 col-lg-6 part1">
     <div class="login_form">
      <h4>Welcome To</h4>
      <img src="{{ asset('images/logo.png')}}">
       <div class="small_txt"><p>Log in to most advanced Overseas Education Admission Portal.</p></div>
      
      <form class="form-signin" method="POST" action="{{ route('applicant.login') }}" aria-label="{{ __('Login') }}">
            @csrf
        <div class="login_input">
              <i class="icon icon-User"></i>
              <label for="inputEmail" class="sr-only">Email address</label>
              <input type="email" id="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" placeholder="Email address" name="email" value="{{ old('email') }}" required="">
              @if ($errors->has('email'))
              <span class="invalid-feedback" role="alert">
                  <strong>{{ $errors->first('email') }}</strong>
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
      
      <!--<div class="checkbox mb-3">
        <label>
          <input type="checkbox" value="remember-me"> Remember me
        </label>
      </div>-->
      <button class="btn btn-lg  btn-block btn2" type="submit">Sign in</button>
      
    </form>
    or
      <a href="{{ route('applicant.register') }}" class="btn btn-lg mb-3 btn-block btn2" >Sign Up</a>
    
        <div class="small_txt"><p>Don't have acount? <strong><a href="{{ route('applicant.register') }}">Signup Now</a></strong></p></div>
        
        <div class="or">
           <p>&nbsp;</p>
        </div>
        
        <div class="small_txt"><p>Connect with us on social media</p></div>
        <div class="social_m">
         <ul>
           <li> <a href="https://www.facebook.com/Admit-Offer-104241471171700/?modal=admin_todo_tour" style="color:#3b5998"><i class="fa fa-facebook padding-top-10"></i></a></li>
           <li> <a href="https://www.instagram.com/admitoffer/" style="color:#dc4e41"><i class="fa fa-instagram padding-top-10"></i></a></li>
         </ul>
        </div>
    
   </div>
    </div>
    
    <div class="d-none d-sm-block col-md-12 col-lg-6 part2 d-md-flex  align-items-center justify-content-center">
      <div class="login_txt">
         <img src="{{ asset('images/logo-white.png')}}">
         <p>AI powered online exchange uniquely designed for international students and student recruiters to apply to the best institutions from around the world in a simple, functional, seamless, and cashless manner.</p>
      </div>
    </div>
    
   </div>
  </div> <!-------- sec1 end --------->
</div>
</div>

<div class="row loginRegisterFooter" >
  <div class="col-md-12">
    <div class="footer text-center" >
    <div class="small_txt"><p>© Copyright 2019 . All Rights Reserved by Supernova Edu Technologies Inc.</p></div> 
    </div>
  </div>
</div>
</div>

<!--Start of Tawk.to Script-->
<script type="text/javascript">
var Tawk_API=Tawk_API||{}, Tawk_LoadStart=new Date();
(function(){
var s1=document.createElement("script"),s0=document.getElementsByTagName("script")[0];
s1.async=true;
s1.src='https://embed.tawk.to/5e550274298c395d1ce9b15e/default';
s1.charset='UTF-8';
s1.setAttribute('crossorigin','*');
s0.parentNode.insertBefore(s1,s0);
})();
</script>
<!--End of Tawk.to Script-->

</body>
</html> 
