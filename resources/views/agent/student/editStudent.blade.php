@extends('agent.layouts.app')

@section('content')
<div class="container">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
            <div class="col-md-12">
                    <div class="row">
                            <div class="col-md-4 card-header pad-r-10  tabs-border-right " id="EditCformTab">Edit Student</div>
                            <div class="col-md-4 card-header pad-r-10 hideTab tabs-border-right " id="EditCdoctab">Upload Document</div>
                            <div class="col-md-4 card-header pad-r-10 hideTab " id="EditCfinanceTab">Financial Document</div>

                    </div>
                </div>
                <div class="card-body" id="formTab">
                    <form method="POST" action="{{ route('student.update',$student['id']) }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                    <div class="form-group row">    
                        <label for="name" class="col-sm-2">{{ __('Name') }}<span class="text-danger">*</span></label>
                    <div class="col-sm-10">    
                        <input id="name" type="text" class="mb-2 form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $student['name'] }}" required autofocus>
                            @if ($errors->has('name'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                        </div>    
                    </div>  
                    <div class="form-group row">
                            <label for="input-id" class="col-sm-2">Upload Student Image<span class="text-danger">*</span> </label>
                            <div class="col-sm-10"> 
                            <div class="blahSize">
                                <img class="blah" src="#" alt="your image" />
    
                            </div>
                            @if($student->studentImage['path'])
                            <div class="logoSize wilHide">
                                <img class="blah" src="{{asset($student->studentImage['path']."/".$student->studentImage['name'])}}" alt="your image" />
                            </div>
                            <div class="col-sm-10 wilHide">
                            <a href="javascript:;" class="btn btn-info btn-sm  mrg-t-b-10">Change Image</a><br>
                            </div>
                            <input type="hidden" name="imageId" value="{{$student->studentImage['id']}}" >
                            @endif
                            <input type="file" name="file" class="mb-2 form-control imgInp wilShow displayNone" >
                        </div>    
                    </div>  
                    <div class="form-group row">
                            <label for="email" class="col-sm-2">Description<span class="text-danger">*</span></label>
                        <div class="col-sm-10"> 
                            <textarea name="description" class="mb-2 form-control{{ $errors->has('description') ? ' is-invalid' : '' }}">{{ $student['description'] }}</textarea>
                            @if ($errors->has('description'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                            @endif
                        </div>    
                    </div>   
                    <div class="form-group row">
                            <label for="email" class="col-sm-2">{{ __('E-Mail Address') }}<span class="text-danger">*</span></label>
                        <div class="col-sm-10"> 
                            <input id="email" type="email" class="mb-2 form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $student['Email'] }}" required>
                            @if ($errors->has('email'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                        </div>    
                    </div>   
                    <div class="form-group row">
                            <label for="phone" class="col-sm-2">Phone<span class="text-danger">*</span></label>
                        <div class="col-sm-10"> 
                            <input id="phone" type="number" class="mb-2 form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ $student['phone'] }}" required>
                            @if ($errors->has('phone'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('phone') }}</strong>
                            </span>
                            @endif
                        </div>    
                    </div>   
                    <div class="form-group row"> 
                            <label for="input-id" class="col-sm-2 ">Qualification<span class="text-danger">*</span> </label>
                        <div class="col-sm-10"> 
                            <select class="mb-2 form-control" name="qualification"  required>
                                <option value=''> Select qualification</option>
                                <option value='1' {{($student['qualification'] == '1')  ? 'selected' : '' }}> Bec</option>
                                <option value='2' {{($student['qualification'] == '2')  ? 'selected' : '' }}>Mast</option>
                            </select>
                        </div>    
                    </div>  
                    <div class="form-group row"> 
                            <label for="input-id" class="col-sm-2 ">Study Gap<span class="text-danger">*</span> </label>
                        <div class="col-sm-10"> 
                            <select class="mb-2 form-control" name="study_gap"  required>
                                <option value=''> Select Study Gap</option>
                                <option value='1' {{($student['study_gap'] == '1')  ? 'selected' : '' }}> 1 yr</option>
                                <option value='2' {{($student['study_gap'] == '2')  ? 'selected' : '' }}> 2yr</option>
                            </select>
                        </div>    
                    </div>  
                    <div class="form-group row"> 
                            <label for="input-id" class="col-sm-2 ">Ilets Score<span class="text-danger">*</span> </label>
                        <div class="col-sm-10"> 
                        <input id="ilets_score" type="number" class="mb-2 form-control{{ $errors->has('ilets_score') ? ' is-invalid' : '' }}" name="ilets_score" value="{{ $student['ilets_score'] }}" required>
                        </div>    
                    </div>  
                    <div class="form-group row"> 
                        <label for="input-id" class="col-sm-2 ">Ilets Type<span class="text-danger">*</span> </label>
                        <div class="col-sm-10"> 
                            <select class="mb-2 form-control" name="ilets_type"  required>
                                <option value=''> Select Ilets Type</option>
                                <option value='1' {{($student['ilets_type'] == '1')  ? 'selected' : '' }}> Acedemic</option>
                                <option value='2' {{($student['ilets_type'] == '2')  ? 'selected' : '' }}> second</option>
                            </select>
                        </div>    
                    </div>  
                    <div class="form-group row"> 
                            <label for="input-id" class="col-sm-2 ">Math Score<span class="text-danger">*</span> </label>
                        <div class="col-sm-10"> 
                        <input id="math_score" type="number" class="mb-2 form-control{{ $errors->has('math_score') ? ' is-invalid' : '' }}" name="math_score" value="{{ $student['mathScore'] }}" required>
                        </div>    
                    </div>  
                    <div class="form-group row"> 
                            <label for="input-id" class="col-sm-2 ">English Score<span class="text-danger">*</span> </label>
                        <div class="col-sm-10"> 
                        <input id="english_score" type="number" class="mb-2 form-control{{ $errors->has('english_score') ? ' is-invalid' : '' }}" name="english_score" value="{{ $student['english_score'] }}" required>
                        </div>    
                    </div>  
                    <div class="form-group row">
                            <label for="address" class="col-sm-2">Address<span class="text-danger">*</span></label>
                        <div class="col-sm-10"> 
                            <input id="address" type="text" class="mb-2 form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" value="{{ $student['address'] }}" required>
                            @if ($errors->has('address'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('address') }}</strong>
                            </span>
                            @endif
                        </div>    
                    </div>   
                     
                   
                       
                           
                    <button type="submit" class="btn btn-info btn-sm">Save</button>
                    <a href="{{route('student.index')}}" class="btn btn-sm btn-danger float-right">Back</a>
                    </form>
                </div>

                <div class="card-body hide" id="docTab">
                        <form method="POST" action="{{ route('upload.student.document') }}" enctype="multipart/form-data">
                            @csrf
                         
                        <div class="form-group row">
                                <label for="input-id" class="col-sm-2">Upload Student 12th Documents<span class="text-danger">*</span> </label>
                                <div class="col-sm-10"> 
                                    <div class="blahSize">
                                        <img class="blah" src="#" alt="your image" />
        
                                    </div>
                                        <label class="btn btn-warning">
                                                Upload 12th Document
                                          <input type="file" name="SenSecDocument" class="mb-2 hide form-control imgInp" >
                                    </label>
                            </div>    
                        </div>  
                        <div class="form-group row">
                                <label for="input-id" class="col-sm-2">Upload Student Bechular Documents<span class="text-danger">*</span> </label>
                                <div class="col-sm-10"> 
                                    <div class="blahSize2">
                                        <img class="blah2" src="#" alt="your image" />
        
                                    </div>
                                        <label class="btn btn-warning">
                                                Upload Document
                                          <input type="file" name="BecDocument" class="mb-2 hide form-control imgInp2" >
                                    </label>
                            </div>    
                        </div>  
                           
                               
                        <button type="submit" class="btn btn-info btn-sm">Save</button>
                        <a href="{{route('student.index')}}" class="btn btn-sm btn-danger float-right">Back</a>
                        </form>
                    </div>
                    <div class="card-body hide" id="financeTab">
                        <form method="POST" action="{{ route('upload.student.finance.document') }}" enctype="multipart/form-data">
                            @csrf
                         
                        <div class="form-group row">
                                <label for="input-id" class="col-sm-2">Upload Financial Documents<span class="text-danger">*</span> </label>
                                <div class="col-sm-10"> 
                                    <div class="blahSize2">
                                        <img class="blah2" src="#" alt="your image" />
        
                                    </div>
                                    <label class="btn btn-warning">
                                            Upload Finance Document
                                <input type="file" name="studentFinanceDocument" class="mb-2 form-control hide imgInp2" multiple required>
                           </label>
                            </div>    
                        </div>  
                           
                               
                        <button type="submit" class="btn btn-info btn-sm">Save</button>
                        <a href="{{route('student.index')}}" class="btn btn-sm btn-danger float-right">Back</a>
                        </form>
                    </div>
            </div>
        </div>
    </div>
</div>
@endsection
