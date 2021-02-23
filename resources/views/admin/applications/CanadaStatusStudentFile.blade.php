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
    @endif 
     @if($studentCourseApplyFors['file_status'] >= '18')
    <div class="row ">
        <div class="card-body">
            <div id="headingOne" class="card-header mb-3">
                <button type="button" class="text-left m-0 p-0 btn btn-link btn-block ">
                    <h5 class="m-0 p-0 ">Final Offer/LOA Received</h5>
                </button>
            </div>
            <div class="col-md-12">
                <form method="POST" action="{{route('applications.loaOfferLetter')}}" enctype="multipart/form-data">
                    @csrf
                    <input type="hidden" name="applicationStatusID" value="{{$studentCourseApplyFors['file_status']}}">
                    <input type="hidden" name="studentId" value="{{$student['id']}}">
                    <input type="hidden" name="applicationId" value="{{$studentCourseApplyFors['id']}}">
                    <div id="toastTypeGroup">
                        <div class="form-group row">
                            <div class="col-sm-12 pdf">
                                <div class="row">
                                    @if($applicationLOAOfferDocument)
                                    <div class="col-sm-4 mb-3">
                                        <h6 class="m-0 p-0 ">Student Id: <small>{{$applicationLOAOfferDocument['college_student_id']}}</small></h6>
                                    </div>
                                    @endif
                                    <div class="col-md-4">
                                        <label class="btn btn-warning btn-default-color">Upload LOA Offer letter
                                        <input type="file" name="loaOfferLetter" class="mb-2 imgInp hide form-control imgInpDoc" accept="application/pdf">
                                        </label>
                                        <input type="text" name="collegeStudentId" class="mb-2 form-control" placeholder="Institute Student Id" required>
                                        <button class="btn btn-success btn btn-info">Send</button>@if ($errors->has('loaOfferLetter')) <span class="invalid-feedback" style="display: block!important;" role="alert">
                                        <strong>{{ $errors->first('loaOfferLetter') }}</strong>
                                        </span>
                                        @endif
                                    </div>
                                    @if($applicationLOAOfferDocument)
                                    <div class="col-md-4 senSecImg boxImg text-center">
                                        <a href="{{asset($applicationLOAOfferDocument['path'].'/'.$applicationLOAOfferDocument['name'])}}" download>
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

    @if($studentCourseApplyFors['file_status'] >= '16' || $studentCourseApplyFors['file_status'] >= '17')
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