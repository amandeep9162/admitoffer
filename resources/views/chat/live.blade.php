@extends('admin.layouts.admin') 
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
                                    <h5>Agent Details:</h5>
                                    
                                </div>
                                
                                <div class="charSideDetail">
                                    <strong>Name: </strong> {{$agent['name']}}
                                </div>
                                <div class="charSideDetail">
                                    <strong>Company Name: </strong> {{$agent['company_name']}}
                                </div>
                                <div class="charSideDetail">
                                    <strong>Mobile no: </strong> {{$agent['mobileno']}}
                                </div>
                                <div class="charSideDetail">
                                    <strong>Email: </strong> {{$agent['email']}}
                                </div>
                                <div class="charSideDetail">
                                    <strong>Address: </strong> {{$agent['address']}}
                                </div>
                                <div class="charSideDetail">
                                    <strong>Last login: </strong> {{ Carbon\Carbon::parse($agent['last_login'])->format('d-M-Y h:s A') }}
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
                                                <p class="lineBarRight "><strong>AdmitOffer: </strong> {{$message['message']}} <br> <small>{{date('d-M-Y h:s A',strtotime($message['created_at']))}}</small></p>  
                                            </div>
                                        </div>
                                    </div>
                                    @else
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="max-width-420">
                                                <p class="lineBar"><strong>Recruiter: </strong>{{$message['message']}} <br> <small>{{date('d-M-Y h:s A',strtotime($message['created_at']))}}</small></p>  
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
                                                <input type="hidden" name="agent_id" class="agent_id" value="{{$id}}">
                                                <input type="hidden" name="application_id" class="application_id" value="yes">
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