@extends('admin.layouts.admin') 

@section('content')
@if(Session::has('success'))
<div class="btn btn-success popOver float-right ">
    <div class="btn btn-success">
        <strong class="text-white">Heads Up!</strong><span class="text-white"> {!!Session::get('success')!!}</span>
    </div>
</div>
@endif
<div class="container-fluid">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Agent Register</div>
                <div class="card-body">
                     @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li><small>{{ $error }}</small></li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    <form method="POST" action="{{ route('agents.store') }}" aria-label="{{ __('Register') }}" enctype="multipart/form-data">
                        @csrf
                        
                       
                    <div class="form-group row">    
                        <label for="name" class="col-sm-2">{{ __('Name') }}<span class="text-danger">*</span></label>
                    <div class="col-sm-10">    
                        <input id="name" type="text" class="mb-2 form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name') }}" required autofocus>
                            @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>    
                    </div> 
                    <div class="form-group row">    
                        <label for="name" class="col-sm-2">{{ __('Company Name') }}<span class="text-danger">*</span></label>
                    <div class="col-sm-10">    
                        <input id="name" type="text" class="mb-2 form-control{{ $errors->has('company_name') ? ' is-invalid' : '' }}" name="company_name" value="{{ old('company_name') }}" required autofocus>
                            @if ($errors->has('company_name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('company_name') }}</strong>
                            </span>
                            @endif
                        </div>    
                    </div>  
                    <div class="form-group row">
                            <label for="input-id" class="col-sm-2">Upload Agent Image<span class="text-danger">*</span> </label>
                        <div class="blahSize">
                            <img class="blah" src="#" alt="your image" />

                        </div>
                        <div class="col-sm-10"> 
                            <input type="file" name="file" class="mb-2 form-control imgInp" required>
                        </div>    
                    </div>  
                    <div class="form-group row">
                            <label for="email" class="col-sm-2">{{ __('E-Mail Address') }}<span class="text-danger">*</span></label>
                        <div class="col-sm-10"> 
                            <input id="email" type="email" class="mb-2 form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email') }}" required>
                            @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>    
                    </div>   
                    <div class="form-group row">
                            <label for="email" class="col-sm-2">{{ __('Mobile Number') }}<span class="text-danger">*</span></label>
                        <div class="col-sm-10"> 
                            <input  type="number" class="mb-2 form-control{{ $errors->has('mobileno') ? ' is-invalid' : '' }}" name="mobileno" value="{{ old('mobileno') }}" required>
                            @if ($errors->has('mobileno'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('mobileno') }}</strong>
                            </span>
                            @endif
                        </div>    
                    </div>   
                    <div class="form-group row">  
                            <label for="input-id" class="col-sm-2 ">Select Country<span class="text-danger">*</span> </label>
                            <div class="col-sm-10"> 
                            <select class="mb-2 form-control" name="country_id" id="country_id" required>
                                <option value=''> Select country</option>
                                @foreach($countries as $country)
                                    <option value="{{$country['id']}}"> {{$country['name']}}</option>

                                @endforeach
                            </select>
                        </div>    
                    </div>  
                    <div class="form-group row"> 
                            <label for="input-id" class="col-sm-2 ">Select State<span class="text-danger">*</span> </label>
                        <div class="col-sm-10"> 
                            <select class="mb-2 form-control" name="state_id" id="state_id"  required>
                                <option value=''> Select state</option>
                            </select>
                        </div>    
                    </div>
                    <div class="form-group row">
                        <label for="input-id" class="col-sm-2 ">Select City<span class="text-danger">*</span> </label>
                        <div class="col-sm-10"> 
                            <select class="mb-2 form-control" name="city_id" id="city_id"  required>
                                <option value=''> Select city</option>
                            </select>
                        </div>    
                    </div>  
                    <div class="form-group row">
                        <label for="password" class="col-sm-2">{{ __('Address') }}<span class="text-danger">*</span></label>
                        <div class="col-sm-10"> 
                            <textarea class="mb-2 form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" required></textarea>
                            @if ($errors->has('address'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                       
                        </div>    
                    </div>  
                    <div class="form-group row">
                            <label for="input-id" class="col-sm-2">License Under the prevention of Human Smuggling Act 2000<span class="text-danger">*</span> </label>
                            <div class="blahSize2">
                                <img class="blah2" src="#" alt="your image" />

                            </div>
                        <div class="col-sm-10"> 
                            <input type="file" name="document" class="mb-2 form-control imgInp2" required>
                       
                        </div>    
                    </div>  
                    <div class="form-group row">
                            <label for="input-id" class="col-sm-2">Identities Proof<span class="text-danger">*</span> </label>
                            <div class="blahSize">
                                <img class="blah" src="#" alt="your image" />

                            </div>
                        <div class="col-sm-10"> 
                            <input type="file" name="identity" class="mb-2 form-control imgInp" required>
                       
                        </div>    
                    </div>
                    <div class="row">
                            <div class="login_input col-md-2 form-group text-left">
                                <label class="small_txt">
                                    <br>
                                    <p>Upload Certificate of Incorporation / Shop Establishment Certificate</p>
                                </label>
                            </div>
                            <div class="login_input col-md-10 form-group text-alignWebkit-center">
                                <div class="blahSize displayNone">
                                    <img class="blah" src="{{asset('images/site/doc.png')}}"  />
                                </div>
                                
                                <input type="file" name="establishment" class="mb-2 form-control imgInp"  required>
                                
                            </div>
                        </div>  
                    <div class="form-group row">
                            <label for="password" class="col-sm-2">{{ __('Password') }}<span class="text-danger">*</span></label>
                        <div class="col-sm-10"> 
                            <input id="password" type="password" class="mb-2 form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" name="password" required>
                            @if ($errors->has('password'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                       
                        </div>    
                    </div>  
                    <div class="form-group row">
                            <label for="password-confirm" class="col-sm-2">{{ __('Confirm Password') }}<span class="text-danger">*</span></label>
                        <div class="col-sm-10"> 
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required>
                        </div>    
                    </div>    
                           
                        <button type="submit" class="btn btn-info btn-sm">{{ __('Register') }}</button>
                        <a href="{{route('agents.index')}}" class="btn btn-sm btn-danger float-right">Back</a>
                           
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
