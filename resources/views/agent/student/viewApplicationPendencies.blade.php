@extends('agent.layouts.app')
@section('content')
<style>
    .card{
    margin:10px;
    }
</style>
<div class="container-fluid">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-body">
                    <div class="card-title">Application Pendencies</div>
                    <div class="row">
                        <div class="col-md-6">
                            <div id="toastTypeGroup ">
                                <div class="row capitalize">
                                    <div class="col-md-6 " >
                                        <strong>Course Name: </strong>
                                    </div>
                                    <div class="col-md-6 " >
                                        <strong class="capitalize">{{$studentCourseApplyFors->course['name']}}</strong>
                                    </div>
                                </div>
                                <div class="row capitalize">
                                    <div class="col-md-6 " >
                                        <strong>Internship: </strong>
                                    </div>
                                    <div class="col-md-6 " >
                                        <span class="capitalize">{{$studentCourseApplyFors->course['internship']}}</span>
                                    </div>
                                </div>
                                <div class="row capitalize">
                                    <div class="col-md-6 " >
                                        <strong>Program Weblink: </strong>
                                    </div>
                                    <div class="col-md-6 " >
                                        <a href="{{$studentCourseApplyFors->course['program_weblink']}}" class="capitalize">{{$studentCourseApplyFors->course['program_weblink']}}</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div id="toastTypeGroup">
                                <div class="row capitalize">
                                    <div class="col-md-6 " >
                                        <strong>StudentID: </strong>
                                    </div>
                                    <div class="col-md-6 " >
                                        <h5 class="capitalize">{{$student['student_unique_id']}}</h5>
                                    </div>
                                </div>
                                <div class="row capitalize">
                                    <div class="col-md-6 " >
                                        <strong>Student Name: </strong>
                                    </div>
                                    <div class="col-md-6 " >
                                        {{$student['title']}} {{$student['firstName']}}{{$student['middleName']}} {{$student['lastName']}}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- <div class="col-md-3">
                            <div class="form-group">
                                <label class="form-label" for="showDuration">Show Duration</label>
                                <input id="showDuration" type="number" placeholder="ms" class="form-control" value="300">
                            </div>
                            
                            </div> -->
                    </div>
                </div>
            </div>
        </div>
        <!-- @if($applicationDocuments->count()>0 )
        <div class=" col-md-12">
            <div class="card">
                <div class="card-body">
                    <div id="headingOne" class="card-header">
                        <button type="button" class="text-left m-0 p-0 btn btn-link btn-block ">
                            <h5 class="m-0 p-0 ">Offer Letter</h5>
                        </button>
                    </div>
                    <div >
                        <div class="senSecImg">
                            <br>
                            @if($applicationDocuments->count()>0)
                            <div class="row">
                                @foreach($applicationDocuments as $key=> $applicationDocument)
                                <div class="col-md-4">
                                    <div class="main-card mb-3 card">
                                        <div class="card-body">
                                            <h5 class="card-title">Offer Letter</h5>
                                        </div>
                                        <div class="boxImg" >
                                            <a href="{{asset($applicationDocument['path'].'/'.$applicationDocument['name'])}}" download>
                                                <div class="downloadHover"><i class="fa fa-download download" aria-hidden="true"></i></div>
                                                <img width="100%" src="{{asset($applicationDocument['path'].'/'.$applicationDocument['name'])}}" alt="Card image cap" >
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <p>{{$applicationDocument['comment']}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div>
                            @else
                            <div class="text-center">
                                <p class="text-center">No Qualification Created Yet.</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif  -->

          @if($sopDoc)
        <div class=" col-md-12 pdf listMainGroup pendencyDoc">
            <div class="card">
                <div class="card-body">
                    <div id="headingOne" class="card-header">
                        <button type="button" class="text-left m-0 p-0 btn btn-link btn-block ">
                            <h5 class="m-0 p-0 text-default-color">SOP Document Pendency</h5>
                        </button>
                    </div>
                    <div >
                        <div class="senSecImg">
                            <br>
                            <form method="POST" enctype="multipart/form-data" action="{{route('Soppendency.update',$sopDoc['application_id'])}}"  >
                                @csrf 
                                @method('PUT')
                                <div class="row">
                                    @if($sopDoc['status'] != 2)
                                    <div class="col-md-12">
                                        <div class="main-card mb-3 ">
                                            <div class="card-body">
                                                <h4>Requirements Of SOP Documents<small> (All fields are required.)</small></h4>
                                                <ul class="padding-0">
                                                    <li class="list-none">
                                                        <label class="containerCheckBox"><small>Is your SOP for - <b>{{$studentCourseApplyFors->college['name']}}</b>?</small>
                                                        <input id="gender" type="checkbox" class="mb-2 displayNone" required name="is_uni_sop" <?php if ($studentCourseApplyFors->sopPendency['is_uni_sop'] == 'yes') { echo "checked='checked'"; } ?> value="yes" >    
                                                        <span class="checkmarked"></span>
                                                        </label>
                                                    </li>
                                                    <li class="list-none">
                                                        <label class="containerCheckBox"><small>Is your SOP for Program - <b>{{$studentCourseApplyFors->course['name']}}</b>?</small>
                                                        <input id="gender" type="checkbox" class="mb-2 displayNone" <?php if ($studentCourseApplyFors->sopPendency['is_course_sop'] == 'yes') { echo "checked='checked'"; } ?> required name="is_course_sop" value="yes" >    
                                                        <span class="checkmarked"></span>
                                                        </label>
                                                    </li>
                                                    <li class="list-none">
                                                        <label class="containerCheckBox"><small>Does your SOP clearly defines student Academic Background ?</small>
                                                        <input id="gender" type="checkbox" class="mb-2 displayNone" required name="sop_background" <?php if ($studentCourseApplyFors->sopPendency['sop_background'] == 'yes') { echo "checked='checked'"; } ?> value="yes" >    
                                                        <span class="checkmarked"></span>
                                                        </label>
                                                    </li>
                                                    <li class="list-none">
                                                        <label class="containerCheckBox"><small> Does SOP clearly defines why student has chosen <b>{{$studentCourseApplyFors->course['name']}}</b> in <b>{{$studentCourseApplyFors->college['name']}}</b>?</small>
                                                        <input id="gender" type="checkbox" class="mb-2 displayNone" required name="does_sop_clear_student_course_uni" <?php if ($studentCourseApplyFors->sopPendency['does_sop_clear_student_course_uni'] == 'yes') { echo "checked='checked'"; } ?> value="yes" >    
                                                        <span class="checkmarked"></span>
                                                        </label>
                                                    </li>
                                                    <li class="list-none">
                                                        <label class="containerCheckBox"><small> Does your SOP clearly defines student career goals after completion of <b>{{$studentCourseApplyFors->course['name']}}</b>?</small>
                                                        <input id="gender" type="checkbox" class="mb-2 displayNone" required name="does_sop_clear_student_career_goal" <?php if ($studentCourseApplyFors->sopPendency['does_sop_clear_student_career_goal'] == 'yes') { echo "checked='checked'"; } ?> value="yes" >    
                                                        <span class="checkmarked"></span>
                                                        </label>
                                                    </li>
                                                    <li class="list-none">
                                                        <label class="containerCheckBox"><small>  Does your SOP defines why student wants to study in <b> UK</b> ?</small>
                                                        <input id="gender" type="checkbox" class="mb-2 displayNone" required name="define_why_student_to_study_uk" <?php if ($studentCourseApplyFors->sopPendency['define_why_student_to_study_uk'] == 'yes') { echo "checked='checked'"; } ?> value="yes" >    
                                                        <span class="checkmarked"></span>
                                                        </label>
                                                    </li>
                                                    <li class="list-none">
                                                        <label class="containerCheckBox"><small>  Is your content of SOP original and not copied from somewhere. Admit Offer does not promote plagiarism. SOP's with copied content will be rejected.</small>
                                                        <input id="gender" type="checkbox" class="mb-2 displayNone" required name="is_your_content_original" <?php if ($studentCourseApplyFors->sopPendency['is_your_content_original'] == 'yes') { echo "checked='checked'"; } ?> value="yes" >    
                                                        <span class="checkmarked"></span>
                                                        </label>
                                                    </li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    <div class="col-md-12 ">
                                        <div class="main-card mb-3 ">
                                            @if($sopDoc['status'] == 0 )
                                            <div class="card-body">
                                                <div class="row">
                                                    @if($sopDoc)
                                                    <div class="col-md-12 mb-2">
                                                        <ul class="list-group ">
                                                            <li class="list-group-item d-flex justify-content-between align-items-center">
                                                                <div class="col-md-10">
                                                                    Upload SOP Document (<small>Document Must Be PDF Formate Only</small>)
                                                                    <input type="hidden" name="studentId" value="{{$student['id']}}">
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <button class="btn btn-success btn-default-color float-right">Upload</button>
                                                                    <label class="btn btn-success btn-default-color " >
                                                                    <i class="fa fa-upload " aria-hidden="true"></i><input type="file" name="sop" class="displayNone getImgName" required>
                                                                    </label>
                                                                    @if ($errors->has('sop'))
                                                                    <div class="invalid-feedback" style="display: block!important;" role="alert">
                                                                        <strong>{{ $errors->first('sop') }}</strong>
                                                                    </div>
                                                                    @endif
                                                                    <span id="appendImgName"></span>
                                                                </div>
                                                            </li>
                                                        </ul>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                            @else
                                            <div class="row">
                                                <div class="col-md-12 mb-2">
                                                    <ul class="list-group ">
                                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                                            <div class="col-md-6">
                                                                SOP PDF Document
                                                            </div>
                                                            <div class="col-md-3">
                                                                @if($sopDoc['status'] == 1)
                                                                <strong>Document: </strong> <span class="text-default-color">Uploaded</span> <i class="fa fa-check text-default-color"></i>
                                                                @endif
                                                                @if($sopDoc['status'] == 2)
                                                                <div class="text-success">
                                                                    
                                                                    <label><strong class="text-secondary">Document: </strong>Accepted <i class="fa fa-check " aria-hidden="true"></i></label>
                                                                </div>
                                                                @endif    
                                                                <p> {{$sopDoc['comment']}}</p>
                                                            </div>
                                                            <div class="col-md-3">
                                                                @if($sopDoc['status'] == '1' || $sopDoc['status'] == '3')
                                                                <div class="">
                                                                    @if($sopDoc)
                                                                    <input type="hidden" name="studentId" value="{{$student['id']}}">
                                                                    <button class="btn btn-success btn-default-color float-right">Upload</button>
                                                                    <label class="btn btn-success btn-default-color getImgName" >
                                                                    <i class="fa fa-upload " aria-hidden="true"></i><input type="file" name="sop" class="displayNone" required>
                                                                    </label>
                                                                    <span id="appendImgName"></span>
                                                                    @if ($errors->has('sop'))
                                                                    <div class="invalid-feedback" style="display: block!important;" role="alert">
                                                                        <strong>{{ $errors->first('sop') }}</strong>
                                                                    </div>
                                                                    @endif
                                                                    @endif
                                                                </div>
                                                                @if($sopDoc['status'] == 3)
                                                                <div class="text-danger">
                                                                    <label><strong class="text-secondary">Document: </strong>Rejected</label>
                                                                    <p><strong class="text-secondary">Reason: </strong>{{$sopDoc['reason']}}</p>
                                                                </div>
                                                                @endif    
                                                                @endif  
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @if($pendancyAttachments->count()>0 || $otherAttachments->count() > 0 || $otherAdminDocAttachments->count() > 0)
        <div class=" col-md-12">
            <div class="card">
                <div class="card-body">
                    <div id="headingOne" class="card-header">
                        <button type="button" class="text-left m-0 p-0 btn btn-link btn-block ">
                            <h5 class="m-0 p-0 ">Pendency Document</h5>
                        </button>
                    </div>
                    <div >
                        <div class="senSecImg">
                            <br>
                            @if($pendancyAttachments->count()>0 || $otherAttachments->count() > 0 || $otherAdminDocAttachments->count() > 0)
                            <div class="row">
                                @foreach($otherAdminDocAttachments as $key=> $otherAdminDocAttachment)
                                @if($otherAdminDocAttachment['status'] == 10)
                                <div class="col-md-12 mb-2">

                                <ul class="list-group ">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                    
                                        <div class="col-md-4">
                                            <h5 class="card-title">{{$otherAdminDocAttachment['title']}}</h5>
                                        </div>
                                       
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-md-12 pendancyP">
                                                    @if($otherAdminDocAttachment['status'] == 3)
                                                    <div class="text-danger">
                                                        <label><strong>Document: </strong>Rejected</label>
                                                        <p><strong>Reason: </strong>{{$otherAdminDocAttachment['reason']}}</p>
                                                    </div>
                                                    @endif    
                                                    @if($otherAdminDocAttachment['status'] == 2)
                                                    <div class="text-success">
                                                        <label><strong>Document: </strong>Accepted</label>
                                                    </div>
                                                    @endif    
                                                    <div class="row">
                                                        <form method="POST" enctype="multipart/form-data" action="{{route('pendancyAttachments.update',$otherAdminDocAttachment['id'])}}"  >@csrf 
                                                            <label class="btn btn-success" onchange="javascript:this.form.submit()">Upload Document
                                                            <i class="fa fa-upload " aria-hidden="true"></i><input type="file" name="file" class="displayNone">
                                                            </label><input type="hidden" name="studentId" value="{{$student['id']}}">
                                                        </form>
                                                    </div>
                                                    <p class="capitalize"> {{$otherAdminDocAttachment['comment']}}</p>
                                                </div>
                                            </div>
                                        </div>
                                         <div class="col-md-4" >
                                            @if($otherAdminDocAttachment['name'])
                                            <a href="{{asset($otherAdminDocAttachment['path'].'/'.$otherAdminDocAttachment['name'])}}" download>
                                                <div class="downloadHover"><i class="fa fa-download download" aria-hidden="true"></i></div>
                                                
                                            </a>
                                            @else
                                            <div class="downloadHover"><a href="{{route('pendancyAttachments.delete',$otherAdminDocAttachment['id'])}}"><i class="fa fa-trash download" aria-hidden="true"></i></a></div>
                                           
                                            @endif
                                        </div>
                                    </li>
                                </ul>
                                </div>
                                @else
                                 <div class="col-md-12 mb-2">

                                <ul class="list-group ">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                    
                                        <div class="col-md-4">
                                            <h5 class="card-title">{{$otherAdminDocAttachment['title']}}</h5>
                                        </div>
                                        
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-md-12 pendancyP">
                                                    @if($otherAdminDocAttachment['status'] == 3)
                                                    <div class="text-danger">
                                                        <label><strong>Document: </strong>Rejected</label>
                                                        <p><strong>Reason: </strong>{{$otherAdminDocAttachment['reason']}}</p>
                                                    </div>
                                                    <div class="row">
                                                        <form method="POST" enctype="multipart/form-data" action="{{route('pendancyAttachments.update',$otherAdminDocAttachment['id'])}}"  >@csrf 
                                                            <label class="btn btn-success" onchange="javascript:this.form.submit()">Upload Document
                                                            <i class="fa fa-upload " aria-hidden="true"></i><input type="file" name="file" class="displayNone">
                                                            </label><input type="hidden" name="studentId" value="{{$student['id']}}">
                                                        </form>
                                                    </div>
                                                    @endif    
                                                    @if($otherAdminDocAttachment['status'] == 2)
                                                    <div class="text-success">
                                                        <label><strong>Document: </strong>Accepted</label>
                                                    </div>
                                                    @endif    
                                                    <p> {{$otherAdminDocAttachment['comment']}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-4" >
                                            @if($otherAdminDocAttachment['name'])
                                            <a href="{{asset($otherAdminDocAttachment['path'].'/'.$otherAdminDocAttachment['name'])}}" download>
                                                <div class="downloadHover"><i class="fa fa-download download" aria-hidden="true"></i></div>
                                                
                                            </a>
                                            @else
                                            <div class="downloadHover"><a href="{{route('pendancyAttachments.delete',$otherAdminDocAttachment['id'])}}"><i class="fa fa-trash download" aria-hidden="true"></i></a></div>
                                           
                                            @endif
                                        </div>
                                    </li>
                                </ul>
                                </div>
                                @endif
                                @endforeach
                                @foreach($pendancyAttachments as $key=> $pendancyAttachment)

                                          
                                 @if($pendancyAttachment['type'] != 'sopDocument')
                                 <div class="col-md-12 mb-2">

                                    <ul class="list-group ">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                       
                                            <div class="col-md-4">
                                                <h5 class="card-title">{{$pendancyAttachment->qualification['qualification_grade']}}</h5>
                                                <h5 class="card-subtitle">{{$pendancyAttachment->applicationCourse['name']}}</h5>
                                            </div>
                                            
                                            <div class="col-md-4">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        @if($pendancyAttachment['status'] == 3)
                                                        <div class="text-danger">
                                                            <label><strong>Document: </strong>Rejected</label>
                                                            <p><strong>Reason: </strong>{{$pendancyAttachment['reason']}}</p>
                                                        </div>
                                                        @endif
                                                        @if($pendancyAttachment['status'] == 2)
                                                        <div class="text-success">
                                                            <label><strong>Document: </strong>Accepted</label>
                                                        </div>
                                                        @endif  
                                                        <p>{{$pendancyAttachment['comment']}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-4" >
                                                @if($pendancyAttachment['status'] != 2)
                                                <div class="downloadHover">
                                                    <form method="POST" enctype="multipart/form-data" action="{{route('pendancyAttachments.update',$pendancyAttachment['id'])}}"  >@csrf 
                                                        <label class="download" onchange="javascript:this.form.submit()">
                                                        <i class="fa fa-upload " aria-hidden="true"></i><input type="file" name="file" class="displayNone">
                                                        </label><input type="hidden" name="studentId" value="{{$student['id']}}">
                                                    </form>
                                                </div>
                                                @endif
                                                
                                            </div>
                                       </li>
                                   </ul>
                                </div>
                                @endif
                                @endforeach
                                @foreach($otherAttachments as $key=> $otherAttachment)
                                 <div class="col-md-12 mb-2">

                                <ul class="list-group ">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                    
                                        <div class="col-md-4">
                                            <h5 class="card-title">{{$otherAttachment['title']}}</h5>
                                        </div>
                                       
                                        <div class="col-md-4">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    @if($otherAttachment['status'] == 3)
                                                    <div class="text-danger">
                                                        <label><strong>Document: </strong>Rejected</label>
                                                        <p><strong>Reason: </strong>{{$otherAttachment['reason']}}</p>
                                                    </div>
                                                    @endif
                                                    @if($otherAttachment['status'] == 2)
                                                    <div class="text-success">
                                                        <label><strong>Document: </strong>Accepted</label>
                                                    </div>
                                                    @endif  
                                                    <p>{{$otherAttachment['comment']}}</p>
                                                </div>
                                            </div>
                                        </div>
                                         <div class="col-md-4" >
                                            @if($otherAttachment['status'] != 2)
                                            <div class="downloadHover">
                                                <form method="POST" enctype="multipart/form-data" action="{{route('pendancyAttachments.update',$otherAttachment['id'])}}"  >@csrf 
                                                    <label class="download" onchange="javascript:this.form.submit()">
                                                    <i class="fa fa-upload " aria-hidden="true"></i><input type="file" name="file" class="displayNone">
                                                    </label><input type="hidden" name="studentId" value="{{$student['id']}}">
                                                </form>
                                            </div>
                                            @endif
                                           
                                        </div>
                                    </li>
                                </ul>
                                </div>
                                @endforeach
                            </div>
                            @else
                            <div class="text-center">
                                <p class="text-center">No Pendency Created Yet.</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif 
    </div>
</div>
@endsection
@section('addjavascript')
<noscript>
    <script src="{{ asset('js/app.js') }}" ></script>
</noscript>
@endsection