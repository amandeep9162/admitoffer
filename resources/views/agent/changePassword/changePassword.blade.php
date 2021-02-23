@extends('agent.layouts.app')
@section('content')
<div class="container">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                  <div class="container">
  
                      <div class="row" >
                      
                       <div class="col-12 col-md-12 col-lg-10 offset-lg-1">
                       <div class="sec1" style="margin-top:30px;">  
                       
                         <div class="row no-gutters">
                       <div class="col-12 col-md-12 col-lg-6 part1">
                         <div class="login_form mb-3">
                          <h4>Change Password</h4>
                          
                           @if ($errors->any())
                              <div class="alert alert-danger">
                                  <ul>
                                      @foreach ($errors->all() as $error)
                                          <li><small>{{ $error }}</small></li>
                                      @endforeach
                                  </ul>
                              </div>
                          @endif
                          <form class="form-signin" method="POST" action="{{ route('agent.password.store') }}" >
                                @csrf
                            <div class="login_input">
                                  <i class="icon icon-User"></i>
                                  <label for="inputoldpassword" class="sr-only">Old Password</label>
                                  <input type="text" id="oldpassword" class="form-control{{ $errors->has('oldpassword') ? ' is-invalid' : '' }}" placeholder="Old Password" name="oldpassword" value="{{ old('oldpassword') }}" required="">
                                  @if ($errors->has('oldpassword'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('oldpassword') }}</strong>
                                  </span>
                                    @endif
                            </div>
                              
                              <div class="login_input">
                                  <i class="icon icon-ClosedLock"></i>
                                  <label for="inputnewpassword" class="sr-only">New Password</label>
                                  <input type="password" id="inputnewpassword" class="form-control{{ $errors->has('newpassword') ? ' is-invalid' : '' }}" placeholder="New Password" name="newpassword" required="">
                                  @if ($errors->has('newpassword'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('newpassword') }}</strong>
                                  </span>
                                  @endif
                               </div>
                             <div class="login_input">
                                  <i class="icon icon-ClosedLock"></i>
                                  <label for="inputPassword" class="sr-only">Confirm Password</label>
                                  <input type="password" id="inputPassword" class="form-control{{ $errors->has('confirmpassword') ? ' is-invalid' : '' }}" placeholder="Confirm Password" name="confirmpassword" required="">
                                  @if ($errors->has('confirmpassword'))
                                  <span class="invalid-feedback" role="alert">
                                      <strong>{{ $errors->first('confirmpassword') }}</strong>
                                  </span>
                                  @endif
                               </div>
                          
                          <!--<div class="checkbox mb-3">
                            <label>
                              <input type="checkbox" value="remember-me"> Remember me
                            </label>
                          </div>-->
                          <button class="btn btn-lg  btn-block btn2" type="submit">Change Password</button>
                          
                        </form>
                        
                           
                        
                       </div>
                        </div>
                        
                        
                        
                       </div>
                      </div> <!-------- sec1 end --------->
                    </div>
                    

               
            </div>
        </div>
    </div>
</div>
@endsection