
<?php
$admin =Auth::guard('admin')->check();
?>

@extends(($admin === false) ? 'agent.layouts.app' : 'admin.layouts.admin')
@section('content')
<div class="container">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header "> Chat History for &nbsp;<span class="badge badge-warning">{{$application->course['course_unique_id']}}</span></div>
                <div class="card-body">
                    @include('multiauth::message')
                    
                    
                    <div class="form-group row capitalize">
                        <label for="input-id" class="col-sm-3 chatSidebar">
                            
                            <div class="chatSidebarName">
                                <div>
                                    <h5>Program Details</h5>
                                    
                                </div>
                                <div>
                                    <strong>Program: </strong> {{$application->course['name']}}
                                </div>
                                <div>
                                    <strong>Program Id: </strong> {{$application->course['course_unique_id']}}
                                </div>
                                <div>
                                    <strong>Institute: </strong> {{$application->course->college['name']}}
                                </div>
                            </div>
                            <div class="chatSidebarName">
                                <div>
                                    <h5>Student Details</h5>
                                </div>
                                <div>
                                    <strong>Name: </strong>{{$application->student['firstName']}}{{$application->student['middleName']}} &nbsp;{{$application->student['lastName']}}
                                </div>
                                <div>
                                    <strong>DOB: </strong> {{date('d-M-Y',strtotime($application->student['dateOfBirth']))}}
                                </div>
                                <div>
                                    <strong>Skype: </strong> {{$application->student['skypeId']}}
                                </div>
                            </div>  
                            <div class="chatSidebarName">
                                <div>
                                    <h5>Application Details</h5>
                                    
                                </div>
                                <div>
                                    <strong>Applying For: </strong> {{$application->country['name']}}
                                </div>
                                <div>
                                    <strong>Status: </strong> {{$application->applicationStatus['name']}}
                                </div>
                                <div>
                                    <strong>Applied at: </strong> {{date('d-M-Y',strtotime($application['applied_at']))}}
                                </div>
                            </div>
                        </label>
                        <div class="col-sm-9">
                            <div style="overflow: scroll;height:500px" class="scrollBottom">
                                <div class="appendAllMessage" style="margin-bottom:75px;">
                                    @foreach($messages as $message)
                                    @if($message['type'] == 'admin')
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="max-width-420 float-right mr-10">
                                                <p class="lineBarRight "><strong>AdmitOffer: </strong> &nbsp;  {{$message['message']}} <br> <small>{{date('d-M-Y h:s A',strtotime($message['created_at']))}}</small></p>
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="max-width-420">
                                                <p class="lineBar"><strong>Recruiter: </strong>&nbsp; {{$message['message']}} </br> <small>{{date('d-M-Y h:s A',strtotime($message['created_at']))}}</small></p> 
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                    <span class="newMessage"></span>  
                                </div>  
                                <div class="row ">
                                    <div class=" col-md-12 chatInput">
                                    <form method="POST" class="chatRequestForm">
                                        @csrf
                                        <div class=" row">
                                            <div class="col-md-12 ">
                                                
                                                <input type="hidden" name="application_id" class="application_id" value="{{$application['id']}}">
                                                <input type="text" style="display: inline; width:80%;" placeholder="Enter Message" name="message" class="mb-2 form-control messageInput" required>
                                                <button type="submit" style="width: 16%; height: 66%;" class=" btn btn-success btn-default-color">Send</button>
                                            </div>  
                                            <!-- <div class="col-md-2 ">
                                            </div>   -->
                                        </div>  
                                    </form>  
                                    </div>  
                                </div>  
                            </div>
                            
                        </div>
                    </div>
                        <!-- <button type="submit" class="btn btn-info btn-sm float-right">Send</button> -->
                        <!-- <a href="{{route('studentQualificationGrades.index')}}" class="btn btn-sm btn-danger float-right">Back</a> -->
                    
                </div>
            </div>
        </div>
    </div>
</div>

@endsection