@extends('agent.layouts.app')

@section('content')

<div class="sec1" style="margin-top:90px;">  
   
  <div class="row no-gutters">
   <div class="col-3 col-md-3 col-lg-3 part1"></div>
   <div class="col-6 col-md-6 col-lg-6 part1">
     <div class="login_form">
       @if ($errors->any())
          <div class="alert alert-danger">
              <ul>
                  @foreach ($errors->all() as $error)
                      <li class="list-none"><small>{{ $error }}</small></li>
                  @endforeach
              </ul>
          </div>
      @endif
      
       <form method="post" class="form-signin" action="{{route('pagelocker.changePasswordUpdate')}}">
        	@csrf
        	 <div class="login_input">
        	 	
        	<label class="">Old Password</label>
        	<input type="password" name="oldpassword" class="form-control" placeholder="old password" required>
          <label class="">New Password</label>
          <input type="password" name="newpassword" class="form-control" placeholder="new password" required>
          <label class="">Password</label>
          <input type="password" name="confirmpassword" class="form-control" placeholder="confirm password" required>
        	<button class="btn btn-lg  btn-block btn2">Submit</button>
        	 </div>
        </form><br>
       
   </div>
    </div>
   <div class="col-3 col-md-3 col-lg-3 part1"></div>
    
   </div>
  </div> 



@endsection
