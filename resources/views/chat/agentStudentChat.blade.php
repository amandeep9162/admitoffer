@extends('agent.layouts.app') 
@section('content')
<div class="container">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header "> Chat History &nbsp;<span class="badge badge-warning"></span></div>
                <div class="card-body">
                    @include('multiauth::message')
                    
                    
                    <div class="form-group row capitalize">
                        <label for="input-id" class="col-sm-3 chatSidebar">
                            
                            <div class="chatSidebarName">
                                <div>
                                    <h5>Student Details:</h5>
                                    
                                </div>
                                
                                <div class="charSideDetail">
                                    <strong>Name: </strong> {{$student['firstName']}} {{$student['middleName']}} {{$student['lastName']}}
                                  </div>
                                <div class="charSideDetail">
                                    <strong> mobile: </strong> {{$student['mobileNo']}}
                                </div>
                                <div class="charSideDetail">
                                    <strong>DOB: </strong> {{$student['dateOfBirth']}}
                                </div>
                                <div class="charSideDetail">
                                    <strong>Email: </strong> {{$student['email']}}
                                </div>
                                <div class="charSideDetail">
                                    <strong>Gender: </strong> {{$student['gender']}}
                                </div>
                                
                                
                            </div>
                           
                        </label>
                        <div class="col-sm-9">
                            <div style="overflow: scroll;height:500px" class="scrollBottom">
                                <div class="appendAllMessages" style="margin-bottom:75px;">
                                    @foreach($messages as $message)
                                    @if($message['admin_role'] == 'agent')
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="max-width-420 float-right mr-10">
                                                <p class="lineBarRight "><strong>AdmitOffer <small>({{date('d-M-Y h:s A',strtotime($message['created_at']))}}) : </small></strong> {{$message['message']}} <br> </p>  
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="max-width-420">
                                                <p class="lineBar"><strong>Recruiter <small>({{date('d-M-Y h:s A',strtotime($message['created_at']))}}) : </small></strong>{{$message['message']}} <br> </p>  
                                            </div>
                                        </div>
                                    </div>
                                    @endif
                                    @endforeach
                                    <span class="newMessage"></span>  
                                </div>  
                                <div class="row ">
                                    <div class=" col-md-12 chatInput">
                                    <form method="POST" class="studentChatRequestForm">
                                        @csrf
                                        <div class=" row">
                                            <div class="col-md-12 ">
                                                <input type="hidden" name="agent_id" class="agent_id" value="{{$student['agent_id']}}">
                                                <input type="hidden" name="student_id" class="student_id" value="{{$student['id']}}">
                                                <input type="hidden" name="student" class="student" value="yes">
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