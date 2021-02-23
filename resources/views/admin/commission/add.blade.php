@extends('admin.layouts.admin') 
@section('content')
<div class="container">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header ">Add New Institute</div>
                <div class="card-body">
                    @include('multiauth::message')
                    <form method="POST" action="{{route('colleges.store')}}" enctype="multipart/form-data">
                    @csrf
                        <div class="form-group row">
                            <label for="input-id" class="col-sm-2">Institute Name<span class="text-danger">*</span></label>
                            <div class="col-sm-10">

                                <input type="text" placeholder="name" name="name"  value="{{old('name')}}" class="mb-2 form-control" required>
                            </div>
                        </div>   
                        
                        <div class="form-group row">
                                <label for="input-id" class=" col-sm-2">Institute Description<span class="text-danger">*</span> </label>
                            <div class="col-sm-10">
                                 <textarea placeholder="description" name="description" value="{{old('description')}}" class="mb-2 form-control" required></textarea>
                            </div>    
                        </div>
                        <div class="form-group row">    
                            <label for="input-id" class="col-sm-2">Upload Institute Logo<span class="text-danger">*</span> </label>
                            <div class="col-sm-10">
                            <div class="blahSize">
                                <img class="blah" src="#" alt="your image" />

                            </div>
                            <label class="btn btn-warning">
                                Upload Logo
                                <input type="file" placeholder="logo" name="logo" class="mb-2 form-control imgInp displayNone" required>
                            </label>
                            </div>
                        </div>
                        <div class="form-group row">      
                            <label for="input-id" class="col-sm-2">Select Country<span class="text-danger">*</span> </label>
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
                            <label for="input-id" class="col-sm-2">Select State<span class="text-danger">*</span> </label>
                            <div class="col-sm-10">
                                <select class="mb-2 form-control" name="state_id" id="state_id"  required>
                                    <option value=''> Select state</option>
                                
                                </select>
                            </div>
                        </div> 
                        <div class="form-group row">    
                            <label for="input-id" class="col-sm-2">Select City<span class="text-danger">*</span> </label>
                            <div class="col-sm-10">
                                <select class="mb-2 form-control" name="city_id" id="city_id"  required>
                                    <option value=''> Select city</option>
                                
                                </select>
                            </div>
                        </div> 
                        <div class="form-group row">  
                            <label for="input-id" class=" col-sm-2">Website Link<span class="text-danger">*</span> </label>
                            <div class="col-sm-10">

                                <input type="text" placeholder="website link" name="website_link" value="{{old('website_link')}}" class="mb-2 form-control" required>
                            </div>
                        </div>
                        
                        <div class="form-group row">
                        
                            <label for="input-id" class="col-sm-2">Institute Type<span class="text-danger">*</span> </label>
                            <div class="col-sm-10">
                                <select class="mb-2 form-control" name="instituteType" id="schoolType" required>
                                    <option value=''> Select Institute Type</option>
                                    @foreach($instituteTypes as $instituteType)
                                        <option value="{{$instituteType['id']}}" > {{$instituteType['name']}}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div> 
                        <!-- <div class="form-group row">
                        
                            <label for="input-id" class="col-sm-2">University<span class="text-danger">*</span> </label>
                            <div class="col-sm-10">
                                <select class="mb-2 form-control" name="university_id" id="universityId" required>
                                    <option value=''> Select Country First</option>
                                </select>
                            </div>
                        </div>  -->
                        <div class="form-group row">  
                            <label for="input-id" class="col-sm-2">Institute Status<span class="text-danger">*</span> </label>
                            <div class="col-sm-10">
                                <select class="mb-2 form-control" name="schoolType" id="schoolType" required>
                                    <option value=''> Select School Types</option>
                                    @foreach($schoolTypes as $schoolType)
                                        <option value="{{$schoolType['id']}}"> {{$schoolType['name']}}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">  
                            <label for="input-id" class="col-sm-2">Pre Process By<span class="text-danger">*</span> </label>
                            <div class="col-sm-10">
                                <select class="mb-2 form-control" name="preProcessBy"  required>
                                    <option value=''> Select Pre Process</option>
                                    @foreach($roles->admins as $role)
                                        <option value="{{$role['id']}}"> {{$role['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">  
                            <label for="input-id" class="col-sm-2">Commission </label>
                            <div class="col-sm-10" >
                                <textarea class="form-control " id="editor"  rows="4" cols="50" name="commission" ></textarea>
                            </div>
                        </div>
                        <div class="form-group row">  
                            <label for="input-id" class="col-sm-2">Entry Requirement</label>
                            <div class="col-sm-10">
                                <textarea class="form-control " id="editorEntry" rows="4" cols="50" name="entryRequirement" ></textarea>
                            </div>
                        </div>
                        
                        <button type="submit" class="btn btn-info btn-sm">Save</button>
                        <a href="{{route('colleges.index')}}" class="btn btn-sm btn-danger float-right">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('addjavascript')
<script src="https://cdn.ckeditor.com/ckeditor5/21.0.0/classic/ckeditor.js"></script>
<script type="text/javascript">
       ClassicEditor
        .create( document.querySelector( '#editor' ) )
        .catch( error => {
            console.error( error );
        } );
         ClassicEditor
        .create( document.querySelector( '#editorEntry' ) )
        .catch( error => {
            console.error( error );
        } );
</script>
@endsection

