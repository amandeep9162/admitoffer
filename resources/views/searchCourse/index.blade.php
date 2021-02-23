<?php
$studentUser =Auth::guard('student')->check();
?>

@extends(($studentUser === false) ? 'agent.layouts.app' : 'applicant.layouts.app')
@section('content')
<div class="app-main__inner" style="flex: none;">
        <div class="app-page-title row">
            <div class="page-title-wrapper col-md-6">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-search icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Search For Your Course

                        <div class="page-title-subheading">This is a search about course requirements
                        </div>
                    </div>
                </div>
            </div>

            <?php
            $student = Session::get('student');
            ?>
            @if($student)
            <div class="col-md-6" id="searchStudentBarId">
            <div class="row searchStudentBar float-left" id="searchStudentBarId">

                
                <div class="col-md-7 capitalize">
                    <h6 class="pad-t-b-10">{{$student['firstName']}} {{$student['lastName']}}</h6>
                </div>
                <div class="col-md-5 faDiv capitalize">
                    <a href="{{route('session.status','remove')}}" class="btn btn-danger">Back</a>
                </div>
            </div>

            @if($studentUser === true)
            <div class=" float-right" >
                
                <a class="btn btn-info {{($student->appliedStudentFiles->count() == 0 ) ? 'hide' : ''}}" id="subRequest" style="border: none;background: white;" href="{{route('EditStudent.show',base64_encode($student['id']))}}">Continue <i class="fa fa-arrow-right"></i></a> 
            </div>
             @else
            <div class=" float-right" >
                 @if($student)
                <div>
                <a class="btn btn-info " style="border: none;background: #e77817; position: fixed; top: 140px; right: 12px; z-index: 9999;padding: 20px; font-size: 18px;" href="{{route('student.show',base64_encode($student['id']))}}">Click Here For Skip Program Selection <i class="fa fa-arrow-right"></i>
                    <div>
                        
                    <small>Let AdmitOffer select appropriate programs for you</small>
                    </div>
                </a>
                </div>
                <br>
                @endif
                <a class="btn btn-info {{($student->appliedStudentFiles->count() == 0 ) ? 'hide' : ''}}" id="subRequest" style="border: none;background: white;" href="{{route('student.show',base64_encode($student['id']))}}">Continue <i class="fa fa-arrow-right"></i></a> 
            </div>
            @endif
            @if($studentUser === true)
            <div class="applyContinueBtn float-right" >
                
                <a class="btn btn-info {{($student->appliedStudentFiles->count() == 0 ) ? 'hide' : ''}}" id="subRequests" href="{{route('EditStudent.show',base64_encode($student['id']))}}" style="background: #e77817;">Continue <i class="fa fa-arrow-right"></i></a> 
            </div>
            @else
            
            <div class="applyContinueBtn float-right" >
                
                <a class="btn btn-info {{($student->appliedStudentFiles->count() == 0 ) ? 'hide' : ''}}" id="subRequests" href="{{route('student.show',base64_encode($student['id']))}}" style="background: #e77817;">Continue <i class="fa fa-arrow-right"></i></a> 
            </div>
            @endif
            </div>
            @endif
        </div>    
        
    </div>
    <!-- <div class="col-md-12">
        <div class="row">
            <div class="bg-Img">
                <h1>Find Course</h1>
            </div>
        </div>
    </div> -->


        <searchcources-component></searchcources-component>
    <p  class="text-center">NOTE: <small>This is an approximate yearly fees. The fees may vary. Final Fees should be verified from institute website OR It will be mentioined on the offer letter. </small> </p>
    

@endsection
@section('addjavascript')
        <script src="{{ asset('js/app.js') }}" ></script>
        <noscript>
            <script src="{{ asset('admins/js/ajax.js') }}" ></script>
            <script src="{{ asset('admins/js/admin.js') }}" ></script>
        </noscript>
@endsection