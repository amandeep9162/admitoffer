
        @if($studentCourseApplyFors['file_status'] != "22" )
        @if($studentCourseApplyFors['file_status'] != "23")
        @if($studentCourseApplyFors['file_status'] >= '16')
        @if($applicationDocuments->count() > 0 )
        @if($studentCourseApplyFors['file_status'] >= '19')
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
                                                @if($studentCourseApplyFors['file_status'] >= '18')
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
        <div class=" col-md-12 pdf">
            <div class="card">
                <div class="card-body">
                    <div id="headingOne" class="card-header">
                        <button type="button" class="text-left m-0 p-0 btn btn-link btn-block ">
                            <h5 class="m-0 p-0 text-default-color">LOA Offer Letter</h5>
                        </button>
                    </div>
                    <div >
                        <div class="senSecImg">
                            <br>
                            @if($applicationLOAOfferDocument)
                            <div class="row listMainGroup">
                                
                                <div class="col-md-12 mb-2">
                                    <ul class="list-group ">
                                        <li class="list-group-item d-flex justify-content-between align-items-center">
                                            <div class="col-md-4">
                                                LOA Offer Letter (<small>Download</small>)
                                            </div>
                                            <div class="col-md-4">
                                                <p>{{$applicationLOAOfferDocument['comment']}}</p>
                                            </div>
                                            <div class="col-md-4">
                                                <div class="" >
                                                    <a href="{{asset($applicationLOAOfferDocument['path'].'/'.$applicationLOAOfferDocument['name'])}}" download>
                                                        <div class="downloadHover"><i class="fa fa-download download text-default-color" aria-hidden="true"></i></div>
                                                    </a>
                                                   
                                                    <form method="POST" action="{{route('pdf.view')}}"  target="_blank">
                                                        @csrf
                                                     <input type="hidden" name="name"   value="{{$applicationLOAOfferDocument['name']}}">
                                                     <input type="hidden" name="path"   value="{{$applicationLOAOfferDocument['path']}}">
                                                     <button class="btn btn-info" target="_blank">View Pdf</button>
                                                    </form>
                                                </div>
                                            </div>
                                        </li>
                                    </ul>
                                </div>
                                
                            </div>
                            @else
                            <div class="text-center">
                                <p class="text-center">No LOA offer letter available.</p>
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
       