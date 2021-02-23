@extends('admin.layouts.admin') 

@section('content')
<div class="container-fluid">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">EDIT AGENT &nbsp;  <a class="btn btn-primary btn-sm" href="{{route('agent.createPdf',base64_encode($agent['id']))}}" target="_blank" role="button">Download Agreement</a></div> 
                <div class="card-body">
                    <form method="POST" action="{{ route('agents.update',$agent['id']) }}" aria-label="{{ __('Register') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                      
                        <div class="form-group row">    
                            <label for="name" class="col-sm-2">{{ __('Name') }}<span class="text-danger">*</span></label>
                            <div class="col-sm-10"> 
                                <input id="name" type="text" class="mb-2 form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ old('name',$agent['name']) }}" required autofocus>
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
                                <input id="name" type="text" class="mb-2 form-control{{ $errors->has('company_name') ? ' is-invalid' : '' }}" name="company_name" value="{{ old('company_name',$agent['company_name']) }}" required autofocus>
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
                            @if($agent->attachment['path'])
                        <div class="col-sm-10">
                            <div class="logoSize wilHide">
                                <img class="blah" src="{{asset($agent->attachment['path']."/".$agent->attachment['name'])}}" alt="your image" />
                            </div>
                         
                            <a href="javascript:;" class="btn btn-info btn-sm wilHide mrg-t-b-10">Change Picture</a>
                            <input type="file"  name="file" class="mb-2 form-control imgInp wilShow displayNone" accept="image/jpeg,image/png" >
                        </div>    
                            @else
                        <div class="col-sm-10"> 
                            <input type="file"  name="file" class="mb-2 form-control imgInp wilShow " accept="image/jpeg,image/png" >
                        </div>    
                            @endif
                            
                    </div>
                    <div class="form-group row">
                            <label for="input-id" class="col-sm-2">Upload Agent Contract<span class="text-danger"><small>( upload pdf only)</small>*</span> </label>
                            
                            @if($agent->contractfile['path'])
                        <div class="col-sm-10">
                            <div class="logoSize wilHide">
                                <a class="" href="{{asset($agent->contractfile['path']."/".$agent->contractfile['name'])}}"  download/></a>
                            </div>
                         
                            <a href="javascript:;" class="btn btn-info btn-sm wilHide mrg-t-b-10">Change Picture</a>
                            <input type="file"  name="contractfile" class="mb-2 form-control  wilShow displayNone" accept="application/pdf">
                        </div>    
                            @else
                        <div class="col-sm-10"> 
                            <input type="file"  name="contractfile" class="mb-2 form-control  wilShow " accept="application/pdf">
                        </div>    
                            @endif
                            
                    </div> 
                    <div class="form-group row">
                        <label for="email" class="col-sm-2">{{ __('E-Mail Address') }}<span class="text-danger">*</span></label>
                         <div class="col-sm-10"> 
                            <input id="email" type="email" class="mb-2 form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ old('email',$agent['email']) }}" required>
                                @if ($errors->has('email'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div> 
                    </div> 
                    <div class="form-group row">
                        <label class="col-sm-2">{{ __('Mobile') }}<span class="text-danger">*</span></label>
                         <div class="col-sm-10"> 
                            <input type="number" class="mb-2 form-control{{ $errors->has('mobileno') ? ' is-invalid' : '' }}" name="mobileno" value="{{ old('mobileno',$agent['mobileno']) }}" required>
                                @if ($errors->has('mobileno'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('mobileno') }}</strong>
                                </span>
                            @endif
                        </div> 
                    </div> 
                    <div id="change_loc_old">
                        <div class="btn btn-info mrg-t-b-10" id="change_loc" >Change Location</div>
                                     
                    <div class="form-group row">
                                <label for="input-id" class="col-sm-2">Country<span class="text-danger">*</span> </label>
                        <div class="col-sm-10"> 
                            <input type="hidden"  value="{{$agent['country_id']}}" name="country_id"  id="cntryId" class="mb-2 form-control" readonly>
                            <input type="text" placeholder="Country" value="{{$country['name']}}" id="cntryId"  class="mb-2 form-control" readonly>
                        </div>    
                    </div> 
                    <div class="form-group row">
                            <label for="input-id" class="col-sm-2">State<span class="text-danger">*</span> </label>
                        <div class="col-sm-10"> 
                            <input type="hidden"  value="{{$agent['state_id']}}" name="state_id"  id="sId" class="mb-2 form-control" readonly>
                            <input type="text" placeholder="State" value="{{$state['name']}}"   class="mb-2 form-control" readonly>
                        </div>    
                    </div> 
                    <div class="form-group row">
                            <label for="input-id" class="col-sm-2">City<span class="text-danger">*</span> </label>
                        <div class="col-sm-10"> 
                            <input type="hidden"  value="{{$agent['city_id']}}" name="city_id"  id="cId" class="mb-2 form-control" readonly>
                            <input type="text" placeholder="City" value="{{$city['name']}}" class="mb-2 form-control" readonly>
                            
                               
                        </div>
                    </div>
                    <div class="form-group row">
                            <label class="col-sm-2">{{ __('Address') }}<span class="text-danger">*</span></label>
                            <div class="col-sm-10"> 
                            <textarea class="mb-2 form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ old('address',$agent['address']) }}" required>{{ old('address',$agent['address']) }}</textarea>
                                @if ($errors->has('address'))
                                <span class="invalid-feedback" role="alert">
                                    <strong>{{ $errors->first('address') }}</strong>
                                </span>
                            @endif
                        </div> 
                    </div>
                </div>
                <div id="select_change_loc">
                        <div class="btn btn-info mrg-t-b-10" id="prev_change_loc" >Back To Previous Location</div>
                         
                    <div class="form-group row">
                            <label for="input-id" class="col-sm-2">Select Country<span class="text-danger">*</span> </label>
                        <div class="col-sm-10"> 
                            <select class="mb-2 form-control"  id="country_id" >
                                <option value='' > Select country</option>
                                @foreach($countries as $country)
                                    <option value="{{$country['id']}}"> {{$country['name']}}</option>

                                @endforeach
                            </select>
                        </div>    
                    </div> 
                  
                    <div class="form-group row">
                            <label for="input-id" class="col-sm-2">Select State<span class="text-danger">*</span> </label>
                        <div class="col-sm-10"> 
                            <select class="mb-2 form-control"  id="state_id"  >
                                <option value='' > Select state</option>
                            
                            </select>
                        </div>    
                    </div> 
                    <div class="form-group row">
                            <label for="input-id" class="col-sm-2">Select City<span class="text-danger">*</span> </label>
                        <div class="col-sm-10"> 
                            <select class="mb-2 form-control"  id="city_id" >
                                <option value='' > Select city</option>
                            
                            </select>
                        </div>
                    </div> 
                </div>    
                <div class="form-group row">
                    <label for="input-id" class="col-sm-2">Upload  License Under the prevention of Human Smuggling Act 2000<span class="text-danger">*</span> </label>
                    
                    @if($agent->agentDocument['path'])
                    <a href="{{asset($agent->agentDocument['path']."/".$agent->agentDocument['name'])}}" download>Download</a>
                    <div class="col-md-2 logoSize wilHide2" style="border-radius: unset;">
                        <img class="blah2" src="{{asset($agent->agentDocument['path']."/".$agent->agentDocument['name'])}}" alt="your image" />
                    </div>
                    <div class="col-md-8 wilHide2">
                        <a href="javascript:;" class="btn btn-info btn-sm  mrg-t-b-10">Change Document</a><br>
                    </div>
                    <div class="col-sm-10"> 
                        <input type="file"  name="document" class="mb-2 form-control imgInp2 wilShow2 displayNone" accept="image/jpeg,image/png" >
                    </div>   
                        @else
                    <div class="col-sm-10"> 
                        <input type="file"  name="document" class="mb-2 form-control imgInp2 wilShow2 " accept="image/jpeg,image/png" >
                    </div>
                    @endif
                    <div class="blahSize2">
                        <img class="blah2" src="{{asset('images/site/doc.png')}}" alt="your image" />
                    </div>
                        
                </div> 
                <div class="form-group row">
                    <label for="input-id" class="col-sm-2">Upload Identity Proof<span class="text-danger">*</span> </label>
                    
                    @if($agent->identity['path'])
                    <a href="{{asset($agent->identity['path']."/".$agent->identity['name'])}}" download>Download</a>
                    <div class="col-sm-2 logoSize wilHide3" style="border-radius: unset;">
                        <img class="blah3" src="{{asset($agent->identity['path']."/".$agent->identity['name'])}}" alt="your image" />
                    </div>
                    <div class="col-sm-8 wilHide3">
                        <a href="javascript:;" class="btn btn-info btn-sm  mrg-t-b-10">Change Identity</a><br>
                    </div>
                    <div class="col-sm-10"> 
                        <input type="file"  name="identity" class="mb-2 form-control imgInp3 wilShow3 displayNone" accept="image/jpeg,image/png" >
                    </div> 
                    <div class="blahSize3 col-sm-2 wilShow3 displayNone">
                        <img class="blah3" src="{{asset('images/site/doc.png')}}" alt="your image" />
                        
                    </div>  
                        @else
                    <div class="col-sm-8"> 
                        <input type="file"  name="identity" class="mb-2 form-control imgInp3 wilShow3 " accept="image/jpeg,image/png" >
                    </div>
                    <div class="blahSize3 col-sm-2 wilShow3 displayNone">
                        <img class="blah3" src="{{asset('images/site/doc.png')}}" alt="your image" />
                        
                    </div>
                    @endif
                        
                </div> 
                <div class="form-group row">
                    <label for="input-id" class="col-sm-2">Upload Certificate of Incorporation / Shop Establishment Certificate<span class="text-danger">*</span> </label>
                    
                    @if($agent->establishment['path'])
                    <a href="{{asset($agent->establishment['path']."/".$agent->establishment['name'])}}" download>Download</a>
                    <div class="col-sm-2 logoSize wilHide4" style="border-radius: unset;">
                        <img class="blah4" src="{{asset($agent->establishment['path']."/".$agent->establishment['name'])}}" alt="your image" />
                    </div>
                    <div class="col-sm-8 wilHide4">
                        <a href="javascript:;" class="btn btn-info btn-sm  mrg-t-b-10">Change Establishment Certificate</a><br>
                    </div>
                    <div class="col-sm-10"> 
                        <input type="file"  name="establishment" class="mb-2 form-control imgInp4 wilShow4 displayNone" accept="image/jpeg,image/png" >
                    </div>
                    <div class="blahSize4 col-sm-2 wilShow4 displayNone">
                        <img class="blah4" src="{{asset('images/site/doc.png')}}" alt="your image" />
                        
                    </div>   
                        @else
                    <div class="col-sm-8"> 
                        <input type="file"  name="establishment" class="mb-2 form-control imgInp4 wilShow4 " accept="image/jpeg,image/png" >
                    </div>
                    <div class="blahSize4 col-sm-2 wilShow4 displayNone">
                        <img class="blah4" src="{{asset('images/site/doc.png')}}" alt="your image" />
                        
                    </div>
                    @endif
                        
                </div> 
                        <div class="form-group row">
                        <!-- <label for="password" class="col-sm-2">{{ __('Password') }}<span class="text-danger">*</span></label>
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
                            <input id="password-confirm" type="password" class="form-control" name="password_confirmation" required> -->
                        </div>
                        <?php
                            $user = auth('admin')->user()->roles()->pluck('name');
                        ?>
                        @if($user[0] == 'super')
                        <div class="form-group row">
                            <label for="input-id" class="col-sm-2">Agent account manager </label>
                            <div class="col-sm-10"> 
                                <select class="mb-2 form-control" name="account_manager">
                                    <option value="" > Select account manager </option>
                                    @foreach($account_managers as $account_manager)
                                    <option value="{{$account_manager['id']}}" {{ $account_manager['id'] == $agent['account_manager'] ? "selected" : "" }} > {{$account_manager['name']}}</option>
                                    @endforeach
                                
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-id" class="col-sm-2">Country Access</label>
                            <div class="col-sm-10"> 

                                @foreach($allowCountry as $allowCntry)
                                <input type="checkbox" name="countries[]"  value="{{$allowCntry['id']}}" {{ in_array($allowCntry['id'], $allowCountAgent) ? "checked" : "" }} > &nbsp;<b>{{$allowCntry['name']}}</b>
                                @endforeach
                            </div>
                        </div>   
                        @endif 
                        <input type="hidden" name="agentDocumentID" value="{{$agent->agentDocument['id']}}" class="mb-2 form-control">
                        <input type="hidden" name="imageID" value="{{$agent->attachment['id']}}" class="mb-2 form-control">
                        <button type="submit" class="btn btn-info btn-sm">{{ __('Update') }}</button>
                        <a href="{{route('agents.index')}}" class="btn btn-sm btn-danger float-right">Back</a>
                           
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
