@extends('admin.layouts.admin') 

@section('content')
<div class="container">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Apply New Student File</div>
                <div class="card-body">
                    <form method="POST" action="{{ route('files.store') }}" enctype="multipart/form-data">
                        @csrf
                        
                       
                    <div class="form-group row">    
                        <label for="name" class="col-sm-2">{{ __('Title') }}<span class="text-danger">*</span></label>
                    <div class="col-sm-10">    
                        <input id="title" type="text" class="mb-2 form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" name="title" value="{{ old('title') }}" required autofocus>
                            @if ($errors->has('title'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('title') }}</strong>
                            </span>
                            @endif
                        </div>    
                    </div>  
                    
                    <div class="form-group row">
                            <label for="email" class="col-sm-2">Description<span class="text-danger">*</span></label>
                        <div class="col-sm-10"> 
                            <textarea name="description" class="mb-2 form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"></textarea>
                            @if ($errors->has('description'))
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $errors->first('description') }}</strong>
                            </span>
                            @endif
                        </div>    
                    </div>   
                  
                    <div class="form-group row"> 
                            <label for="input-id" class="col-sm-2 ">Student<span class="text-danger">*</span> </label>
                        <div class="col-sm-10"> 
                            <select class="mb-2 form-control" name="student"  required>
                                <option value=''> Select student</option>
                                <option value='1'> student1</option>
                                <option value='2'>student2</option>
                            </select>
                        </div>    
                    </div>  
                    <div class="form-group row"> 
                            <label for="input-id" class="col-sm-2 ">Qualification<span class="text-danger">*</span> </label>
                        <div class="col-sm-10"> 
                            <select class="mb-2 form-control" name="qualification"  required>
                                <option value=''> Select qualification</option>
                                <option value='1'> Bechular</option>
                                <option value='2'>Master</option>
                            </select>
                        </div>    
                    </div>  
                     
                    <div class="form-group row"> 
                        <label for="input-id" class="col-sm-2 ">Country<span class="text-danger">*</span> </label>
                        <div class="col-sm-10"> 
                            <select class="mb-2 form-control" name="country_id"  required>
                                <option value=''> Select Country</option>
                                <option value='1'> canada</option>
                                <option value='2'> uk</option>
                            </select>
                        </div>    
                    </div>  
                    <div class="form-group row"> 
                        <label for="input-id" class="col-sm-2 ">College<span class="text-danger">*</span> </label>
                        <div class="col-sm-10"> 
                            <select class="mb-2 form-control" name="college_id"  required>
                                <option value=''> Select College</option>
                                <option value='1'> College 1</option>
                                <option value='2'> College 2</option>
                            </select>
                        </div>    
                    </div>  
                    <div class="form-group row"> 
                        <label for="input-id" class="col-sm-2 ">Subject<span class="text-danger">*</span> </label>
                        <div class="col-sm-10"> 
                            <select class="mb-2 form-control" name="subject_id"  required>
                                <option value=''> Select Subject</option>
                                <option value='1'> Subject 1</option>
                                <option value='2'> Subject 2</option>
                            </select>
                        </div>    
                    </div>  
                    <div class="form-group row"> 
                        <label for="input-id" class="col-sm-2 ">Course<span class="text-danger">*</span> </label>
                        <div class="col-sm-10"> 
                            <select class="mb-2 form-control" name="course_id"  required>
                                <option value=''> Select Course</option>
                                <option value='1'> Course 1</option>
                                <option value='2'> Course 2</option>
                            </select>
                        </div>    
                    </div>  
                           
                    <button type="submit" class="btn btn-info btn-sm">Save</button>
                    <a href="{{route('files.index')}}" class="btn btn-sm btn-danger float-right">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
