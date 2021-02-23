@extends('admin.layouts.admin') @section('content')
<div class="container-fluid">
    <div class="row ">
        <div class="col-md-12">
            <?php $user=auth( 'admin')->user()->roles()->pluck('name'); ?>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-title float-left">Application Details</div>
                            <div class="card-title float-right"><a href="{{route('studentfiles.show',base64_encode($student['id']))}}" class="btn btn-danger">Back</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="SviewPage">@if($student->studentImage)
                                    <img src="{{asset($student->studentImage->path.'/'.$student->studentImage->name)}}">@else
                                    <img src="{{asset('images/site/user-img.png')}}" alt="your image" />@endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div id="toastTypeGroup">
                                <div class="row capitalize">
                                    <div class="col-md-5 "> <strong>StudentID: </strong>
                                    </div>
                                    <div class="col-md-7 ">
                                        <h5 class="capitalize">{{$student['student_unique_id']}}</h5>
                                    </div>
                                </div>
                                <div class="row capitalize">
                                    <div class="col-md-5 "> <strong>Application Id: </strong>
                                    </div>
                                    <div class="col-md-7 ">
                                        <h5 class="capitalize">{{$studentCourseApplyFors['id']}}</h5>
                                    </div>
                                </div>
                                <div class="row capitalize">
                                    <div class="col-md-5 "> <strong>Tution Fee: </strong>
                                    </div>
                                    <div class="col-md-7 ">
                                        <h6 class="capitalize">{{$student->country['currency_icon_name']}} {{$studentCourseApplyFors->course['tution_fee']}}</h6>
                                    </div>
                                </div>
                                <div class="row capitalize">
                                    <div class="col-md-5 "> <strong>Application Fee: </strong>
                                    </div>
                                    <div class="col-md-7 ">
                                        <h6 class="capitalize">{{$student->country['currency_icon_name']}} {{$studentCourseApplyFors->course['application_fee']}}</h6>
                                    </div>
                                </div>
                                <div class="row capitalize">
                                    <div class="col-md-5 "> <strong>Agent Commission: </strong>
                                    </div>
                                    <div class="col-md-7 ">
                                        <h6 class="capitalize">{{$student->country['currency_icon_name']}} {{$studentCourseApplyFors->course['agent_commission']}}</h6>
                                    </div>
                                </div>
                                <div class="row capitalize">
                                    <div class="col-md-5 "> <strong>Admit Offer Cut: </strong>
                                    </div>
                                    <div class="col-md-7 ">
                                        <h6 class="capitalize">{{$student->country['currency_icon_name']}} {{$studentCourseApplyFors->course['admission_overseasCut']}}</h6>
                                    </div>
                                </div>
                                <div class="row capitalize">
                                    <div class="col-md-5 "> <strong>Total Comission: </strong>
                                    </div>
                                    <div class="col-md-7 ">
                                        <h6 class="capitalize">{{$student->country['currency_icon_name']}} {{$studentCourseApplyFors->course['total_commission']}}</h6>
                                    </div>
                                </div>
                                <div class="row capitalize">
                                    <div class="col-md-5 "> <strong>Name: </strong>
                                    </div>
                                    <div class="col-md-7 ">{{$student['title']}} {{$student['firstName']}}{{$student['middleName']}} {{$student['lastName']}}</div>
                                </div>
                                <div class="row capitalize">
                                    <div class="col-md-5 "> <strong>Skype Id: </strong>
                                    </div>
                                    <div class="col-md-7 ">
                                        @if($student['skypeId']) {{$student['skypeId']}} @else
                                        <p class="text-danger">Ping To Agent For Student Skype ID.</p>
                                        @endif
                                    </div>
                                </div>
                                @if($studentCourseApplyFors->course) @if($studentCourseApplyFors->course->college)
                                <div class="row capitalize">
                                    <div class="col-md-5 "> <strong>University: </strong>
                                    </div>
                                    <div class="col-md-7 ">
                                        <h6 class="capitalize">{{$studentCourseApplyFors->course->college['name']}}</h6>
                                    </div>
                                </div>
                                @endif @endif
                                <div class="row capitalize">
                                    <div class="col-md-5 "> <strong>Course Name: </strong>
                                    </div>
                                    <div class="col-md-7 ">
                                        <h6 class="capitalize">{{$studentCourseApplyFors->course['name']}}</h6>
                                    </div>
                                </div>
                                <div class="row capitalize">
                                    <div class="col-md-5 "> <strong>Intake: </strong>
                                    </div>
                                    <div class="col-md-7 ">
                                        <span class="capitalize">
                                            @if($studentCourseApplyFors->course)
                                                @if($studentCourseApplyFors->course->intakes)
                                                   {{$studentCourseApplyFors->course->intakes['name']}}
                                                @endif
                                            @endif
                                        </span>
                                    </div>
                                </div>
                                @if($user[0] != 'process' && $user[0] != 'account manager')
                                <div>
                                    <a href="javascript:;" class="btn btn-primary" id="chngProg">Change Program</a>
                                </div>
                                <div class="chngProg hide">
                                    
                                <form method="POST" id="getChangeCourses" action="{{route('application.UpdateCourses')}}">
                                    @csrf
                                    
                                    <div>
                                        <label>University Name</label>
                                        <select class="form-control" name="institute" id="getCollege_id" required>
                                            <option value="">Select Institute</option>
                                            @foreach($colleges as $college)
                                            <option value="{{$college['id']}}">{{$college['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <input type="hidden" name="application_id" value="{{$studentCourseApplyFors['id']}}">
                                    <div>
                                        <label>Intake</label>
                                        <select class="form-control" name="intake_id" id="getIntake_id" required>
                                            <option value="">Select Intake</option>
                                            @foreach($mergeIntakes as $mergeIntake)
                                            <option value="{{$mergeIntake['id']}}">{{$mergeIntake['name']}}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div>
                                        <label>Select Course</label>
                                        <select class="form-control" id="appendCourses" name="course_id" required>
                                            <option>Select Course</option>
                                        </select>
                                    </div>
                                    <div>
                                        
                                        <button class="btn btn-primary">Update</button>
                                    </div>
                                    
                                </form>
                                </div>
                                @endif
                                <div class="row capitalize">
                                    <div class="col-md-5 "> <strong>Applied For Country: </strong>
                                    </div>
                                    <div class="col-md-7 "> <span class="capitalize">{{$student->country['name']}}</span>
                                    </div>
                                </div>
                                <div class="row capitalize">
                                    <div class="col-md-5 "> <strong>Application Level: </strong>
                                    </div>
                                    <div class="col-md-7 "> <span class="capitalize">{{$student->qualificationLevel['name']}}</span>
                                    </div>
                                </div>
                                <div class="row capitalize mb-2">
                                    <div class="col-md-5 "> <strong>Agent: </strong>
                                    </div>
                                    <div class="col-md-7 "> <span class="capitalize">{{$student->agent['name']}}</span>
                                    </div>
                                </div>
                                  <div class="row capitalize mb-2">
                                    <div class="col-md-5 "> <strong>Agent Company Name: </strong>
                                    </div>
                                    <div class="col-md-7 "> <span class="capitalize">{{$student->agent['company_name']}}</span>
                                    </div>
                                </div>
                                <!-- <div class="row capitalize">
                                    <div class="col-md-4 " >
                                        <strong>Application Status: </strong>
                                    </div>
                                    <div class="col-md-8 " >
                                        @if($studentCourseApplyFors['file_status'] == '0')
                                        <span class="capitalize">Fresher</span>
                                        @endif
                                        </div>
                                    </div> -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <form method="POST" action="{{route('applications.Status')}}">
                                            @csrf
                                            <input type="hidden" name="applicationId" value="{{$studentCourseApplyFors['id']}}">
                                            <div id="toastTypeGroup">
                                                <div class="form-group row">
                                                    <label for="input-id" class="col-sm-5"><strong>Application Status </strong>
                                                    </label>
                                                    <select class="form-control col-sm-7" name="status" onchange="javascript:this.form.submit()">@foreach($applicationStatus as $status) @if($user[0] == 'process' || $user[0] == 'account manager' ) @if($status['id'] == 3) @break @endif @endif
                                                        @if($student['applingForCountry'] == $status['country'])
                                                    <option value="{{$status['id']}}" {{($studentCourseApplyFors[ 'file_status']==$status[ 'id'])? 'selected': ''}}>{{$status['name']}}</option>
                                                    @endif
                                                @endforeach</select>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                @if($studentCourseApplyFors['file_status'] == 6)
                                <div class="row capitalize interviewSch">
                                    <div class="col-md-12 text-center">
                                        @if(!$student['skypeId'])
                                        <p class="text-danger">Ping To Agent For Student Skype ID.</p>
                                        @endif
                                    </div>
                                    <div class="col-md-5 "> <strong> Credibility Interview Schedule: </strong>
                                    </div>
                                    <div class="col-md-7 ">
                                        <form method="POST" action="{{route('interview.save')}}">@csrf @if($studentCourseApplyFors['interviewSchedule'])
                                            @if($studentCourseApplyFors['interviewScheduleDate'])
                                            <input type="date" name="interviewScheduleDate" class="form-control " value="{{$studentCourseApplyFors['interviewScheduleDate']}}" placeholder="Credibility Interview Set Time " required>
                                            @else
                                            <input type="date" name="interviewScheduleDate" class="form-control " placeholder="Credibility Interview Set Time " required>
                                            @endif
                                            <input type="time" name="interviewScheduleTime" class="form-control " value="{{$studentCourseApplyFors['interviewScheduleTime']}}" placeholder="Credibility Interview Set Time " required>
                                            <input type="text" name="interviewSchedule" class="form-control " value="{{$studentCourseApplyFors['interviewSchedule']}}" placeholder="Credibility Interview Set Time " required>
                                            @else
                                            <input type="date" name="interviewScheduleDate" class="form-control " placeholder="Credibility Interview Set Time " required>
                                            <input type="time" name="interviewScheduleTime" class="form-control " placeholder="Credibility Interview Set Time " required>
                                            <input type="text" name="interviewSchedule" class="form-control " placeholder="Credibility Interview Set Time " required>@endif
                                            <input type="hidden" name="application_id" value="{{$studentCourseApplyFors['id']}}">
                                            <br>
                                            <button class="btn btn-success">Save</button>
                                        </form>
                                    </div>
                                </div>
                                @endif @if($studentCourseApplyFors['file_status'] == 12 || $studentCourseApplyFors['file_status'] == 13)
                                <form method="POST" action="{{route('application.rejection')}}">
                                    @csrf
                                    <div class="row capitalize rejectDanger">
                                        <div class="col-md-5 "> <strong> Application  Reason: </strong>
                                        </div>
                                        <div class="col-md-7 ">
                                            <input type="hidden" name="application_id" value="{{$studentCourseApplyFors['id']}}">
                                            <textarea class="form-control" name="reason" rows="8">{{$studentCourseApplyFors['reason']}}</textarea>
                                            <button class="btn btn-info ">Save</button>
                                        </div>
                                    </div>
                                    <br>
                                </form>
                                @endif @if($studentCourseApplyFors['file_status'] > 6)
                                <div class="row capitalize interviewSch">
                                    <div class="col-md-5 "> <strong> Credibility Interview Schedule: </strong>
                                    </div>
                                    <div class="col-md-7 ">
                                        <p>{{$studentCourseApplyFors['interviewScheduleDate']}}</p>
                                        <p>{{$studentCourseApplyFors['interviewScheduleTime']}}</p>
                                        <p>{{$studentCourseApplyFors['interviewSchedule']}}</p>
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
                                            <h5 class="text-center">Application Current Status </h5>
                                            @foreach($applicationStatus as $status) @if($user[0] == 'process' || $user[0] == 'account manager') @if($status['id'] == 3) @break @endif @endif
                                             @if($student['applingForCountry'] == $status['country'])
                                            <li class="completed">
                                                <a href="javascript:;">
                                                    <div class="stat {{((string)$studentCourseApplyFors['file_status'] == (string)$status['id'])? 'bg-Color-blue':''}}"><small>{{$status['name']}}</small>
                                                    </div>
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
                                            <?php $even=0 ; $odd=0 ; ?>
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
                                                <?php $odd=( int)$even+1; ?>
                                                <div class="containertime text-center right">
                                                    <div class="contentRight">
                                                        <h6><small>{{$applicationStatus->status['name']}}</small></h6>
                                                        <p>{{$applicationStatus['status_date']}}</p>
                                                    </div>
                                                </div>
                                                @endif @if($key == $odd)
                                                <?php $even=$odd+1; ?>
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
                     @if($student['applingForCountry'] == '230')
                    @if($user[0] != 'process' || $studentCourseApplyFors['file_status'] != 12 || $studentCourseApplyFors['file_status'] != 13)
                     @if($visaDocument)
                    <div class="row">
                        <div class="col-md-12 card-body">
                            <div class="main-card mb-3 ">
                                <div class="card-header mb-2">
                                    <button type="button" class="text-left m-0 p-0 btn btn-link btn-block ">
                                        <h5 class="m-0 p-0 ">VISA Document</h5>
                                    </button>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-4 card pdf">
                                        @if($visaDocument)
                                        <br>
                                        <div class="card senSecImg boxImg">
                                            <a href="{{asset($visaDocument['path'].'/'.$visaDocument['name'])}}" download>
                                                <div class="downloadHover">
                                                    <i class="fa fa-download download" aria-hidden="true"></i>
                                                    <!-- <button class="btn btn-success">Download</button> -->
                                                </div>
                                                <div class="text-center">
                                                    <img width="100%" src="{{asset('images/site/pdfIcon.png')}}" alt="Card image cap">
                                                </div>
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12 pendancyP">
                                                    @if($visaDocument['status'] == 1)
                                                    <div> <a class="btn btn-success" href="{{route('visa.accepted',$visaDocument['id'])}}">Accept</a>
                                                        <a class="btn btn-danger pendancyReject" href="javascript:void;">Reject</a>
                                                    </div>
                                                    <div style="margin: 10px 0px 10px 0px;" class="displayNone pendancyC">
                                                        <form method="POST" action="{{route('visa.rejected',$visaDocument['id'])}}">@csrf
                                                            <textarea name="reason" class="form-control"></textarea>
                                                            <button style="margin-top:10px" class="btn btn-success btn btn-info float-right">Save</button>
                                                        </form>
                                                        <br>
                                                    </div>
                                                    @endif @if($visaDocument['status'] == 3)
                                                    <div class="text-danger">
                                                        <label><strong class="text-secondary">Document: </strong>Rejected</label>
                                                        <p><strong class="text-secondary">Reason: </strong>{{$visaDocument['reason']}}</p>
                                                    </div>
                                                    @endif @if($visaDocument['status'] == 2)
                                                    <div class="text-success">
                                                        <label><strong class="text-secondary">Document: </strong>Accepted <i class="fa fa-check " aria-hidden="true"></i>
                                                        </label>
                                                    </div>
                                                    @endif
                                                    <p>{{$visaDocument['comment']}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif @if($studentCourseApplyFors['file_status'] >= '9')
                    <div class="row ">
                        <div class="card-body">
                            <div id="headingOne" class="card-header mb-3">
                                <button type="button" class="text-left m-0 p-0 btn btn-link btn-block ">
                                    <h5 class="m-0 p-0 ">Upload Clear CAS Document</h5>
                                </button>
                            </div>
                            <div class="col-md-12 ">
                                <form method="POST" action="{{route('applications.clearCasDocument')}}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="applicationStatusID" value="{{$studentCourseApplyFors['file_status']}}">
                                    <input type="hidden" name="studentId" value="{{$student['id']}}">
                                    <input type="hidden" name="applicationId" value="{{$studentCourseApplyFors['id']}}">
                                    <div id="toastTypeGroup">
                                        <div class="form-group row">
                                            <div class="col-sm-4 pdf">
                                                @if($applicationCASDocument)

                                                <div class="card">
                                                    <div class="card-header mb-3">
                                                        <h6 class="m-0 p-0 ">Cleared CAS Document</small></h6>
                                                    </div>
                                                   <a href="{{asset($applicationCASDocument['path'].'/'.$applicationCASDocument['name'])}}" download>
                                                        <span class="text-success" >Uploaded</span> <div class="downloadHover">
                                                            <i class="fa fa-download download" aria-hidden="true"></i>
                                                            <!-- <button class="btn btn-success">Download</button> -->
                                                        </div>
                                                        
                                                    </a>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="">
                                            <label class="btn btn-warning btn-default-color" onchange="javascript:this.form.submit()">Upload CAS letter
                                            <input type="file" name="clearCasDocument" class="mb-2 imgInp hide form-control imgInpDoc">
                                            </label>
                                            <br>@if ($errors->has('clearCasDocument')) <span class="invalid-feedback" style="display: block!important;" role="alert">
                                            <strong>{{ $errors->first('clearCasDocument') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif @if($casDocument)
                    <div class="row">
                        <div class="card-body mb-2 ">
                            <div class="card-header mb-2">
                                <button type="button" class="text-left m-0 p-0 btn btn-link btn-block ">
                                    <h5 class="m-0 p-0 ">CAS Document</h5>
                                </button>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-4 card pdf">
                                    @if($casDocument)
                                    <br>
                                    <div class="senSecImg boxImg">
                                        <a href="{{asset($casDocument['path'].'/'.$casDocument['name'])}}" download>
                                            <div class="downloadHover">
                                                <i class="fa fa-download download" aria-hidden="true"></i>
                                                <!-- <button class="btn btn-success">Download</button> -->
                                            </div>
                                            <img width="100%" src="{{asset('images/site/pdfIcon.png')}}" alt="Card image cap">
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12 pendancyP">
                                                @if($casDocument['status'] == 1)
                                                <div> <a class="btn btn-success" href="{{route('casDoc.accepted',$casDocument['id'])}}">Accept</a>
                                                    <a class="btn btn-danger pendancyReject" href="javascript:void;">Reject</a>
                                                </div>
                                                <div style="margin: 10px 0px 10px 0px;" class="displayNone pendancyC">
                                                    <form method="POST" action="{{route('casDoc.rejected',$casDocument['id'])}}">@csrf
                                                        <textarea name="reason" class="form-control"></textarea>
                                                        <button style="margin-top:10px" class="btn btn-success btn btn-info float-right">Save</button>
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
                                                @endif @if($casDocument['status'] == 2)
                                                <div class="text-success">
                                                    <label><strong class="text-secondary">Document: </strong>Accepted <i class="fa fa-check " aria-hidden="true"></i>
                                                    </label>
                                                </div>
                                                @endif
                                                <p>{{$casDocument['comment']}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($applicationFee)
                    <div class="row">
                        <div class="card-body">
                            <div class="card-header mb-2">
                                <button type="button" class="text-left m-0 p-0 btn btn-link btn-block ">
                                    <h5 class="m-0 p-0 ">Tution Fee Receipt</h5>
                                </button>
                            </div>
                            <div class="col-md-12">
                                <div class=" mb-3 ">
                                    <div class="row pdf">
                                        @if($applicationFee)
                                        <div class="col-sm-4 m-0 p-0">
                                            <h6 class="m-0 p-0 ">Tution Amount: 
                                                <small>@if($applicationFee->applicationFee)
                                                {{$student->country['currency_icon_name']}} {{$applicationFee->applicationFee['tution_fee']}}
                                                @endif
                                                </small>
                                            </h6>
                                        </div>
                                        <div class="col-sm-4 pendancyP">
                                            @if($applicationFee['status'] == 1)
                                            <div> <a class="btn btn-success" href="{{route('applicationFee.accepted',$applicationFee['id'])}}">Accept</a>
                                                <a class="btn btn-danger pendancyReject" href="javascript:void;">Reject</a>
                                            </div>
                                            <div style="margin: 10px 0px 10px 0px;" class="displayNone pendancyC">
                                                <form method="POST" action="{{route('applicationFee.rejected',$applicationFee['id'])}}">@csrf
                                                    <textarea name="reason" class="form-control"></textarea>
                                                    <button style="margin-top:10px" class="btn btn-success btn btn-info float-right">Save</button>
                                                </form>
                                                <br>
                                            </div>
                                            @endif @if($applicationFee['status'] == 3)
                                            <div class="text-danger ">
                                                <label><strong class="text-secondary">Document: </strong>Rejected</label>
                                                <p class="capitalize"><strong class="text-secondary">Reason: </strong><span class="capitalize">{{$applicationFee['reason']}}</span>
                                                </p>
                                            </div>
                                            @endif @if($applicationFee['status'] == 2)
                                            <div class="text-success">
                                                <label><strong class="text-secondary">Document: </strong> Accepted <i class="fa fa-check " aria-hidden="true"></i>
                                                </label>
                                            </div>
                                            @endif
                                            <p class="capitalize">{{$applicationFee['comment']}}</p>
                                        </div>
                                        <div class="col-sm-4 senSecImg boxImg">
                                            <a href="{{asset($applicationFee['path'].'/'.$applicationFee['name'])}}" download>
                                                <div class="downloadHover">
                                                    <i class="fa fa-download download" aria-hidden="true"></i>
                                                    <!-- <button class="btn btn-success">Download</button> -->
                                                </div>
                                                <div class="text-center mb-3 mt-2">
                                                    <!-- <img width="100%" src="{{asset('images/site/pdfIcon.png')}}" alt="Card image cap"> -->
                                                </div>
                                            </a>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif

                    @if($studentCourseApplyFors['file_status'] >= '3' || $studentCourseApplyFors['file_status'] >= '4')
                    <div class="row ">
                        <div class="card-body">
                            <div id="headingOne" class="card-header mb-3">
                                <button type="button" class="text-left m-0 p-0 btn btn-link btn-block ">
                                    <h5 class="m-0 p-0 ">Offer Letter</h5>
                                </button>
                            </div>
                            <div class="col-md-12">
                                <form method="POST" action="{{route('applications.offerlatter')}}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="applicationStatusID" value="{{$studentCourseApplyFors['file_status']}}">
                                    <input type="hidden" name="studentId" value="{{$student['id']}}">
                                    <input type="hidden" name="applicationId" value="{{$studentCourseApplyFors['id']}}">
                                    <div id="toastTypeGroup">
                                        <div class="form-group row">
                                            <div class="col-sm-12 pdf">
                                                <div class="row">
                                                    @if($applicationDocument)
                                                    <div class="col-sm-4 mb-3">
                                                        <h6 class="m-0 p-0 ">Student Id: <small>{{$applicationDocument['college_student_id']}}</small></h6>
                                                    </div>
                                                    @endif
                                                    <div class="col-md-4">
                                                        <label class="btn btn-warning btn-default-color">Upload Offer letter
                                                        <input type="file" name="offerLetter" class="mb-2 imgInp hide form-control imgInpDoc" accept="application/pdf">
                                                        </label>
                                                        <input type="text" name="collegeStudentId" class="mb-2 form-control" placeholder="Institute Student Id" required>
                                                        <button class="btn btn-success btn btn-info">Send</button>@if ($errors->has('offerLetter')) <span class="invalid-feedback" style="display: block!important;" role="alert">
                                                        <strong>{{ $errors->first('offerLetter') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                    @if($applicationDocument)
                                                    <div class="col-md-4 senSecImg boxImg text-center">
                                                        <a href="{{asset($applicationDocument['path'].'/'.$applicationDocument['name'])}}" download>
                                                            <div class="downloadHover">
                                                                <i class="fa fa-download download" aria-hidden="true"></i>
                                                                <!-- <button class="btn btn-success">Download</button> -->
                                                            </div>
                                                        </a>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif 
                    <div id="accordion" class="accordion-wrapper mb-3">
                        <div class="col-md-12">
                            <div class="card row">
                                <div style="background: #3ac47d;" class="card-header">
                                    <button type="button" data-toggle="collapse" data-target="#collapseOneQ" aria-expanded="false" aria-controls="collapseOne" class="text-left m-0 p-0 btn btn-link btn-block collapsed">
                                        <h5 class="m-0 p-0 text-center" style="color: white">Application Requirement @if ($errors->has('file'))
                                            <span class="invalid-feedback" style="display: block!important;" role="alert">
                                            <strong>{{ $errors->first('file') }}</strong>
                                            </span>
                                            @endif
                                        </h5>
                                    </button>
                                    <div data-toggle="collapse" data-target="#collapseOneQ" aria-expanded="false" aria-controls="collapseOne" class="collapsed"> <i class="fa fa-plus"></i>
                                    </div>
                                </div>
                                <div data-parent="#accordion" id="collapseOneQ" aria-labelledby="headingOne" class="collapse " style="">
                                    <div class="senSecImg">
                                        <div class="col-sm-12">
                                            <div class="main-card card row">
                                                <form method="POST" action="{{route('pendancyAttachment.store')}}" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="studentId" value="{{$studentCourseApplyFors->student['id']}}">
                                                    <div class="card-body">
                                                        <input type="hidden" id="educationDate" name="application_id" value="{{$studentCourseApplyFors['id']}}">
                                                        <div class="tab-content ">
                                                            <div class="tab-pane show active" id="tab-eg1-1" role="tabpanel">
                                                                <div class="form-group">
                                                                    <label>Title</label>
                                                                    <input class="form-control gradeClass" type="text" placeholder="other required document" name="title">
                                                                    <br>
                                                                    <input class="form-control gradeClass" type="text" placeholder="reason" name="other">
                                                                    <br>
                                                                    <label class="btn btn-success btn-default-color">Upload Document (optional)
                                                                    <input type="file" name="file" class="form-control displayNone">
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-block card-footer">
                                                        <button class="btn-wide btn btn-success btn btn-info">Send</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($pendancyAttachments->count()>0 )
                    <div class="row pdf ">
                        <div class=" col-md-12">
                            <div class="row">
                                <div class="card-body">
                                    <div id="headingOne" class="card-header">
                                        <button type="button" class="text-left m-0 p-0 btn btn-link btn-block ">
                                            <h5 class="m-0 p-0 ">Application Pendancy</h5>
                                        </button>
                                    </div>
                                    <div>
                                        <div class="senSecImg">
                                            <br>@if($pendancyAttachments->count()>0 )
                                            <div class="row">
                                                @foreach($pendancyAttachments as $key=> $pendancyAttachment)
                                                <div class="col-md-12 mb-3">
                                                    <ul class="list-group ">
                                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                                            <div class="col-md-4">
                                                                <h6 class="card-title">{{$pendancyAttachment['title']}}</h6>
                                                                <!-- <h5 class="card-subtitle">{{$pendancyAttachment->applicationCourse['name']}}</h5> -->
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="row">
                                                                    <div class="col-md-12 pendancyP">
                                                                        @if($pendancyAttachment['status'] == 1)
                                                                        <div> <a class="btn btn-success" href="{{route('pendancyAttachments.accepted',$pendancyAttachment['id'])}}">Accept</a>
                                                                            <a class="btn btn-danger pendancyReject" href="javascript:void;">Reject</a>
                                                                        </div>
                                                                        <div style="margin: 10px 0px 10px 0px;" class="displayNone pendancyC">
                                                                            <form method="POST" action="{{route('pendancyAttachments.rejected',$pendancyAttachment['id'])}}">@csrf
                                                                                <textarea name="reason" class="form-control"></textarea>
                                                                                <button style="margin-top:10px" class="btn btn-success btn btn-info float-right">Save</button>
                                                                            </form>
                                                                            <br>
                                                                        </div>
                                                                        @endif @if($pendancyAttachment['status'] == 3)
                                                                        <div class="text-danger">
                                                                            <label><strong class="text-secondary">Document: </strong>Rejected</label>
                                                                            <p><strong class="text-secondary">Reason: </strong>{{$pendancyAttachment['reason']}}</p>
                                                                        </div>
                                                                        @endif @if($pendancyAttachment['status'] == 2)
                                                                        <div class="text-success">
                                                                            <label><strong class="text-secondary">Document: </strong>Accepted <i class="fa fa-check " aria-hidden="true"></i>
                                                                            </label>
                                                                        </div>
                                                                        @endif
                                                                        <p>{{$pendancyAttachment['comment']}}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                @if($pendancyAttachment['name'])
                                                                <a href="{{asset($pendancyAttachment['path'].'/'.$pendancyAttachment['name'])}}" download>
                                                                    <div class="downloadHover"><i class="fa fa-download download" aria-hidden="true"></i>
                                                                    </div>
                                                                </a>
                                                                @else
                                                                <div class="downloadHover"><a href="{{route('pendancyAttachments.delete',$pendancyAttachment['id'])}}"><i class="fa fa-trash download" aria-hidden="true"></i></a>
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
                                                <p class="text-center">No Pendency </p>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif 
                    @endif
                    @endif
                    @if($student['applingForCountry'] == '38')
                    @include('admin/applications/CanadaStatusStudentFile')
                    @endif
                    @if($sopDoc)
                    <div class="row listMainGroup">
                        <div class="card-body">
                            <div id="headingOne" class="card-header mb-3">
                                <button type="button" class="text-left m-0 p-0 btn btn-link btn-block ">
                                    <h5 class="m-0 p-0 ">SOP Document</h5>
                                </button>
                            </div>
                            <div class="col-md-12 mb-2">
                                <ul class="list-group ">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div class=" col-md-12 pdf">
                                            <div class="card-body">
                                                <div>
                                                    <div class="senSecImg">
                                                        @if($sopDoc['status'] > 0)
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <h5 class="m-0 p-0 ">SOP Document Pendency</h5>
                                                            </div>
                                                            <div class="col-md-4 pendancyP">
                                                                @if($sopDoc['status'] == 1)
                                                                <div> <a class="btn btn-success" href="{{route('sop.accepted',$sopDoc['id'])}}">Accept</a>
                                                                    <a class="btn btn-danger pendancyReject" href="javascript:void;">Reject</a>
                                                                </div>
                                                                <div style="margin: 10px 0px 10px 0px;" class="displayNone pendancyC">
                                                                    <form method="POST" action="{{route('sop.rejected',$sopDoc['id'])}}">@csrf
                                                                        <textarea name="reason" class="form-control"></textarea>
                                                                        <button style="margin-top:10px" class="btn btn-success btn btn-info float-right">Save</button>
                                                                    </form>
                                                                    <br>
                                                                </div>
                                                                @endif @if($sopDoc['status'] == 3)
                                                                <div class="text-danger">
                                                                    <label><strong class="text-secondary">Document: </strong>Rejected</label>
                                                                    <p><strong class="text-secondary">Reason: </strong>{{$sopDoc['reason']}}</p>
                                                                </div>
                                                                @endif @if($sopDoc['status'] == 2)
                                                                <div class="text-success">
                                                                    <label><strong class="text-secondary">Document: </strong>Accepted <i class="fa fa-check " aria-hidden="true"></i>
                                                                    </label>
                                                                </div>
                                                                @endif
                                                                <p>{{$sopDoc['comment']}}</p>
                                                            </div>
                                                            <div class="col-md-2 pdf">
                                                                @if($sopDoc)
                                                                @if($sopDoc['status'] != 3)
                                                                <a href="{{asset($sopDoc['sop_path'].'/'.$sopDoc['sop_name'])}}" download>
                                                                    <div class="downloadHover"><i class="fa fa-download download " aria-hidden="true"></i>
                                                                    </div>
                                                                </a>
                                                                @endif
                                                                @endif
                                                            </div>
                                                        </div>
                                                        @else
                                                        <h5 class="text-danger text-center">Not Uploaded.</h5>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-header mb-3">
                                <button type="button" class="text-left m-0 p-0 btn btn-link btn-block ">
                                    <h5 class="m-0 p-0 ">Course Detail</h5>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12 ">
                                    <div id="toastTypeGroup" class="appliDetail card">
                                        <div class="row capitalize ">
                                            <div class="col-md-4 "> <strong>Tution Fee: </strong>
                                            </div>
                                            <div class="col-md-8 ">{{$student->country['currency_icon_name']}} {{$studentCourseApplyFors->course['tution_fee']}}</div>
                                        </div>
                                        <div class="row capitalize">
                                            <div class="col-md-4 "> <strong>Application Fee: </strong>
                                            </div>
                                            <div class="col-md-8 ">{{$student->country['currency_icon_name']}} {{$studentCourseApplyFors->course['application_fee']}}</div>
                                        </div>
                                        <div class="row capitalize">
                                            <div class="col-md-4 "> <strong>Total Commission: </strong>
                                            </div>
                                            <div class="col-md-8 ">{{$student->country['currency_icon_name']}} {{$studentCourseApplyFors->course['total_commission']}}</div>
                                        </div>
                                        <div class="row capitalize">
                                            <div class="col-md-4 "> <strong>Agent Commission: </strong>
                                            </div>
                                            <div class="col-md-8 ">{{$student->country['currency_icon_name']}} {{$studentCourseApplyFors->course['agent_commission']}}</div>
                                        </div>
                                        <div class="row capitalize">
                                            <div class="col-md-4 "> <strong>Admit Offer Cut: </strong>
                                            </div>
                                            <div class="col-md-8 ">{{$student->country['currency_icon_name']}} {{$studentCourseApplyFors->course['admission_overseasCut']}}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div id="toastTypeGroup" class="appliDetail card">
                                        <div class="row capitalize">
                                            <div class="col-md-4 "> <strong>Institute: </strong>
                                            </div>
                                            <div class="col-md-8 capitalize ">{{$studentCourseApplyFors->course->college['name']}}</div>
                                        </div>
                                        <div class="row capitalize">
                                            <div class="col-md-4 "> <strong>Processing Time: </strong>
                                            </div>
                                            <div class="col-md-8 ">{{$studentCourseApplyFors->course['processing_time']}} Days</div>
                                        </div>
                                        <div class="row capitalize">
                                            <div class="col-md-4 "> <strong>Description: </strong>
                                            </div>
                                            <div class="col-md-8 ">
                                                <p>{{$studentCourseApplyFors->course['description']}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>@if($user[0] != 'process')
                    <div class="appChat"><a href="{{route('chat.show',base64_encode($studentCourseApplyFors['id']))}}"><i class="fas fa-comment-alt fa-3x"></i></a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection@extends('admin.layouts.admin') @section('content')
<div class="container-fluid">
    <div class="row ">
        <div class="col-md-12">
            <?php $user=auth( 'admin')->user()->roles()->pluck('name'); ?>
            <div class="card">
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-title float-left">Application Details</div>
                            <div class="card-title float-right"><a href="{{route('studentfiles.show',base64_encode($student['id']))}}" class="btn btn-danger">Back</a>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-3">
                            <div class="form-group">
                                <div class="SviewPage">@if($student->studentImage)
                                    <img src="{{asset($student->studentImage->path.'/'.$student->studentImage->name)}}">@else
                                    <img src="{{asset('images/site/user-img.png')}}" alt="your image" />@endif
                                </div>
                            </div>
                        </div>
                        <div class="col-md-5">
                            <div id="toastTypeGroup">
                                <div class="row capitalize">
                                    <div class="col-md-5 "> <strong>StudentID: </strong>
                                    </div>
                                    <div class="col-md-7 ">
                                        <h5 class="capitalize">{{$student['student_unique_id']}}</h5>
                                    </div>
                                </div>
                                <div class="row capitalize">
                                    <div class="col-md-5 "> <strong>Application Id: </strong>
                                    </div>
                                    <div class="col-md-7 ">
                                        <h5 class="capitalize">{{$studentCourseApplyFors['id']}}</h5>
                                    </div>
                                </div>
                                <div class="row capitalize">
                                    <div class="col-md-5 "> <strong>Tution Fee: </strong>
                                    </div>
                                    <div class="col-md-7 ">
                                        <h6 class="capitalize">{{$student->country['currency_icon_name']}} {{$studentCourseApplyFors->course['tution_fee']}}</h6>
                                    </div>
                                </div>
                                <div class="row capitalize">
                                    <div class="col-md-5 "> <strong>Application Fee: </strong>
                                    </div>
                                    <div class="col-md-7 ">
                                        <h6 class="capitalize">{{$student->country['currency_icon_name']}} {{$studentCourseApplyFors->course['application_fee']}}</h6>
                                    </div>
                                </div>
                                <div class="row capitalize">
                                    <div class="col-md-5 "> <strong>Agent Commission: </strong>
                                    </div>
                                    <div class="col-md-7 ">
                                        <h6 class="capitalize">{{$student->country['currency_icon_name']}} {{$studentCourseApplyFors->course['agent_commission']}}</h6>
                                    </div>
                                </div>
                                <div class="row capitalize">
                                    <div class="col-md-5 "> <strong>Admit Offer Cut: </strong>
                                    </div>
                                    <div class="col-md-7 ">
                                        <h6 class="capitalize">{{$student->country['currency_icon_name']}} {{$studentCourseApplyFors->course['admission_overseasCut']}}</h6>
                                    </div>
                                </div>
                                <div class="row capitalize">
                                    <div class="col-md-5 "> <strong>Total Comission: </strong>
                                    </div>
                                    <div class="col-md-7 ">
                                        <h6 class="capitalize">{{$student->country['currency_icon_name']}} {{$studentCourseApplyFors->course['total_commission']}}</h6>
                                    </div>
                                </div>
                                <div class="row capitalize">
                                    <div class="col-md-5 "> <strong>Name: </strong>
                                    </div>
                                    <div class="col-md-7 ">{{$student['title']}} {{$student['firstName']}}{{$student['middleName']}} {{$student['lastName']}}</div>
                                </div>
                                <div class="row capitalize">
                                    <div class="col-md-5 "> <strong>Skype Id: </strong>
                                    </div>
                                    <div class="col-md-7 ">
                                        @if($student['skypeId']) {{$student['skypeId']}} @else
                                        <p class="text-danger">Ping To Agent For Student Skype ID.</p>
                                        @endif
                                    </div>
                                </div>
                                @if($studentCourseApplyFors->course) @if($studentCourseApplyFors->course->college)
                                <div class="row capitalize">
                                    <div class="col-md-5 "> <strong>University: </strong>
                                    </div>
                                    <div class="col-md-7 ">
                                        <h6 class="capitalize">{{$studentCourseApplyFors->course->college['name']}}</h6>
                                    </div>
                                </div>
                                @endif @endif
                                <div class="row capitalize">
                                    <div class="col-md-5 "> <strong>Course Name: </strong>
                                    </div>
                                    <div class="col-md-7 ">
                                        <h6 class="capitalize">{{$studentCourseApplyFors->course['name']}}</h6>
                                    </div>
                                </div>
                                
                                <div class="row capitalize">
                                    <div class="col-md-5 "> <strong>Applied For Country: </strong>
                                    </div>
                                    <div class="col-md-7 "> <span class="capitalize">{{$student->country['name']}}</span>
                                    </div>
                                </div>
                                <div class="row capitalize">
                                    <div class="col-md-5 "> <strong>Application Level: </strong>
                                    </div>
                                    <div class="col-md-7 "> <span class="capitalize">{{$student->qualificationLevel['name']}}</span>
                                    </div>
                                </div>
                                <div class="row capitalize mb-2">
                                    <div class="col-md-5 "> <strong>Agent: </strong>
                                    </div>
                                    <div class="col-md-7 "> <span class="capitalize">{{$student->agent['name']}}</span>
                                    </div>
                                </div>
                                <!-- <div class="row capitalize">
                                    <div class="col-md-4 " >
                                        <strong>Application Status: </strong>
                                    </div>
                                    <div class="col-md-8 " >
                                        @if($studentCourseApplyFors['file_status'] == '0')
                                        <span class="capitalize">Fresher</span>
                                        @endif
                                        </div>
                                    </div> -->
                                <div class="row">
                                    <div class="col-md-12">
                                        <form method="POST" action="{{route('applications.Status')}}">
                                            @csrf
                                            <input type="hidden" name="applicationId" value="{{$studentCourseApplyFors['id']}}">
                                            <div id="toastTypeGroup">
                                                <div class="form-group row">
                                                    <label for="input-id" class="col-sm-5"><strong>Application Status </strong>
                                                    </label>
                                                    <select class="form-control col-sm-7" name="status" onchange="javascript:this.form.submit()">@foreach($applicationStatus as $status) @if($user[0] == 'process') @if($status['id'] == 3) @break @endif @endif
                                                    <option value="{{$status['id']}}" {{($studentCourseApplyFors[ 'file_status']==$status[ 'id'])? 'selected': ''}}>{{$status['name']}}</option>@endforeach</select>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                                @if($studentCourseApplyFors['file_status'] == 6)
                                <div class="row capitalize interviewSch">
                                    <div class="col-md-12 text-center">
                                        @if(!$student['skypeId'])
                                        <p class="text-danger">Ping To Agent For Student Skype ID.</p>
                                        @endif
                                    </div>
                                    <div class="col-md-5 "> <strong> Credibility Interview Schedule: </strong>
                                    </div>
                                    <div class="col-md-7 ">
                                        <form method="POST" action="{{route('interview.save')}}">@csrf @if($studentCourseApplyFors['interviewSchedule'])
                                            @if($studentCourseApplyFors['interviewScheduleDate'])
                                            <input type="date" name="interviewScheduleDate" class="form-control " value="{{$studentCourseApplyFors['interviewScheduleDate']}}" placeholder="Credibility Interview Set Time " required>
                                            @else
                                            <input type="date" name="interviewScheduleDate" class="form-control " placeholder="Credibility Interview Set Time " required>
                                            @endif
                                            <input type="time" name="interviewScheduleTime" class="form-control " value="{{$studentCourseApplyFors['interviewScheduleTime']}}" placeholder="Credibility Interview Set Time " required>
                                            <input type="text" name="interviewSchedule" class="form-control " value="{{$studentCourseApplyFors['interviewSchedule']}}" placeholder="Credibility Interview Set Time " required>@else
                                            <input type="date" name="interviewScheduleTime" class="form-control " placeholder="Credibility Interview Set Time " required>
                                            <input type="time" name="interviewScheduleTime" class="form-control " placeholder="Credibility Interview Set Time " required>
                                            <input type="text" name="interviewSchedule" class="form-control " placeholder="Credibility Interview Set Time " required>@endif
                                            <input type="hidden" name="application_id" value="{{$studentCourseApplyFors['id']}}">
                                            <br>
                                            <button class="btn btn-success">Save</button>
                                        </form>
                                    </div>
                                </div>
                                @endif @if($studentCourseApplyFors['file_status'] == 12)
                                <form method="POST" action="{{route('application.rejection')}}">
                                    @csrf
                                    <div class="row capitalize rejectDanger">
                                        <div class="col-md-5 "> <strong> Application Rejection Reason: </strong>
                                        </div>
                                        <div class="col-md-7 ">
                                            <input type="hidden" name="application_id" value="{{$studentCourseApplyFors['id']}}">
                                            <textarea class="form-control" name="reason">{{$studentCourseApplyFors['reason']}}</textarea>
                                            <button class="btn btn-info ">Save</button>
                                        </div>
                                    </div>
                                    <br>
                                </form>
                                @endif @if($studentCourseApplyFors['file_status'] > 6)
                                <div class="row capitalize interviewSch">
                                    <div class="col-md-5 "> <strong> Credibility Interview Schedule: </strong>
                                    </div>
                                    <div class="col-md-7 ">
                                        <p>{{$studentCourseApplyFors['interviewScheduleDate']}}</p>
                                        <p>{{$studentCourseApplyFors['interviewScheduleTime']}}</p>
                                        <p>{{$studentCourseApplyFors['interviewSchedule']}}</p>
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
                                            <h5 class="text-center">Application Current Status </h5>
                                            @foreach($applicationStatus as $status) @if($user[0] == 'process') @if($status['id'] == 3) @break @endif @endif
                                            <li class="completed">
                                                <a href="javascript:;">
                                                    <div class="stat {{((string)$studentCourseApplyFors['file_status'] == (string)$status['id'])? 'bg-Color-blue':''}}"><small>{{$status['name']}}</small>
                                                    </div>
                                                </a>
                                            </li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                            </div>
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
                                            <?php $even=0 ; $odd=0 ; ?>
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
                                                <?php $odd=( int)$even+1; ?>
                                                <div class="containertime text-center right">
                                                    <div class="contentRight">
                                                        <h6><small>{{$applicationStatus->status['name']}}</small></h6>
                                                        <p>{{$applicationStatus['status_date']}}</p>
                                                    </div>
                                                </div>
                                                @endif @if($key == $odd)
                                                <?php $even=$odd+1; ?>
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
                    @if($user[0] != 'process') @if($visaDocument)
                    <div class="row">
                        <div class="col-md-12 card-body">
                            <div class="main-card mb-3 ">
                                <div class="card-header mb-2">
                                    <button type="button" class="text-left m-0 p-0 btn btn-link btn-block ">
                                        <h5 class="m-0 p-0 ">VISA Document</h5>
                                    </button>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-4 card pdf">
                                        @if($visaDocument)
                                        <br>
                                        <div class="card senSecImg boxImg">
                                            <a href="{{asset($visaDocument['path'].'/'.$visaDocument['name'])}}" download>
                                                <div class="downloadHover">
                                                    <i class="fa fa-download download" aria-hidden="true"></i>
                                                    <!-- <button class="btn btn-success">Download</button> -->
                                                </div>
                                                <div class="text-center">
                                                    <img width="100%" src="{{asset('images/site/pdfIcon.png')}}" alt="Card image cap">
                                                </div>
                                            </a>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12 pendancyP">
                                                    @if($visaDocument['status'] == 1)
                                                    <div> <a class="btn btn-success" href="{{route('visa.accepted',$visaDocument['id'])}}">Accept</a>
                                                        <a class="btn btn-danger pendancyReject" href="javascript:void;">Reject</a>
                                                    </div>
                                                    <div style="margin: 10px 0px 10px 0px;" class="displayNone pendancyC">
                                                        <form method="POST" action="{{route('visa.rejected',$visaDocument['id'])}}">@csrf
                                                            <textarea name="reason" class="form-control"></textarea>
                                                            <button style="margin-top:10px" class="btn btn-success btn btn-info float-right">Save</button>
                                                        </form>
                                                        <br>
                                                    </div>
                                                    @endif @if($visaDocument['status'] == 3)
                                                    <div class="text-danger">
                                                        <label><strong class="text-secondary">Document: </strong>Rejected</label>
                                                        <p><strong class="text-secondary">Reason: </strong>{{$visaDocument['reason']}}</p>
                                                    </div>
                                                    @endif @if($visaDocument['status'] == 2)
                                                    <div class="text-success">
                                                        <label><strong class="text-secondary">Document: </strong>Accepted <i class="fa fa-check " aria-hidden="true"></i>
                                                        </label>
                                                    </div>
                                                    @endif
                                                    <p>{{$visaDocument['comment']}}</p>
                                                </div>
                                            </div>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif @if($studentCourseApplyFors['file_status'] >= '9')
                    <div class="row ">
                        <div class="card-body">
                            <div id="headingOne" class="card-header mb-3">
                                <button type="button" class="text-left m-0 p-0 btn btn-link btn-block ">
                                    <h5 class="m-0 p-0 ">Upload Clear CAS Document</h5>
                                </button>
                            </div>
                            <div class="col-md-12 ">
                                <form method="POST" action="{{route('applications.clearCasDocument')}}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="applicationStatusID" value="{{$studentCourseApplyFors['file_status']}}">
                                    <input type="hidden" name="studentId" value="{{$student['id']}}">
                                    <input type="hidden" name="applicationId" value="{{$studentCourseApplyFors['id']}}">
                                    <div id="toastTypeGroup">
                                        <div class="form-group row">
                                            <div class="col-sm-4 pdf">
                                                @if($applicationCASDocument)
                                                <div class="card">
                                                    <div class="card-header mb-3">
                                                        <h6 class="m-0 p-0 ">Cleared CAS Document</small></h6>
                                                    </div>
                                                    <div class="col-md-12 senSecImg boxImg text-center">
                                                        <img src="{{asset('images/site/pdfIcon.png')}}">
                                                    </div>
                                                </div>
                                                @endif
                                            </div>
                                        </div>
                                        <div class="">
                                            <label class="btn btn-warning btn-default-color" onchange="javascript:this.form.submit()">Upload CAS letter
                                            <input type="file" name="clearCasDocument" class="mb-2 imgInp hide form-control imgInpDoc">
                                            </label>
                                            <br>@if ($errors->has('clearCasDocument')) <span class="invalid-feedback" style="display: block!important;" role="alert">
                                            <strong>{{ $errors->first('clearCasDocument') }}</strong>
                                            </span>
                                            @endif
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif
                    
                     @if($casDocument)
                    <div class="row">
                        <div class="card-body mb-2 ">
                            <div class="card-header mb-2">
                                <button type="button" class="text-left m-0 p-0 btn btn-link btn-block ">
                                    <h5 class="m-0 p-0 ">CAS Document</h5>
                                </button>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-4 card pdf">
                                    @if($casDocument)
                                    <br>
                                    <div class="senSecImg boxImg">
                                        <a href="{{asset($casDocument['path'].'/'.$casDocument['name'])}}" download>
                                            <div class="downloadHover">
                                                <i class="fa fa-download download" aria-hidden="true"></i>
                                                <!-- <button class="btn btn-success">Download</button> -->
                                            </div>
                                            <img width="100%" src="{{asset('images/site/pdfIcon.png')}}" alt="Card image cap">
                                        </a>
                                    </div>
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col-md-12 pendancyP">
                                                @if($casDocument['status'] == 1)
                                                <div> <a class="btn btn-success" href="{{route('casDoc.accepted',$casDocument['id'])}}">Accept</a>
                                                    <a class="btn btn-danger pendancyReject" href="javascript:void;">Reject</a>
                                                </div>
                                                <div style="margin: 10px 0px 10px 0px;" class="displayNone pendancyC">
                                                    <form method="POST" action="{{route('casDoc.rejected',$casDocument['id'])}}">@csrf
                                                        <textarea name="reason" class="form-control"></textarea>
                                                        <button style="margin-top:10px" class="btn btn-success btn btn-info float-right">Save</button>
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
                                                @endif @if($casDocument['status'] == 2)
                                                <div class="text-success">
                                                    <label><strong class="text-secondary">Document: </strong>Accepted <i class="fa fa-check " aria-hidden="true"></i>
                                                    </label>
                                                </div>
                                                @endif
                                                <p>{{$casDocument['comment']}}</p>
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif 
                    @if($applicationFee)
                    <div class="row">
                        <div class="card-body">
                            <div class="card-header mb-2">
                                <button type="button" class="text-left m-0 p-0 btn btn-link btn-block ">
                                    <h5 class="m-0 p-0 ">Tution Fee Receipt</h5>
                                </button>
                            </div>
                            <div class="col-md-12">
                                <div class=" mb-3 ">
                                    <div class="row pdf">
                                        @if($applicationFee)
                                        <div class="col-sm-4 m-0 p-0">
                                            <h6 class="m-0 p-0 ">Tution Amount: 
                                                <small>@if($applicationFee->applicationFee)
                                                {{$student->country['currency_icon_name']}} {{$applicationFee->applicationFee['tution_fee']}}
                                                @endif
                                                </small>
                                            </h6>
                                        </div>
                                        <div class="col-sm-4 pendancyP">
                                            @if($applicationFee['status'] == 1)
                                            <div> <a class="btn btn-success" href="{{route('applicationFee.accepted',$applicationFee['id'])}}">Accept</a>
                                                <a class="btn btn-danger pendancyReject" href="javascript:void;">Reject</a>
                                            </div>
                                            <div style="margin: 10px 0px 10px 0px;" class="displayNone pendancyC">
                                                <form method="POST" action="{{route('applicationFee.rejected',$applicationFee['id'])}}">@csrf
                                                    <textarea name="reason" class="form-control"></textarea>
                                                    <button style="margin-top:10px" class="btn btn-success btn btn-info float-right">Save</button>
                                                </form>
                                                <br>
                                            </div>
                                            @endif @if($applicationFee['status'] == 3)
                                            <div class="text-danger ">
                                                <label><strong class="text-secondary">Document: </strong>Rejected</label>
                                                <p class="capitalize"><strong class="text-secondary">Reason: </strong><span class="capitalize">{{$applicationFee['reason']}}</span>
                                                </p>
                                            </div>
                                            @endif @if($applicationFee['status'] == 2)
                                            <div class="text-success">
                                                <label><strong class="text-secondary">Document: </strong> Accepted <i class="fa fa-check " aria-hidden="true"></i>
                                                </label>
                                            </div>
                                            @endif
                                            <p class="capitalize">{{$applicationFee['comment']}}</p>
                                        </div>
                                        <div class="col-sm-4 senSecImg boxImg">
                                            <a href="{{asset($applicationFee['path'].'/'.$applicationFee['name'])}}" download>
                                                <div class="downloadHover">
                                                    <i class="fa fa-download download" aria-hidden="true"></i>
                                                    <!-- <button class="btn btn-success">Download</button> -->
                                                </div>
                                                <div class="text-center mb-3 mt-2">
                                                    <!-- <img width="100%" src="{{asset('images/site/pdfIcon.png')}}" alt="Card image cap"> -->
                                                </div>
                                            </a>
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif
                    @if($studentCourseApplyFors['file_status'] >= '3' || $studentCourseApplyFors['file_status'] >= '4')
                    <div class="row ">
                        <div class="card-body">
                            <div id="headingOne" class="card-header mb-3">
                                <button type="button" class="text-left m-0 p-0 btn btn-link btn-block ">
                                    <h5 class="m-0 p-0 ">Offer Letter</h5>
                                </button>
                            </div>
                            <div class="col-md-12">
                                <form method="POST" action="{{route('applications.offerlatter')}}" enctype="multipart/form-data">
                                    @csrf
                                    <input type="hidden" name="applicationStatusID" value="{{$studentCourseApplyFors['file_status']}}">
                                    <input type="hidden" name="studentId" value="{{$student['id']}}">
                                    <input type="hidden" name="applicationId" value="{{$studentCourseApplyFors['id']}}">
                                    <div id="toastTypeGroup">
                                        <div class="form-group row">
                                            <div class="col-sm-12 pdf">
                                                <div class="row">
                                                    @if($applicationDocument)
                                                    <div class="col-sm-4 mb-3">
                                                        <h6 class="m-0 p-0 ">Student Id In Institute: <small>{{$applicationDocument['college_student_id']}}</small></h6>
                                                    </div>
                                                    @endif
                                                    <div class="col-md-4">
                                                        <label class="btn btn-warning btn-default-color">Upload Offer letter
                                                        <input type="file" name="offerLetter" class="mb-2 imgInp hide form-control imgInpDoc" accept="application/pdf">
                                                        </label>
                                                        <input type="text" name="collegeStudentId" class="mb-2 form-control" placeholder="Institute Student Id" required>
                                                        <button class="btn btn-success btn btn-info">Send</button>@if ($errors->has('offerLetter')) <span class="invalid-feedback" style="display: block!important;" role="alert">
                                                        <strong>{{ $errors->first('offerLetter') }}</strong>
                                                        </span>
                                                        @endif
                                                    </div>
                                                    @if($applicationDocument)
                                                    <div class="col-md-4 senSecImg boxImg text-center">
                                                        <a href="{{asset($applicationDocument['path'].'/'.$applicationDocument['name'])}}" download>
                                                            <div class="downloadHover">
                                                                <i class="fa fa-download download" aria-hidden="true"></i>
                                                                <!-- <button class="btn btn-success">Download</button> -->
                                                            </div>
                                                        </a>
                                                    </div>
                                                    @endif
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    @endif 
                    <div id="accordion" class="accordion-wrapper mb-3">
                        <div class="col-md-12">
                            <div class="card row">
                                <div style="background: #3ac47d;" class="card-header">
                                    <button type="button" data-toggle="collapse" data-target="#collapseOneQ" aria-expanded="false" aria-controls="collapseOne" class="text-left m-0 p-0 btn btn-link btn-block collapsed">
                                        <h5 class="m-0 p-0 text-center" style="color: white">Application Requirement @if ($errors->has('file'))
                                            <span class="invalid-feedback" style="display: block!important;" role="alert">
                                            <strong>{{ $errors->first('file') }}</strong>
                                            </span>
                                            @endif
                                        </h5>
                                    </button>
                                    <div data-toggle="collapse" data-target="#collapseOneQ" aria-expanded="false" aria-controls="collapseOne" class="collapsed"> <i class="fa fa-plus"></i>
                                    </div>
                                </div>
                                <div data-parent="#accordion" id="collapseOneQ" aria-labelledby="headingOne" class="collapse " style="">
                                    <div class="senSecImg">
                                        <div class="col-sm-12">
                                            <div class="main-card card row">
                                                <form method="POST" action="{{route('pendancyAttachment.store')}}" enctype="multipart/form-data">
                                                    @csrf
                                                    <input type="hidden" name="studentId" value="{{$studentCourseApplyFors->student['id']}}">
                                                    <div class="card-body">
                                                        <input type="hidden" id="educationDate" name="application_id" value="{{$studentCourseApplyFors['id']}}">
                                                        <div class="tab-content ">
                                                            <div class="tab-pane show active" id="tab-eg1-1" role="tabpanel">
                                                                <div class="form-group">
                                                                    <label>Title</label>
                                                                    <input class="form-control gradeClass" type="text" placeholder="other required document" name="title">
                                                                    <br>
                                                                    <input class="form-control gradeClass" type="text" placeholder="reason" name="other">
                                                                    <br>
                                                                    <label class="btn btn-success btn-default-color">Upload Document (optional)
                                                                    <input type="file" name="file" class="form-control displayNone">
                                                                    </label>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="d-block card-footer">
                                                        <button class="btn-wide btn btn-success btn btn-info">Send</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @if($pendancyAttachments->count()>0 )
                    <div class="row pdf ">
                        <div class=" col-md-12">
                            <div class="row">
                                <div class="card-body">
                                    <div id="headingOne" class="card-header">
                                        <button type="button" class="text-left m-0 p-0 btn btn-link btn-block ">
                                            <h5 class="m-0 p-0 ">Application Pendancy</h5>
                                        </button>
                                    </div>
                                    <div>
                                        <div class="senSecImg">
                                            <br>@if($pendancyAttachments->count()>0 )
                                            <div class="row">
                                                @foreach($pendancyAttachments as $key=> $pendancyAttachment)
                                                <div class="col-md-12 mb-3">
                                                    <ul class="list-group ">
                                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                                            <div class="col-md-4">
                                                                <h6 class="card-title">{{$pendancyAttachment['title']}}</h6>
                                                                <!-- <h5 class="card-subtitle">{{$pendancyAttachment->applicationCourse['name']}}</h5> -->
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="row">
                                                                    <div class="col-md-12 pendancyP">
                                                                        @if($pendancyAttachment['status'] == 1)
                                                                        <div> <a class="btn btn-success" href="{{route('pendancyAttachments.accepted',$pendancyAttachment['id'])}}">Accept</a>
                                                                            <a class="btn btn-danger pendancyReject" href="javascript:void;">Reject</a>
                                                                        </div>
                                                                        <div style="margin: 10px 0px 10px 0px;" class="displayNone pendancyC">
                                                                            <form method="POST" action="{{route('pendancyAttachments.rejected',$pendancyAttachment['id'])}}">@csrf
                                                                                <textarea name="reason" class="form-control"></textarea>
                                                                                <button style="margin-top:10px" class="btn btn-success btn btn-info float-right">Save</button>
                                                                            </form>
                                                                            <br>
                                                                        </div>
                                                                        @endif @if($pendancyAttachment['status'] == 3)
                                                                        <div class="text-danger">
                                                                            <label><strong class="text-secondary">Document: </strong>Rejected</label>
                                                                            <p><strong class="text-secondary">Reason: </strong>{{$pendancyAttachment['reason']}}</p>
                                                                        </div>
                                                                        @endif @if($pendancyAttachment['status'] == 2)
                                                                        <div class="text-success">
                                                                            <label><strong class="text-secondary">Document: </strong>Accepted <i class="fa fa-check " aria-hidden="true"></i>
                                                                            </label>
                                                                        </div>
                                                                        @endif
                                                                        <p>{{$pendancyAttachment['comment']}}</p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                @if($pendancyAttachment['name'])
                                                                <a href="{{asset($pendancyAttachment['path'].'/'.$pendancyAttachment['name'])}}" download>
                                                                    <div class="downloadHover"><i class="fa fa-download download" aria-hidden="true"></i>
                                                                    </div>
                                                                </a>
                                                                @else
                                                                <div class="downloadHover"><a href="{{route('pendancyAttachments.delete',$pendancyAttachment['id'])}}"><i class="fa fa-trash download" aria-hidden="true"></i></a>
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
                                                <p class="text-center">No Pendency </p>
                                            </div>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endif 
                    @endif
                    @if($sopDoc)
                    <div class="row listMainGroup">
                        <div class="card-body">
                            <div id="headingOne" class="card-header mb-3">
                                <button type="button" class="text-left m-0 p-0 btn btn-link btn-block ">
                                    <h5 class="m-0 p-0 ">SOP Document</h5>
                                </button>
                            </div>
                            <div class="col-md-12 mb-2">
                                <ul class="list-group ">
                                    <li class="list-group-item d-flex justify-content-between align-items-center">
                                        <div class=" col-md-12 pdf">
                                            <div class="card-body">
                                                <div>
                                                    <div class="senSecImg">
                                                        @if($sopDoc['status'] > 0)
                                                        <div class="row">
                                                            <div class="col-md-6">
                                                                <h5 class="m-0 p-0 ">SOP Document Pendency</h5>
                                                            </div>
                                                            <div class="col-md-4 pendancyP">
                                                                @if($sopDoc['status'] == 1)
                                                                <div> <a class="btn btn-success" href="{{route('sop.accepted',$sopDoc['id'])}}">Accept</a>
                                                                    <a class="btn btn-danger pendancyReject" href="javascript:void;">Reject</a>
                                                                </div>
                                                                <div style="margin: 10px 0px 10px 0px;" class="displayNone pendancyC">
                                                                    <form method="POST" action="{{route('sop.rejected',$sopDoc['id'])}}">@csrf
                                                                        <textarea name="reason" class="form-control"></textarea>
                                                                        <button style="margin-top:10px" class="btn btn-success btn btn-info float-right">Save</button>
                                                                    </form>
                                                                    <br>
                                                                </div>
                                                                @endif @if($sopDoc['status'] == 3)
                                                                <div class="text-danger">
                                                                    <label><strong class="text-secondary">Document: </strong>Rejected</label>
                                                                    <p><strong class="text-secondary">Reason: </strong>{{$sopDoc['reason']}}</p>
                                                                </div>
                                                                @endif @if($sopDoc['status'] == 2)
                                                                <div class="text-success">
                                                                    <label><strong class="text-secondary">Document: </strong>Accepted <i class="fa fa-check " aria-hidden="true"></i>
                                                                    </label>
                                                                </div>
                                                                @endif
                                                                <p>{{$sopDoc['comment']}}</p>
                                                            </div>
                                                            <div class="col-md-2 pdf">
                                                                @if($sopDoc)
                                                                @if($sopDoc['status'] != 3)
                                                                <a href="{{asset($sopDoc['sop_path'].'/'.$sopDoc['sop_name'])}}" download>
                                                                    <div class="downloadHover"><i class="fa fa-download download " aria-hidden="true"></i>
                                                                    </div>
                                                                </a>
                                                                @endif
                                                                @endif
                                                            </div>
                                                        </div>
                                                        @else
                                                        <h5 class="text-danger text-center">Not Uploaded.</h5>
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    @endif
                    <div class="row">
                        <div class="col-md-12">
                            <div class="card-header mb-3">
                                <button type="button" class="text-left m-0 p-0 btn btn-link btn-block ">
                                    <h5 class="m-0 p-0 ">Course Detail</h5>
                                </button>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12 ">
                                    <div id="toastTypeGroup" class="appliDetail card">
                                        <div class="row capitalize ">
                                            <div class="col-md-4 "> <strong>Tution Fee: </strong>
                                            </div>
                                            <div class="col-md-8 ">{{$student->country['currency_icon_name']}} {{$studentCourseApplyFors->course['tution_fee']}}</div>
                                        </div>
                                        <div class="row capitalize">
                                            <div class="col-md-4 "> <strong>Application Fee: </strong>
                                            </div>
                                            <div class="col-md-8 ">{{$student->country['currency_icon_name']}} {{$studentCourseApplyFors->course['application_fee']}}</div>
                                        </div>
                                        <div class="row capitalize">
                                            <div class="col-md-4 "> <strong>Total Commission: </strong>
                                            </div>
                                            <div class="col-md-8 ">{{$student->country['currency_icon_name']}} {{$studentCourseApplyFors->course['total_commission']}}</div>
                                        </div>
                                        <div class="row capitalize">
                                            <div class="col-md-4 "> <strong>Agent Commission: </strong>
                                            </div>
                                            <div class="col-md-8 ">{{$student->country['currency_icon_name']}} {{$studentCourseApplyFors->course['agent_commission']}}</div>
                                        </div>
                                        <div class="row capitalize">
                                            <div class="col-md-4 "> <strong>Admit Offer Cut: </strong>
                                            </div>
                                            <div class="col-md-8 ">{{$student->country['currency_icon_name']}} {{$studentCourseApplyFors->course['admission_overseasCut']}}</div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div id="toastTypeGroup" class="appliDetail card">
                                        <div class="row capitalize">
                                            <div class="col-md-4 "> <strong>Institute: </strong>
                                            </div>
                                            <div class="col-md-8 capitalize ">{{$studentCourseApplyFors->course->college['name']}}</div>
                                        </div>
                                        <div class="row capitalize">
                                            <div class="col-md-4 "> <strong>Processing Time: </strong>
                                            </div>
                                            <div class="col-md-8 ">{{$studentCourseApplyFors->course['processing_time']}} Days</div>
                                        </div>
                                        <div class="row capitalize">
                                            <div class="col-md-4 "> <strong>Description: </strong>
                                            </div>
                                            <div class="col-md-8 ">
                                                <p>{{$studentCourseApplyFors->course['description']}}</p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <br>@if($user[0] != 'process')
                    <div class="appChat"><a href="{{route('chat.show',base64_encode($studentCourseApplyFors['id']))}}"><i class="fas fa-comment-alt fa-3x"></i></a>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('addjavascript')
<script type="text/javascript">

$(document).on('change','#getChangeCourses #getIntake_id, #getCollege_id',function(){ 


   var getIntake_id =  $('#getIntake_id').val();
   var getCollege_id =  $('#getCollege_id').val();
   if(getIntake_id){
       if(getCollege_id){

        $.ajax({
                url : "getChangeCourses/"+getIntake_id+'/'+getCollege_id,
                type:'get',
                dataType: 'json',
                success: function(response) {
                    console.log(response);
                    $("#appendCourses").html('');
                    $("#appendCourses").append('<option value="">Select Course </option>');
                    $.each(response,function(key, value)
                    {
                        $("#appendCourses").append('<option value=' + value.id + '>' + value.name + '</option>');
                    });
                 }
            });
       }
   }
});
</script>
<script type="text/javascript">
    $(document).on('click','#chngProg',function(){

        $('.chngProg').toggle('slow');
    });
</script>
@endsection