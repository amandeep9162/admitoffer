<?php
$studentUser =Auth::guard('student')->check();
?>

@extends(($studentUser === false) ? 'agent.layouts.app' : 'applicant.layouts.app')
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
                    <div class="row">
                        <div class="col-md-6">
                            <div class="card-title">Student Application Details</div>
                        </div>
                        <div class="col-md-6">
                            @if(Auth::guard('student')->check() === false)
                            <a href="{{route('student.show',base64_encode($student['id']))}}" class="btn btn-danger float-right">Back</a>
                            @endif
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-8">
                            <div id="toastTypeGroup" class="strongColor">
                                <div class="row capitalize padd-5-bb-1">
                                    <div class="col-md-6">
                                        <div class="row capitalize">
                                            <div class="col-md-6 " >
                                                <strong>Student ID: </strong>
                                            </div>
                                            <div class="col-md-6 " >
                                                <h5 class="capitalize"><span class="colorBgYellow">{{$student['student_unique_id']}}</span></h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row capitalize">
                                            <div class="col-md-7 " >
                                                <strong>Full Name: </strong>
                                            </div>
                                            <div class="col-md-5 " >
                                                {{$student['title']}} {{$student['firstName']}}{{$student['middleName']}} {{$student['lastName']}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row capitalize padd-5-bb-1">
                                    <div class="col-md-6 ">
                                        <div class="row ">
                                            <div class="col-md-6 " >
                                                <strong>Skype ID: </strong>
                                            </div>
                                            <div class="col-md-6 " >
                                                {{$student['skypeId']}}
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 ">
                                        <div class="row ">
                                            <div class=" col-md-7" >
                                                <strong>Applied On: </strong>
                                            </div>
                                            <div class=" col-md-5" >
                                                {{date('d-M-Y',strtotime($student['created_at']))}}
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row capitalize padd-5-bb-1">
                                    <div class="col-md-6">
                                        <div class="row capitalize">
                                            <div class="col-md-6 " >
                                                <strong>Program Title: </strong>
                                            </div>
                                            <div class="col-md-6 " >
                                                <span class="capitalize">
                                                @if($studentCourseApplyFors->course)
                                                @if($studentCourseApplyFors->course->programTitle)
                                                {{$studentCourseApplyFors->course->programTitle['name']}}
                                                @endif
                                                @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 " >
                                        <div class="row capitalize">
                                            <div class="col-md-7 " >
                                                <strong>Application Level: </strong>
                                            </div>
                                            <div class="col-md-5 " >
                                                <span class="capitalize">{{$student->qualificationLevel['name']}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row capitalize padd-5-bb-1">
                                    <div class="col-md-6 " >
                                        <div class="row capitalize">
                                            <div class="col-md-6 " >
                                                <strong>Program Id: </strong>
                                            </div>
                                            <div class="col-md-6 " >
                                                <h5 class="capitalize"><span class="badge badge-success"> @if($studentCourseApplyFors->course)
                                                    {{$studentCourseApplyFors->course['course_unique_id']}}
                                                    @endif</span>
                                                </h5>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 " >
                                        <div class="row capitalize">
                                            <div class="col-md-7 " >
                                                <strong>Fees: </strong>
                                            </div>
                                            <div class="col-md-5 " >
                                                <span class="capitalize">
                                                @if($studentCourseApplyFors->course)
                                                {{$student->country['currency_icon_name']}} {{$studentCourseApplyFors->course['tution_fee']}}
                                                @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row capitalize padd-5-bb-1">
                                    <div class="col-md-6 " >
                                        <div class="row capitalize">
                                            <div class="col-md-6 " >
                                                <strong>Internship: </strong>
                                            </div>
                                            <div class="col-md-6 " >
                                                <span class="capitalize">{{$studentCourseApplyFors->course['internship']}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 " >
                                        <div class="row capitalize">
                                            <div class="col-md-7 " >
                                                <strong>Application Fee: </strong>
                                            </div>
                                            <div class="col-md-5 " >
                                                <span>{{$student->country['currency_icon_name']}} {{$studentCourseApplyFors->course['application_fee']}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row capitalize padd-5-bb-1">
                                    <div class="col-md-6 " >
                                        <div class="row capitalize">
                                            <div class="col-md-6 " >
                                                <strong>Institute: </strong>
                                            </div>
                                            <div class="col-md-6 " >
                                                <span class="capitalize">
                                                @if($studentCourseApplyFors->course)
                                                @if($studentCourseApplyFors->course->college)
                                                {{$studentCourseApplyFors->course->college['name']}}
                                                @endif
                                                @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <div class="row capitalize">
                                            <div class="col-md-7 " >
                                                <strong>Campus: </strong>
                                            </div>
                                            <div class="col-md-5 " >
                                                <span class="capitalize">
                                                @if($studentCourseApplyFors->course)
                                                {{$studentCourseApplyFors->course['institute_type']}}
                                                @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row capitalize padd-5-bb-1">
                                    <div class="col-md-6 " >
                                        <div class="row capitalize">
                                            <div class="col-md-6 " >
                                                <strong>Intake: </strong>
                                            </div>
                                            <div class="col-md-6 " >
                                                <span class="capitalize">
                                                @if($studentCourseApplyFors->course)
                                                @if($studentCourseApplyFors->course->intakes)
                                                {{$studentCourseApplyFors->course->intakes['name']}}
                                                @endif
                                                @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 " >
                                        <div class="row capitalize">
                                            <div class="col-md-7 " >
                                                <strong>Commission: </strong>
                                            </div>
                                            <div class="col-md-5 " >
                                                <span>{{$student->country['currency_icon_name']}} {{$studentCourseApplyFors->course['agent_commission']}}</span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row capitalize padd-5-bb-1">
                                    <div class="col-md-6 " >
                                        <div class="row " >
                                            <div class="col-md-6 " >
                                                <strong>Program Name: </strong>
                                            </div>
                                            <div class="col-md-6 " >
                                                <span class="capitalize">{{$studentCourseApplyFors->course['name']}}</span>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6 " >
                                        <div class="row " >
                                            <div class="col-md-7 " >
                                                <strong>Applied for country: </strong>
                                            </div>
                                            <div class="col-md-5 " >
                                                <span class="capitalize">{{$student->country['name']}} &nbsp;<img src="{{asset($student->country['path'].'/'.$student->country['image_name'])}} " width='15%'></span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                               
                                <div class="row capitalize padd-5-bb-1">
                                    <div class="col-md-12 " >
                                        <div class="row capitalize">
                                            <div class="col-md-3 " >
                                                <strong>Duration: </strong>
                                            </div>
                                            <div class="col-md-9 " >
                                                <span class="capitalize">
                                                @if($studentCourseApplyFors->course)
                                                {{$studentCourseApplyFors->course['durationText']}}
                                                @endif
                                                </span>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row  padd-5-bb-1 mb-2" >
                                    <div class="col-md-12 " >
                                        <div class="row capitalize">
                                            <div class="col-md-3 " >
                                                <strong>Program Weblink: </strong>
                                            </div>
                                            <div class="col-md-9 " >
                                                <a href="{{$studentCourseApplyFors->course['program_weblink']}}" target="_blank" class="capitalize">{{substr($studentCourseApplyFors->course['program_weblink'],0,100)}}</a>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @if($studentCourseApplyFors['file_status'] == 12 || $studentCourseApplyFors['file_status'] == 13)
                                <div class="row capitalize rejectDanger ">
                                    <div class="col-md-12 text-center" >
                                        <strong >
                                            <h4 class="blinking"> Application Reason: </h4>
                                        </strong>
                                    </div>
                                    <div class="col-md-12" >
                                        <p>{{$studentCourseApplyFors['reason']}}</p>
                                    </div>
                                </div>
                                <br>
                                @endif 
                                @if($studentCourseApplyFors['interviewSchedule'])
                                <div class="row capitalize interviewSch mb-3" >
                                    <div class="col-md-6 " >
                                        <strong > Credibility Interview Schedule: </strong>
                                        @if(!$student['skypeId'])
                                        <form method="POST" action="{{route('update.skypeID')}}">
                                            @csrf
                                            <input type="hidden" name="studentId" value="{{$student['id']}}">
                                            <input type="text" name="skypeId" class="form-control" placeholder="Please Add Skype ID For Interview" required>
                                            <button type="submit" class="btn btn-success btn btn-info" >Update</button>
                                        </form>
                                        @endif
                                    </div>
                                    <div class="col-md-6 " >
                                        <h5>{{date('d-M-Y ',strtotime($studentCourseApplyFors['interviewScheduleDate']))}}</h5>
                                        <h5>{{date('h:i A ',strtotime($studentCourseApplyFors['interviewScheduleTime']))}}</h5>
                                        <h5>{{$studentCourseApplyFors['interviewSchedule']}}</h5>
                                    </div>
                                </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div id="toastTypeGroup">
                                <div class="row ">
                                    <div class="col-md-12">
                                        <ul class="stepper stepper-vertical ">
                                            <h5 class="text-center">Application Current Status</h5>
                                            @foreach($applicationStatus as $status)
                                            @if($student['applingForCountry'] == $status['country'])
                                            <li class="completed">
                                                <a href="javascript:;">
                                                    <div class="stat {{((string)$studentCourseApplyFors['file_status'] == (string)$status['id'])? 'bg-Color-blue':''}}"><small>{{$status['name']}}</small></div>
                                                </a>
                                            </li>
                                            @endif
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="row">
                            <div class="col-md-2 statusPanel statusPanelborderLeft statusPanelBorderLeftRadius <?=$studentCourseApplyFors['file_status'] >= 2 ? 'statusPanelBackground' : ''?> " >Applied</div>
                            <div class="col-md-2 statusPanel <?=$studentCourseApplyFors['file_status'] >= 3 || $studentCourseApplyFors['file_status'] >= 4 ? 'statusPanelBackground' : '' ?>">Offer </div>
                            <div class="col-md-2 statusPanel <?=$studentCourseApplyFors['file_status'] >= 5 ? 'statusPanelBackground' : ''?>">Tuition Paid</div>
                            <div class="col-md-2 statusPanel <?=$studentCourseApplyFors['file_status'] >= 7 || $studentCourseApplyFors['file_status'] >= 8 ? 'statusPanelBackground' : ''?>">Credibility Interview</div>
                            <div class="col-md-2 statusPanel <?=$studentCourseApplyFors['file_status'] >= 9 ? 'statusPanelBackground' : ''?>">CAS Doc</div>
                            <div class="col-md-2 statusPanel <?=$studentCourseApplyFors['file_status'] >= 10 ? 'statusPanelBackground' : ''?> statusPanelBorderRightRadius">VISA</div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-12">
                            <div id="toastTypeGroup">
                                <div class="row ">
                                    <div class="col-md-12">
                                        <br>
                                        <div class="card-header m-0 p-0" style="border-bottom-width: inherit;">
                                            <button type="button" class="text-left m-0 p-0 btn btn-link btn-block " id="timeline-1">
                                                <h5 class=" text-center btn btn-warning">View Status Timeline <i class="fa fa-eye"></i></h5>
                                            </button>
                                        </div>
                                        <div class="timeline-1 hide" style="border-top: 1px solid #1a367e20;">
                                            <br>
                                            <h4 class="text-center">Application Status Timeline</h4>
                                            <?php
                                                $even = 0;
                                                $odd = 0;
                                                ?>
                                            <div class="timeline">
                                                <div class="containertime text-center left">
                                                    <div class="contentLeft">
                                                        <h6><small>New Application</small></h6>
                                                        <p>{{$studentCourseApplyFors['applied_at']}}</p>
                                                    </div>
                                                </div>
                                            </div>
                                            @foreach($applicationStatusTimelines as $key => $applicationStatus)
                                            <div class="timeline">
                                                @if($key == (int)$even)
                                                <?php $odd = (int)$even+1; ?>
                                                <div class="containertime text-center right">
                                                    <div class="contentRight">
                                                        <h6><small>{{$applicationStatus->status['name']}}</small></h6>
                                                        <p>{{$applicationStatus['status_date']}}</p>
                                                    </div>
                                                </div>
                                                @endif 
                                                @if($key == $odd)
                                                <?php $even = $odd+1; ?>
                                                <div class="containertime text-center left">
                                                    <div class="contentLeft">
                                                        <h6><small>{{$applicationStatus->status['name']}}</small></h6>
                                                        <p>{{$applicationStatus['status_date']}}</p>
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
         @if($pendancyAttachments->count()>0 || $otherAttachments->count() > 0 || $otherAdminDocAttachments->count() > 0 || $sopDoc)
        <div class=" col-md-12 pdf pendencyDoc">
            <div class="card">
                <div class="card-body">
                    <div id="headingOne" class="card-header">
                        <button type="button" class="text-left m-0 p-0 btn btn-link btn-block ">
                            <h5 class="m-0 p-0 text-default-color">You have
                                @if($sopDoc)
                                @if($sopDoc['status'] == '0')

                                {{$pendancyAttachments->count() + $otherAttachments->count() + $otherAdminDocAttachments->count() + 1}} Pendency 
                                @else
                                {{$pendancyAttachments->count() + $otherAttachments->count() + $otherAdminDocAttachments->count() + 0}} Pendency 
                                @endif
                                @else
                                 {{$pendancyAttachments->count() + $otherAttachments->count() + $otherAdminDocAttachments->count() }} Pendency 
                                
                                @endif
                            </h5>
                        </button>
                    </div>
                    <div >
                        <div class="senSecImg listMainGroup">
                            <br>
                            @if($pendancyAttachments->count()>0 || $otherAttachments->count() > 0 || $otherAdminDocAttachments->count() > 0 || $sopDoc)
                            <div class="row">
                            <ul>
                                
                                @foreach($otherAdminDocAttachments as $key=> $otherAdminDocAttachment)
                                    @if($otherAdminDocAttachment['status'] == 10)
                                        <li class="">{{$otherAdminDocAttachment['title']}}</li>
                                    
                                    @else
                                        @if($otherAdminDocAttachment['status'] == '0' || $otherAdminDocAttachment['status'] == '3')
                                        <li class="">{{$otherAdminDocAttachment['title']}}</li>
                                        @endif
                                   
                                    @endif
                                @endforeach
                                @foreach($pendancyAttachments as $key=> $pendancyAttachment)
                                     @if($pendancyAttachment['status'] == '0' || $pendancyAttachment['status'] == '3')
                                        <li class="">{{$pendancyAttachment->qualification['qualification_grade']}}</li>
                                     @endif
                               
                                @endforeach
                                @foreach($otherAttachments as $key=> $otherAttachment)
                                    @if($otherAttachment['status'] == '0' || $otherAttachment['status'] == '3')
                                        <li class="">{{$otherAttachment['title']}}</li>
                                    
                                    @endif
                                @endforeach
                                @if($sopDoc)
                                <li class="m-0 p-0 ">SOP Document Pendency</li>
                                @endif
                            </ul>
                            </div>
                            @else
                            <div class="text-center">
                                <p class="text-center">No Pendency.</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif 



        @if($student['applingForCountry'] == "230" )
        @if($studentCourseApplyFors['file_status'] != "12" )
        @if($studentCourseApplyFors['file_status'] != "13")
        @if($studentCourseApplyFors['file_status'] >= '3' || $studentCourseApplyFors['file_status'] >= '4' )
        @if($applicationDocuments->count() > 0 )
        @if($studentCourseApplyFors['file_status'] >= '9')
        <div class=" col-md-12 pdf">
            <div class="card">
                <div class="card-body">
                    <div id="headingOne" class="card-header">
                        <button type="button" class="text-left m-0 p-0 btn btn-link btn-block ">
                            <h5 class="m-0 p-0 text-default-color">VISA Document</h5>
                        </button>
                    </div>
                    <div >
                        <div class="senSecImg">
                            <br>
                            @if($applicationDocuments->count() > 0)
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="main-card mb-3 ">
                                        <div class="card-body">
                                            <div class="row listMainGroup">
                                                @if($visaDocument)
                                                <div class="col-md-12 mb-2">
                                                    <ul class="list-group ">
                                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                                            <div class="col-md-4">
                                                                VISA Uploaded
                                                            </div>
                                                            <div class="col-md-4">
                                                                @if($visaDocument['status'] == 1)
                                                                <div style="margin: 10px 0px 10px 0px;" class="displayNone pendancyC">
                                                                    <form method="POST" action="{{route('pendancyAttachments.rejected',$visaDocument['id'])}}">
                                                                        @csrf
                                                                        <textarea name="reason" class="form-control"></textarea>
                                                                        <button style="margin-top:10px" class="btn btn-success float-right" >Save</button>
                                                                    </form>
                                                                    <br>
                                                                </div>
                                                                @endif
                                                                @if($visaDocument['status'] == 3)
                                                                <div class="text-danger">
                                                                    <label><strong class="text-secondary">Document: </strong>Rejected</label>
                                                                    <p><strong class="text-secondary">Reason: </strong>{{$visaDocument['reason']}}</p>
                                                                </div>
                                                                @endif 
                                                                @if($visaDocument['status'] == 2)
                                                                <div class="text-success">
                                                                    <label><strong class="text-secondary">Document: </strong>Accepted <i class="fa fa-check " aria-hidden="true"></i></label>
                                                                </div>
                                                                @endif
                                                                <p> {{$visaDocument['comment']}}</p>
                                                            </div>
                                                            <div class="col-md-4">
                                                                @if((int)$visaDocument['status'] != 2)
                                                                <div class="col-md-12">
                                                                    <h5 class="card-title">Upload VISA Document </h5>
                                                                    <form method="POST" enctype="multipart/form-data" action="{{route('visa.upload',$studentCourseApplyFors['id'])}}"  >@csrf 
                                                                        <label class="btn btn-success btn-default-color" onchange="javascript:this.form.submit()" >Choose Document
                                                                        <i class="fa fa-upload " aria-hidden="true"></i><input type="file" name="file" class="displayNone" accept="application/pdf">
                                                                        </label>
                                                                        <input type="hidden" name="studentId" value="{{$student['id']}}">
                                                                        @if ($errors->has('file'))
                                                                        <span class="invalid-feedback" style="display: block!important;" role="alert">
                                                                        <strong>{{ $errors->first('file') }}</strong>
                                                                        </span>
                                                                        @endif
                                                                    </form>
                                                                </div>
                                                                @endif
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                @else
                                                @if($studentCourseApplyFors['file_status'] >= '8')
                                                <div class="col-md-12 mb-2">
                                                    <ul class="list-group ">
                                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                                            <div class="col-md-4">
                                                                Upload VISA Document
                                                            </div>
                                                            <div class="col-md-4">
                                                                <form method="POST" enctype="multipart/form-data" action="{{route('visa.upload',$studentCourseApplyFors['id'])}}"  >
                                                                    @csrf 
                                                                    <label class="btn btn-success btn-default-color" onchange="javascript:this.form.submit()" >Choose VISA Document
                                                                    <i class="fa fa-upload " aria-hidden="true"></i><input type="file" name="file" class="displayNone" accept="application/pdf">
                                                                    </label>
                                                                    <input type="hidden" name="studentId" value="{{$student['id']}}">
                                                                    <br>
                                                                    @if ($errors->has('file'))
                                                                    <div class="invalid-feedback" style="display: block!important;" role="alert">
                                                                        <strong>{{ $errors->first('file') }}</strong>
                                                                    </div>
                                                                    @endif
                                                                </form>
                                                            </div>
                                                        </li>
                                                    </ul>
                                                </div>
                                                @else
                                                <div class="col-md-12 text-center">
                                                    <p>It Will Open If Required For Course.</p>
                                                </div>
                                                @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="text-center">
                                <p class="text-center">Visa Document Section.</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif 
        @if($studentCourseApplyFors['file_status'] >= '7')
        <div class=" col-md-12 pdf">
            <div class="card">
                <div class="card-body">
                    <div id="headingOne" class="card-header">
                        <button type="button" class="text-left m-0 p-0 btn btn-link btn-block ">
                            <h5 class="m-0 p-0 text-default-color">Cleared CAS Document By University</h5>
                        </button>
                    </div>
                    <div >
                        <div class="senSecImg listMainGroup">
                            <br>
                            @if($applicationCASDocument)
                            <div class="col-md-12 mb-2">
                                <ul class="list-group ">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div class="col-md-4">
                                            CAS Document By University (<small>Download</small>)
                                        </div>
                                        <div class="col-md-4">
                                            <div class="" >
                                                <a href="{{asset($applicationCASDocument['path'].'/'.$applicationCASDocument['name'])}}" download>
                                                    <div class="downloadHover"><i class="fa fa-download download text-default-color" aria-hidden="true"></i></div>
                                                </a>
                                                <?php
                                                    $data['path'] = $applicationCASDocument['path'];
                                                    $data['name'] = $applicationCASDocument['name'];
                                                ?>
                                                <form method="POST" action="{{route('pdf.view')}}"  target="_blank">
                                                    @csrf
                                                 <input type="hidden" name="name"   value="{{$data['name']}}">
                                                 <input type="hidden" name="path"   value="{{$data['path']}}">
                                                 <button class="btn btn-info" target="_blank">View Pdf</button>
                                                </form>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                            @else
                            <div class="text-center">
                                <p class="text-center">CAS will upload by university after verify all CAS Documents.</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        @if($studentCourseApplyFors['file_status'] >= '8')
        <div class=" col-md-12 pdf">
            <div class="card">
                <div class="card-body">
                    <div id="headingOne" class="card-header">
                        <button type="button" class="text-left m-0 p-0 btn btn-link btn-block ">
                            <h5 class="m-0 p-0 text-default-color">CAS Document</h5>
                        </button>
                    </div>
                    <div >
                        <div class="senSecImg">
                            <br>
                            @if($applicationDocuments->count()>0)
                            <div class="row">
                                @foreach($applicationDocuments as $key=> $applicationDocument)
                                <div class="col-md-4">
                                    <div class="main-card mb-3 ">
                                        <div class="card-body">
                                            <div class="row">
                                                @if($casDocument)
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="main-card mb-3 card">
                                                            <div class="card-body">
                                                                <h5 class="card-title"> 
                                                                    CAS Document Uploaded
                                                                </h5>
                                                            </div>
                                                            <div class="text-center boxImg" >
                                                                <img  src="{{asset('images/site/pdfIcon.png')}}" alt="Card image cap" >
                                                            </div>
                                                            <div class="card-body">
                                                                <div class="row">
                                                                    <div class="col-md-12 pendancyP">
                                                                        @if($casDocument['status'] == 1)
                                                                        <div style="margin: 10px 0px 10px 0px;" class="displayNone pendancyC">
                                                                            <form method="POST" action="{{route('pendancyAttachments.rejected',$casDocument['id'])}}">
                                                                                @csrf
                                                                                <textarea name="reason" class="form-control"></textarea>
                                                                                <button style="margin-top:10px" class="btn btn-success float-right" >Save</button>
                                                                            </form>
                                                                            <br>
                                                                        </div>
                                                                        @endif
                                                                        <hr class="row">
                                                                        @if($casDocument['status'] == 3)
                                                                        <div class="text-danger">
                                                                            <label><strong class="text-secondary">Document: </strong>Rejected</label>
                                                                            <p><strong class="text-secondary">Reason: </strong>{{$casDocument['reason']}}</p>
                                                                        </div>
                                                                        @endif    
                                                                        @if($casDocument['status'] == 2)
                                                                        <div class="text-success">
                                                                            <label><strong class="text-secondary">Document: </strong>Accepted <i class="fa fa-check " aria-hidden="true"></i></label>
                                                                        </div>
                                                                        @endif    
                                                                        <p> {{$casDocument['comment']}}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                @if((int)$casDocument['status'] != 2)
                                                <div class="col-md-12">
                                                    <h5 class="card-title">Upload CAS Document (<small>PDF Only</small>)</h5>
                                                    <form method="POST" enctype="multipart/form-data" action="{{route('casDoc.upload',$applicationDocument['application_id'])}}"  >@csrf 
                                                        <label class="btn btn-success btn-default-color" onchange="javascript:this.form.submit()" >Choose Document
                                                        <i class="fa fa-upload " aria-hidden="true"></i><input type="file" name="file" class="displayNone" accept="application/pdf">
                                                        </label>
                                                        <input type="hidden" name="studentId" value="{{$student['id']}}">
                                                        @if ($errors->has('file'))
                                                        <span class="invalid-feedback" style="display: block!important;" role="alert">
                                                        <strong>{{ $errors->first('file') }}</strong>
                                                        </span>
                                                        @endif
                                                    </form>
                                                </div>
                                                @endif
                                                @else
                                                @if($studentCourseApplyFors['file_status'] == '8')
                                                <div class="col-md-12">
                                                    <h5 class="card-title">Upload CAS Document (<small>Allow PDF Formate Only</small>)</h5>
                                                    <form method="POST" enctype="multipart/form-data" action="{{route('casDoc.upload',$applicationDocument['application_id'])}}"  >
                                                        @csrf 
                                                        <label class="btn btn-success btn-default-color" onchange="javascript:this.form.submit()" >Choose Document
                                                        <i class="fa fa-upload " aria-hidden="true"></i><input type="file" name="file" class="displayNone" accept="application/pdf">
                                                        </label>
                                                        <input type="hidden" name="studentId" value="{{$student['id']}}">
                                                        <br>
                                                        @if ($errors->has('file'))
                                                        <div class="invalid-feedback" style="display: block!important;" role="alert">
                                                            <strong>{{ $errors->first('file') }}</strong>
                                                        </div>
                                                        @endif
                                                    </form>
                                                </div>
                                                @else
                                                <div class="col-md-12 text-center">
                                                    <p>It Will Open If Required For Course.</p>
                                                </div>
                                                @endif
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                <div class="col-md-7">
                                    <div class="main-card mb-3 ">
                                        <div class="card-body">
                                            <h4>Required Documents By Institute</h4>
                                            <ul>
                                                <li>28 days old bank covering letter</li>
                                                <li>28 days old bank statement</li>
                                                <li>28 days old Fixed deposit covering letter</li>
                                                <li>Fixed deposit certificate bank certified</li>
                                                <li>Education loan letter</li>
                                                <li>Medical certificate</li>
                                                <li>Parent consent letter (required if Parent are sponsoring)</li>
                                                <li>Please check list of Financial Banks acceptable by UK Embassy - <a href="https://www.gov.uk/guidance/immigration-rules/immigration-rules-appendix-p-lists-of-financial-institutions"> https://www.gov.uk/guidance/immigration-rules/immigration-rules-appendix-p-lists-of-financial-institutions</a></li>
                                                <li>Please add - Birth certificate translation certificate in English (must be with contact details of the translator)</li>
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <hr>
                                        <h6>Download demo Cas Document (<a href="{{asset('images/dummy.pdf')}}" download>CAS Document pdf</a>).</h6>
                                    </div>
                                    <div class="col-md-12">
                                        <hr>
                                        <h3>CAS Calculator <i class="fa fa-calculator" aria-hidden="true"></i></h3>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="row">
                                            <div class="col-md-8">
                                                <div class="row">
                                                    <div class="col-md-10"><input type="number" name="outstandingFees" class="form-control outstandingFees" placeholder="What is your outstanding Fees of First year?"></div>
                                                    <div class="col-md-2"><span class="calculaterRefresh"><i class="fas fa-sync " style="font-size: 20px;line-height: 2;color: green;"></i></span></div>
                                                </div>
                                                <span class="errorFee"></span>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <label class="containerRadio "><small style="font-size: 15px;"> (Inner london)</small>
                                                        <input type="radio" name="abc" class="innerLondon displayNone" ><span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                    <div class="col-md-6 ">
                                                        <label class="containerRadio "><small style="font-size: 15px;"> (Outer london)</small>
                                                        <input type="radio" name="abc" class="outerLondon" >
                                                        <span class="checkmark"></span>
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="col-md-7 text-right">
                                                <div class="hide" id="innerLondon">
                                                    <div class="mb-2 bb-1">
                                                        <div>
                                                            <span class="float-left" >( UKBA Specified )</span><span><strong>+</strong> 11385 </span>
                                                            <input type="hidden" class="ukba" value="11385">
                                                        </div>
                                                        <div class="mb-2">
                                                            <span class="float-left" >( Conversion Margin )</span><span><strong>+</strong> 500 </span>
                                                            <input type="hidden" class="conversion" value="500">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            Total
                                                            <!-- <button id="calculate"  class="btn btn-success calculate">Calculate</button> -->
                                                        </div>
                                                        <div class="col-md-8">
                                                            <span class="total"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="hide" id="outerLondon">
                                                    <div class="mb-2 bb-1">
                                                        <div>
                                                            <span class="float-left" >( UKBA Specified )</span><span><strong>+</strong> 9135 </span>
                                                            <input type="hidden" class="ukbas" value="9135">
                                                        </div>
                                                        <div class="mb-2">
                                                            <span class="float-left" >( Conversion Margin )</span><span><strong>+</strong> 500 </span>
                                                            <input type="hidden" class="conversions" value="500">
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-4">
                                                            Total
                                                            <!-- <button id="calculate"  class="btn btn-success calculater">Calculate</button> -->
                                                        </div>
                                                        <div class="col-md-8">
                                                            <span class="total"></span>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <br>
                                        <hr>
                                        <div id="oanda_ecc">
                                            <!-- Note: If you alter or remove the following code, the embedded currency widget will not work-->
                                            <span style="color:#000; text-decoration:none; font-size:9px; float:left;">Currency Converter <a id="oanda_cc_link" style="color:#000; font-size:9px;" href="https://www.oanda.com/currency/converter/">by OANDA</a></span>
                                            <script src="https://www.oanda.com/embedded/converter/get/b2FuZGFlY2N1c2VyLy9kZWZhdWx0/?lang=en"></script>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @else
                            <div class="text-center">
                                <p class="text-center">No Qualification.</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif
        <div class=" col-md-12 pdf">
            <div class="card">
                <div class="card-body">
                    <div id="headingOne" class="card-header">
                        <button type="button" class="text-left m-0 p-0 btn btn-link btn-block ">
                            <h5 class="m-0 p-0 text-default-color">Pay Tuition Fee (TT Copy)</h5>
                            @if($applicationDocuments->count() > 0)
                            @if(!$applicationFee)
                            <p>Offer Letter Received, Kindly find the attached offer letter and pay the fee as mentioned in the offer letter. And upload the TT Copy. </p>
                            @endif
                            @endif
                        </button>
                    </div>
                    <div>
                        <div class="senSecImg">
                            <br>
                            @if($applicationDocuments->count()>0)
                            <div class="row listMainGroup">
                                @foreach($applicationDocuments as $key=> $applicationDocument)
                                <div class="col-md-12 mb-2">
                                    <ul class="list-group ">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div class="col-md-12">
                                                <div class="row ">
                                                    @if($applicationFee)
                                                    <div class="col-md-12">
                                                        <div class=" row ">
                                                            <div class="col-md-4">
                                                                <h6 >Tution Fee : 
                                                                    @if($applicationFee->applicationFee)
                                                                    {{$student->country['currency_icon_name']}} {{$applicationFee->applicationFee['tution_fee']}}
                                                                    @endif
                                                                </h6>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="row">
                                                                    <div class="col-md-12 pendancyP">
                                                                        @if($applicationFee['status'] == 1)
                                                                        <div style="margin: 10px 0px 10px 0px;" class="displayNone pendancyC">
                                                                            <form method="POST" action="{{route('pendancyAttachments.rejected',$applicationFee['id'])}}">
                                                                                @csrf
                                                                                <textarea name="reason" class="form-control"></textarea>
                                                                                <button style="margin-top:10px" class="btn btn-success btn btn-info float-right" >Save</button>
                                                                            </form>
                                                                            <br>
                                                                        </div>
                                                                        @endif
                                                                        @if($applicationFee['status'] == 3)
                                                                        <div class="text-danger">
                                                                            <label><strong class="text-secondary">Document: </strong>Rejected</label>
                                                                            <p><strong class="text-secondary">Reason: </strong><span class="capitalize">{{$applicationFee['reason']}}</span></p>
                                                                        </div>
                                                                        @endif    
                                                                        @if($applicationFee['status'] == 2)
                                                                        <div class="text-success">
                                                                            <label><strong class="text-secondary">Document: </strong>Accepted <i class="fa fa-check" aria-hidden="true"></i></label>
                                                                        </div>
                                                                        @endif    
                                                                        <p class="capitalize"> {{$applicationFee['comment']}}</p>
                                                                    </div>
                                                                    @if($applicationFee['status'] != 2)
                                                                    <div class="col-md-12">
                                                                        <h5 class="card-title">Upload Tuition Fee Receipt</h5>
                                                                        <form method="POST" enctype="multipart/form-data" action="{{route('tutionFee.upload',$applicationDocument['application_id'])}}"  >@csrf 
                                                                            <label class="btn btn-success btn-default-color" >Choose TT Copy
                                                                            <i class="fa fa-upload " aria-hidden="true"></i><input type="file" name="file" class="displayNone" accept="application/pdf">
                                                                            </label>
                                                                            <input type="hidden" name="studentId" value="{{$student['id']}}">
                                                                            <input type="number" name="tutionFee" class="form-control" placeholder="Tution Fee" value="{{$applicationFee->applicationFee['tution_fee']}}" ><br>
                                                                            @if ($errors->has('file'))
                                                                            <span class="invalid-feedback" style="display: block!important;" role="alert">
                                                                            <strong>{{ $errors->first('file') }}</strong>
                                                                            </span>
                                                                            @endif
                                                                            <button class="btn btn-success btn btn-info">Save</button>
                                                                        </form>
                                                                    </div>
                                                                    @endif
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    @else
                                                    <div class="col-md-4">
                                                        <h3>Upload TT Copy</h3>
                                                    </div>
                                                    <div class="col-md-4">
                                                        <form method="POST" enctype="multipart/form-data" action="{{route('tutionFee.upload',$applicationDocument['application_id'])}}"  >
                                                            @csrf 
                                                            <label class="btn btn-success btn-default-color" >Choose TT Copy
                                                            <i class="fa fa-upload " aria-hidden="true"></i><input type="file" name="file" class="displayNone" accept="application/pdf">
                                                            </label>
                                                            <input type="hidden" name="studentId" value="{{$student['id']}}">
                                                            <input type="number" name="tutionFee" class="form-control" placeholder="Tution Fee" ><br>
                                                            <button class="btn btn-success btn btn-info">Save</button>
                                                            @if ($errors->has('file'))
                                                            <div class="invalid-feedback" style="display: block!important;" role="alert">
                                                                <strong>{{ $errors->first('file') }}</strong>
                                                            </div>
                                                            @endif
                                                        </form>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                @endforeach
                            </div>
                            @else
                            <div class="text-center">
                                <p class="text-center">No Qualification.</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class=" col-md-12 pdf">
            <div class="card">
                <div class="card-body">
                    <div id="headingOne" class="card-header">
                        <button type="button" class="text-left m-0 p-0 btn btn-link btn-block ">
                            <h5 class="m-0 p-0 text-default-color">Offer Letter</h5>
                        </button>
                    </div>
                    <div >
                        <div class="senSecImg">
                            <br>
                            @if($applicationDocuments->count()>0)
                            <div class="row listMainGroup">
                                @foreach($applicationDocuments as $key=> $applicationDocument)
                                <div class="col-md-12 mb-2">
                                    <ul class="list-group ">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div class="col-md-4">
                                                Offer Letter (<small>Download</small>)
                                            </div>
                                            <div class="col-md-4">
                                                <p>{{$applicationDocument['comment']}}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="" >
                                                    <a href="{{asset($applicationDocument['path'].'/'.$applicationDocument['name'])}}" download>
                                                        <div class="downloadHover"><i class="fa fa-download download text-default-color" aria-hidden="true"></i></div>
                                                    </a>
                                                     <?php
                                                        $data['path'] = $applicationDocument['path'];
                                                        $data['name'] = $applicationDocument['name'];
                                                    ?>
                                                    <form method="POST" action="{{route('pdf.view')}}"  target="_blank">
                                                        @csrf
                                                     <input type="hidden" name="name"   value="{{$data['name']}}">
                                                     <input type="hidden" name="path"   value="{{$data['path']}}">
                                                     <button class="btn btn-info" target="_blank">View Pdf</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                @endforeach
                            </div>
                            @else
                            <div class="text-center">
                                <p class="text-center">No offer letter available.</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif 
        @endif 
        @endif 
        @endif 
        @endif 
        @if($student['applingForCountry'] == "38" )
        @include('agent/student/CanadaStatusApplication')
        @endif 
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
                                                <h4>Requirements Of SOP Document<small> (All fields are required)</small></h4>
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
                                                                    Upload SOP Document (<small>Document Must Be PDF Format Only</small>)
                                                                    <input type="hidden" name="studentId" value="{{$student['id']}}">
                                                                </div>
                                                                <div class="col-md-2">
                                                                    <button class="btn btn-success btn-default-color float-right">Upload</button>
                                                                    <label class="btn btn-success btn-default-color " >
                                                                    <i class="fa fa-upload " aria-hidden="true"></i><input type="file" name="sop" class="displayNone getImgName" accept="application/pdf" required >
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
                                                                    <i class="fa fa-upload " aria-hidden="true"></i><input type="file" name="sop" class="displayNone" accept="application/pdf" required>
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
        <div class=" col-md-12 pdf pendencyDoc">
            <div class="card">
                <div class="card-body">
                    <div id="headingOne" class="card-header">
                        <button type="button" class="text-left m-0 p-0 btn btn-link btn-block ">
                            <h5 class="m-0 p-0 text-default-color">Pendency Document  @if ($errors->has('file'))
                                <span class="invalid-feedback" style="display: block!important;" role="alert">
                                <strong>{{ $errors->first('file') }}</strong>
                                </span>
                                @endif
                            </h5>
                        </button>
                    </div>
                    <div >
                        <div class="senSecImg listMainGroup">
                            <br>
                            @if($pendancyAttachments->count()>0 || $otherAttachments->count() > 0 || $otherAdminDocAttachments->count() > 0)
                            <div class="row">
                                @foreach($otherAdminDocAttachments as $key=> $otherAdminDocAttachment)
                                @if($otherAdminDocAttachment['status'] == 10)
                                <div class="col-md-12">
                                    <div class="main-card mb-3 card">
                                        <div class="card-body">
                                            <h5 class="card-title">{{$otherAdminDocAttachment['title']}}</h5>
                                        </div>
                                        <div class="boxImg" >
                                            @if($otherAdminDocAttachment['name'])
                                            <a href="{{asset($otherAdminDocAttachment['path'].'/'.$otherAdminDocAttachment['name'])}}" download>
                                                <div class="downloadHover"><i class="fa fa-download download" aria-hidden="true"></i><button class="btn btn-success">Download</button></div>
                                            </a>
                                            @else
                                            <div class="downloadHover"><a href="{{route('pendancyAttachments.delete',$otherAdminDocAttachment['id'])}}"><i class="fa fa-trash download" aria-hidden="true"></i></a></div>
                                            @endif
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12 pendancyP">
                                                    @if($otherAdminDocAttachment['status'] == 3)
                                                    <div class="text-danger">
                                                        <label><strong class="text-secondary">Document: </strong>Rejected</label>
                                                        <p><strong class="text-secondary">Reason: </strong>{{$otherAdminDocAttachment['reason']}}</p>
                                                    </div>
                                                    @endif    
                                                    @if($otherAdminDocAttachment['status'] == 2)
                                                    <div class="text-success">
                                                        <label><strong class="text-secondary">Document: </strong>Accepted <i class="fa fa-check" aria-hidden="true"></i></label>
                                                    </div>
                                                    @endif
                                                     @if($otherAdminDocAttachment['status'] == 1)
                                                    <div class="text-success">
                                                        <label><strong class="text-secondary">Document: </strong>Uploaded <i class="fa fa-check" aria-hidden="true"></i></label>
                                                    </div>
                                                    @endif    
                                                    <div class="row">
                                                        <form method="POST" enctype="multipart/form-data" action="{{route('pendancyAttachments.update',$otherAdminDocAttachment['id'])}}"  >@csrf 
                                                            <label class="btn btn-success btn-default-color" onchange="javascript:this.form.submit()">Upload Document
                                                            <i class="fa fa-upload text-default-color" aria-hidden="true"></i><button class="btn btn-success">Upload</button><input type="file" name="file" class="displayNone" accept="application/pdf">
                                                            </label><input type="hidden" name="studentId" value="{{$student['id']}}">
                                                        </form>
                                                    </div>
                                                    <p class="capitalize"> {{$otherAdminDocAttachment['comment']}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @else
                                <div class="col-md-12">
                                    <div class="main-card mb-3 card">
                                        <div class="card-body">
                                            <h5 class="card-title">{{$otherAdminDocAttachment['title']}}</h5>
                                        </div>
                                        <div class="boxImg" >
                                            @if($otherAdminDocAttachment['name'])
                                            <a href="{{asset($otherAdminDocAttachment['path'].'/'.$otherAdminDocAttachment['name'])}}" download>
                                                <div class="downloadHover"><i class="fa fa-download download" aria-hidden="true"></i><button class="btn btn-success">Download</button></div>
                                            </a>
                                            @else
                                            <div class="downloadHover"><a href="{{route('pendancyAttachments.delete',$otherAdminDocAttachment['id'])}}"><i class="fa fa-trash download" aria-hidden="true"></i></a></div>
                                            @endif
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12 pendancyP">
                                                    @if($otherAdminDocAttachment['status'] == 3)
                                                    <div class="text-danger">
                                                        <label><strong class="text-secondary">Document: </strong>Rejected</label>
                                                        <p><strong class="text-secondary">Reason: </strong>{{$otherAdminDocAttachment['reason']}}</p>
                                                    </div>
                                                    <div class="row">
                                                        <form method="POST" enctype="multipart/form-data" action="{{route('pendancyAttachments.update',$otherAdminDocAttachment['id'])}}"  >@csrf 
                                                            <label class="btn btn-success btn-default-color" onchange="javascript:this.form.submit()">Upload Document
                                                            <i class="fa fa-upload text-default-color" aria-hidden="true"></i><button class="btn btn-success">Upload</button><input type="file" name="file" class="displayNone" accept="application/pdf">
                                                            </label><input type="hidden" name="studentId" value="{{$student['id']}}">
                                                            @if ($errors->has('file'))
                                                            <span class="invalid-feedback" style="display: block!important;" role="alert">
                                                            <strong>{{ $errors->first('file') }}</strong>
                                                            </span>
                                                            @endif
                                                        </form>
                                                    </div>
                                                    @endif    
                                                    @if($otherAdminDocAttachment['status'] == 2)
                                                    <div class="text-success">
                                                        <label><strong class="text-secondary">Document: </strong>Accepted <i class="fa fa-check" aria-hidden="true"></i></label>
                                                    </div>
                                                    @endif    
                                                    @if($otherAdminDocAttachment['status'] == 1)
                                                    <div class="text-success">
                                                        <label><strong class="text-secondary">Document: </strong>Uploaded <i class="fa fa-check" aria-hidden="true"></i></label>
                                                    </div>
                                                    @endif    
                                                    <p> {{$otherAdminDocAttachment['comment']}}</p>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endif
                                @endforeach
                                @foreach($pendancyAttachments as $key=> $pendancyAttachment)
                                <ul class="list-group ">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div class="col-md-12">
                                            <div class="main-card mb-3 card">
                                                <div class="card-body">
                                                    <h5 class="card-title">{{$pendancyAttachment->qualification['qualification_grade']}}</h5>
                                                    <h5 class="card-subtitle">{{$pendancyAttachment->applicationCourse['name']}}</h5>
                                                </div>
                                                <div class="" >
                                                    @if($pendancyAttachment['status'] != 2)
                                                    <div class="downloadHover">
                                                        <form method="POST" enctype="multipart/form-data" action="{{route('pendancyAttachments.update',$pendancyAttachment['id'])}}"  >@csrf 
                                                            <label class="download" onchange="javascript:this.form.submit()">
                                                            <i class="fa fa-upload " aria-hidden="true"></i><input type="file" name="file" class="displayNone" accept="application/pdf">
                                                            </label><input type="hidden" name="studentId" value="{{$student['id']}}">
                                                        </form>
                                                    </div>
                                                    @endif
                                                    <img width="100%" src="{{asset($pendancyAttachment['path'].'/'.$pendancyAttachment['name'])}}" alt="Card image cap" >
                                                </div>
                                                <div class="card-body">
                                                    @if ($errors->has('file'))
                                                    <span class="invalid-feedback" style="display: block!important;" role="alert">
                                                    <strong>{{ $errors->first('file') }}</strong>
                                                    </span>
                                                    @endif
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            @if($pendancyAttachment['status'] == 3)
                                                            <div class="text-danger">
                                                                <label><strong class="text-secondary">Document: </strong>Rejected</label>
                                                                <p><strong class="text-secondary">Reason: </strong>{{$pendancyAttachment['reason']}}</p>
                                                            </div>
                                                            @endif
                                                            @if($pendancyAttachment['status'] == 2)
                                                            <div class="text-success">
                                                                <label><strong class="text-secondary">Document: </strong>Accepted <i class="fa fa-check" aria-hidden="true"></i></label>
                                                            </div>
                                                            @endif
                                                             @if($pendancyAttachment['status'] == 1)
                                                            <div class="text-success">
                                                                <label><strong class="text-secondary">Document: </strong>Uploaded <i class="fa fa-check" aria-hidden="true"></i></label>
                                                            </div>
                                                            @endif  
                                                            <p>{{$pendancyAttachment['comment']}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                                @endforeach
                                @foreach($otherAttachments as $key=> $otherAttachment)
                                <div class="col-md-12 mb-2">
                                    <ul class="list-group ">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                          
                                                <div class=" col-md-4">
                                                    <h5 class="card-title">{{$otherAttachment['title']}}</h5>
                                                </div>
                                                <div class=" col-md-4">
                                                    <div class="row">
                                                        <div class="col-md-12">
                                                            @if($otherAttachment['status'] == 3)
                                                            <div class="text-danger">
                                                                <label><strong class="text-secondary">Document: </strong>Rejected</label>
                                                                <p><strong class="text-secondary">Reason: </strong>{{$otherAttachment['reason']}}</p>
                                                            </div>
                                                            @endif
                                                            @if($otherAttachment['status'] == 2)
                                                            <div class="text-success">
                                                                <label><strong class="text-secondary">Document: </strong>Accepted <i class="fa fa-check" aria-hidden="true"></i></label>
                                                            </div>
                                                            @endif  
                                                            @if($otherAttachment['status'] == 1)
                                                            <div class="text-success">
                                                                <label><strong class="text-secondary">Document: </strong>Uploaded <i class="fa fa-check" aria-hidden="true"></i></label>
                                                            </div>
                                                            @endif  
                                                            <p>{{$otherAttachment['comment']}}</p>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class=" col-md-4" >
                                                    @if($otherAttachment['status'] != 2)
                                                    <div class="downloadHover">
                                                        <form method="POST" enctype="multipart/form-data" action="{{route('pendancyAttachments.update',$otherAttachment['id'])}}"  >@csrf 
                                                            <label class="download btn " onchange="javascript:this.form.submit()">
                                                            <i class="fa fa-upload text-default-color" aria-hidden="true"></i><input type="file" name="file" class="displayNone" accept="application/pdf">
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
                                <p class="text-center">No Pendency.</p>
                            </div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
        @endif 
        <!--  <div class="col-md-12">
            <div class="card-header mb-3">
                <button type="button" class="text-left m-0 p-0 btn btn-link btn-block ">
                    <h5 class="m-0 p-0 text-default-color">Program Detail</h5>
                </button>
            </div>
            <div class="row">
            
            <div class="col-md-12 ">
                <div  class="appliDetail">
                    <div class="row capitalize ">
                        <div class="col-md-4 " >
                            <strong>Math: </strong>
                        </div>
                        <div class="col-md-8 " >
                            @if($studentCourseApplyFors->course['isMath'])
                             {{$studentCourseApplyFors->course['mathScore']}}
                            @else
                            NO
                            @endif
                        </div>
                    </div>
                    <div class="row capitalize ">
                        <div class="col-md-4 " >
                            <strong>IELTS: </strong>
                        </div>
                        <div class="col-md-8 " >
                            @if($studentCourseApplyFors->course['isIlets'])
                             {{$studentCourseApplyFors->course->iletsScores['name']}}
                            @else
                            NO
                            @endif
                        </div>
                    </div>
                  
                    <div class="row capitalize">
                        <div class="col-md-4 " >
                            <strong>Processing Time: </strong>
                        </div>
                        <div class="col-md-8 " >
                            {{$studentCourseApplyFors->course['processing_time']}} Days
                        </div>
                    </div>
                </div>
            
                <div  class="appliDetail">
                    <div class="row capitalize ">
                        <div class="col-md-4 lineHeight-1-5" >
                            <strong>Additional Admission Requirement: </strong>
                        </div>
                        <div class="col-md-8 lineHeight-1-5" >
                            @if($studentCourseApplyFors->course)
                             <p>{{$studentCourseApplyFors->course['note']}}</p>
                            @endif
                        </div>
                    </div>
                    <div class="row capitalize ">
                        <div class="col-md-4 lineHeight-1-5" >
                            <strong>Academic Requirement: </strong>
                        </div>
                        <div class="col-md-8 lineHeight-1-5" >
                            @if($studentCourseApplyFors->course)
                        <p>{{$studentCourseApplyFors->course['academicRequirement']}}</p>
                            @endif
                        </div>
                    </div>
                
                </div>
            </div>
            </div>
            </div> -->
    </div>
   <!--   @if(Auth::guard('student')->check() === false)
    <div class="appChat"><a href="{{route('chat.show',base64_encode($studentCourseApplyFors['id']))}}"><i class="fas fa-comment-alt fa-2x"></i></a></div>
     @endif -->
</div>
@endsection
@section('addjavascript')
<noscript>
    <script src="{{ asset('js/app.js') }}" ></script>
</noscript>
@endsection