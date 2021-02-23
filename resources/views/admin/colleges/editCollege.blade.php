@extends('admin.layouts.admin') 
@section('content')
<div class="container-fluid">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header "><div class="col-md-7">Edit Institute</div>
                    <div class="col-md-5"> 
                    @if($college['status'] == '0')
                    <a href="{{route('institute.Deactivate',$college['id'])}}" class="btn btn-warning float-right">Deactivate</a>
                    @else
                    <a href="{{route('institute.Deactivate',$college['id'])}}" class="btn btn-success float-right">Activate</a>
                    @endif
                    </div>
                </div>
                <div class="card-body">
                    @include('multiauth::message')
                    <form method="POST" action="{{route('colleges.update',base64_encode($college['id']))}}" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                        
                        <div class="form-group row">    
                            <label for="input-id" class=" col-sm-2">Institute Name<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                            <input type="text" placeholder="name" value="{{$college['name']}}" name="name" class="mb-2 form-control" required>
                            </div>    
                        </div>    
                        <div class="form-group row">
                            <label for="input-id" class=" col-sm-2">Institute Description<span class="text-danger">*</span> </label>
                            <div class="col-sm-10">
                                 <textarea placeholder="description" value="{{$college['description']}}" name="description" class="mb-2 form-control" required>{{$college['description']}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-id" class=" col-sm-2">Upload Institute Logo<span class="text-danger">*</span> </label>
                            <div class="blahSize">
                                <img class="blah" src="#" alt="your image" />
                                
                            </div>
                        
                            @if($college->attachment['path'])
                            <div class=" wilHide">
                                <img class="blah" style="width:50%;border-radius: unset;"  src="{{asset($college->attachment['path']."/".$college->attachment['name'])}}" alt="your image" />
                            </div>
                            <div class="col-sm-10 wilHide">
                            <a href="javascript:;" class="btn btn-info btn-sm  mrg-t-b-10">Change Logo</a><br>
                            </div>
                            @else
                            <div class="col-sm-10 wilHide">
                            <a href="javascript:;" class="btn btn-info btn-sm  mrg-t-b-10">Upload Logo</a><br>
                            </div>
                            @endif
                            <div class="col-sm-10">    
                                <input type="file" placeholder="logo" name="logo" class="mb-2 form-control imgInp wilShow displayNone" >
                            </div>    
                        </div>
                        <div id="change_loc_old">
                                <div class="btn btn-info mrg-t-b-10" id="change_loc" >Change Location</div>
                                <div class="form-group row">
                                    <label for="input-id" class=" col-sm-2">Country<span class="text-danger">*</span> </label>
                                    <div class="col-sm-10">
                                        <input type="text" placeholder="Country" value="{{$country['name']}}"  class="mb-2 form-control" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-id" class=" col-sm-2">State<span class="text-danger">*</span> </label>
                                    <div class="col-sm-10">
                                        <input type="text" placeholder="State" value="{{$state['name']}}" class="mb-2 form-control" readonly>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-id" class=" col-sm-2">City<span class="text-danger">*</span> </label>
                                    <div class="col-sm-10">
                                        <input type="hidden"  value="{{$college['city_id']}}" name="city_id"  id="cId" class="mb-2 form-control" readonly>
                                        <input type="text" placeholder="City" value="{{$city['name']}}" class="mb-2 form-control" readonly>
                                    </div>
                                </div>
                            </div>
                            <div id="select_change_loc">
                                <div class="btn btn-info mrg-t-b-10" id="prev_change_loc" >Back To Previous Location</div>
                                <div class="form-group row">
                                    <label for="input-id" class=" col-sm-2">Select Country<span class="text-danger">*</span> </label>
                                    <div class="col-sm-10">
                                        <select class="mb-2 form-control" name="country_id" id="country_id" >
                                            <option value='' > Select country</option>
                                            @foreach($countries as $country)
                                                <option value="{{$country['id']}}"> {{$country['name']}}</option>

                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-id" class=" col-sm-2">Select State<span class="text-danger">*</span> </label>
                                    <div class="col-sm-10">
                                        <select class="mb-2 form-control" name="state_id" id="state_id"  >
                                            <option value='' > Select state</option>
                                        
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group row">
                                    <label for="input-id" class=" col-sm-2">Select City<span class="text-danger">*</span> </label>
                                    <div class="col-sm-10">
                                        <select class="mb-2 form-control"  id="city_id" >
                                            <option value='' > Select city</option>
                                        
                                        </select>
                                    </div>
                                </div>
                            </div>
                        <div class="form-group row">
                            <label for="input-id" class=" col-sm-2">Website Link<span class="text-danger">*</span> </label>
                            <div class="col-sm-10">
                                <input type="text" placeholder="website link" name="website_link" value="{{$college['website_link']}}" class="mb-2 form-control" required>
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="input-id" class=" col-sm-2">Institute Type<span class="text-danger">*</span> </label>
                            <div class="col-sm-10">
                                <select class="mb-2 form-control" name="instituteType" id="schoolType" required>
                                    <option value=''> Select Institute Type</option>
                                    @foreach($instituteTypes as $instituteType)
                                        <option value="{{$instituteType['id']}}" {{($college['instituteType'] == $instituteType['id'])  ? 'selected' : '' }}> {{$instituteType['name']}}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <!-- <div class="form-group row">
                        
                            <label for="input-id" class="col-sm-2">University<span class="text-danger">*</span> </label>
                            <div class="col-sm-10">
                                <select class="mb-2 form-control" name="university_id" id="universityId" required>
                                    @foreach($universities as $university)
                                    
                                        <option value="{{$university['id']}}" {{($college['university_id'] == $university['id'])  ? 'selected' : '' }}> {{$university['name']}}</option>

                                    @endforeach
                                </select>
                            </div>
                        </div> -->
                        <div class="form-group row">
                            <label for="input-id" class=" col-sm-2">Institute Status<span class="text-danger">*</span> </label>
                            <div class="col-sm-10">
                                <select class="mb-2 form-control" name="schoolType" id="schoolType" required>
                                    <option value=''> Select School Types</option>
                                    @foreach($schoolTypes as $schoolType)
                                        <option value="{{$schoolType['id']}}" {{($college['schoolType'] == $schoolType['id'])  ? 'selected' : '' }}> {{$schoolType['name']}}</option>

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
                                        <option value="{{$role['id']}}" {{($college['preProcessBy'] == $role['id'])  ? 'selected' : '' }}> {{$role['name']}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                      <!--   <div class="form-group row">
                            <label for="input-id" class=" col-sm-2">Upload Entry Requirements<span class="text-danger">*</span> </label>
                            <div class="blahSize" style="border-radius: unset;">
                                <img class="blah" style="border-radius: unset;" src="#" alt="your image" />
                                
                            </div>
                            @if($college->structure['path'])
                            <div class=" wilHide2" style="width:150px;border: 10px solid lightgray;">
                                <img class="blah" style="width:100%;border-radius: unset;"  src="{{asset($college->structure['path']."/".$college->structure['name'])}}" alt="your image" />
                            </div>
                            <div class="col-sm-7 wilHide2">
                            <a href="javascript:;" class="btn btn-info btn-sm  mrg-t-b-10">Change Entry Requirements</a><br>
                            </div>
                            @else
                            <div class="col-sm-7 wilHide2">
                            <a href="javascript:;" class="btn btn-info btn-sm  mrg-t-b-10">Upload Entry Requirements</a><br>
                            </div>
                            @endif
                            <div class="col-sm-3">    
                                <input type="file" placeholder="structureFile" name="structureFile" class="mb-2 form-control imgInp wilShow2 displayNone" >
                            </div>    
                        </div> -->
                        <div class="form-group row">  
                            <label for="input-id" class="col-sm-2">Commission </label>
                            <div class="col-sm-10">
                                <textarea class="form-control " id="editor"  rows="4" cols="50" name="commission" >{{$college['commission']}}</textarea>
                            </div>
                        </div>
                          <div class="form-group row">    
                            <label for="input-id" class=" col-sm-2">Application Fee<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                            <input type="number" placeholder="application fee" value="{{$college['application_fee']}}" name="application_fee" class="mb-2 form-control" required>
                            </div>    
                        </div>  
                        <div class="form-group row">  
                            <label for="input-id" class="col-sm-2">Entry Requirement</label>
                            <div class="col-sm-10">
                                <textarea class="form-control " id="editorEntry"  rows="4" cols="50" name="entryRequirement" >{{$college['entry_requirement']}}</textarea>
                            </div>
                        </div>
                        <div class="form-group row">  
                            <label for="input-id" class="col-sm-2">Is Card details required ?</label>
                            <div class="col-sm-10">
                                <input type="checkbox" name="isCardRequired" value="yes" {{($college['isCardRequired'] == 'yes')  ? 'checked' : '' }}> Yes
                            </div>
                        </div>
                        <div class="form-group row">  
                            <label for="input-id" class="col-sm-2">Is Student signed documents required ?</label>
                            <div class="col-sm-10">
                                <input type="checkbox" name="isDocumentRequired" value="yes" {{($college['isDocumentRequired'] == 'yes')  ? 'checked' : '' }}> Yes  &nbsp; <input type="file" name="collegeSignedDocument" accept="application/pdf" > (upload document)
                                @if($college->collegeSignedDocuments['path'])
                            <div class=" wilHide">
                                <a  href="{{asset($college->collegeSignedDocuments['path'].'/'.$college->collegeSignedDocuments['name'])}}" download><div class=""><i class="fa fa-download" style="background: #e77817;padding: 10px;" aria-hidden="true"></i></div></a>
                            </div>
                            
                            @endif
                            </div>
                        </div>
                        </div> 
                           
                        <div>
                        <input type="hidden" name="structureimageID" value="{{$college->structure['id']}}" class="mb-2 form-control">
                        <input type="hidden" name="imageID" value="{{$college->attachment['id']}}" class="mb-2 form-control">
                        <input type="hidden" name="collegeSignedDocumentID" value="{{$college->collegeSignedDocuments['id']}}" class="mb-2 form-control">
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