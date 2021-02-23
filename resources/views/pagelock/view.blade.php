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
      
       <form method="post" class="form-signin" action="{{route('pagelock.store')}}">
        	@csrf
        	 <div class="login_input">
        	 	
        	<label class="">Password</label>
        	<input type="password" name="password" class="form-control" placeholder="password" required>
        	<button class="btn btn-lg  btn-block btn2">Submit</button>
        	 </div>
        </form><br>
        <div class="text-center">
          
          <a href="/page/lock/changepassword" class="text-center">Change lock Password</a>
        </div>
   </div>
    </div>
   <div class="col-3 col-md-3 col-lg-3 part1"></div>
    
   </div>
  </div> 



@endsection
