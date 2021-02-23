
@extends('admin.layouts.admin') 

@section('content')
<div class="app-main__inner" style="flex: none;">
        <div class="app-page-title row">
            <div class="page-title-wrapper col-md-6">
                <div class="page-title-heading">
                    <div class="page-title-icon">
                        <i class="pe-7s-user icon-gradient bg-mean-fruit">
                        </i>
                    </div>
                    <div>Find Eligibilities
                        <div class="page-title-subheading">This is a search about course requirements.
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

                <div class="searchimgDiv col-md-3">
                    @if($student->studentImage)
                    <img src="{{asset($student->studentImage->path.'/'.$student->studentImage->name)}}">
                    @else
                    <img  src="{{asset('images/site/user-img.png')}}" alt="your image" />
                    @endif
                </div>
                <div class="col-md-6 capitalize">
                    <h6 class="pad-t-b-10">{{$student['firstName']}} {{$student['lastName']}}</h6>
                </div>
                <div class="col-md-3 faDiv capitalize">
                    <!-- <a href="{{route('session.status','remove')}}" class="btn btn-danger"><i class="fa fa-times">&nbsp;back</i></a> -->
                </div>
            </div>
            <div class=" float-right" >
                
                <a class="btn btn-info {{($student->appliedStudentFiles->count() == 0 ) ? 'hide' : ''}}" id="subRequest" href="{{route('studentview.notify',$student['id'])}}">Continue <i class="fa fa-arrow-right"></i></a> 
            </div>
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
    

@endsection
@section('addjavascript')
    <script src="{{ asset('js/app.js') }}" ></script>
@endsection