@extends('admin.layouts.admin')

@section('content')
<div class="container-fluid">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    All Applied Students List &nbsp;
                    <!-- <span class="float-right">
                        <a href="{{route('studentfiles.create')}}" class="btn btn-sm btn-success">Apply New Student File</a>
                    </span> -->
                    <span class="float-right">
                        <!-- <a href="{{route('studentfiles.index')}}" class="btn btn-sm btn-danger float-right">Back</a> -->
                    </span>
                </div>
                <div class="card-body">
                    @include('multiauth::message')
                <table data-order='[[ 0, "desc" ]]' class="align-middle text-truncate mb-0 table table-borderless cell-border table-hover tableID" >
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Applied_at</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Student ID</th>
                            <th class="text-center">Agent</th>
                            <th class="text-center">Email</th>
                            <th class="text-center">Applications</th>
                            <th class="text-center">Proceed</th>
                            <th class="text-center">Qualification</th>
                            <th class="text-center">Pendency </th>
                            <th class="text-center">Comment </th>
                            <th class="text-center">Shortlist </th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
       
                <?php
                    $user =Auth::guard('admin')->user();
                           
                    $isMatchPreProcess = [];
                    foreach($appliedStudentFiles as $appliedStudentFile){
                        foreach($appliedStudentFile->appliedStudentFiles as $value){
                            if((int)$value['preProcessBy_id'] == (int)$user['id']){
                               $isMatchPreProcess[] = $appliedStudentFile['id'];
                            }
                        }
                    }
                ?>


                    @foreach($appliedStudentFiles as $appliedStudentFile)
                    @if($user->roles)
                        @if($user->roles[0]['name'] == 'preprocess')
                            
                         @if(in_array($appliedStudentFile['id'],$isMatchPreProcess))
                        
                        <tr>
                                 <td class="text-center">
                                    <div class="badge badge-pill badge-warning">{{ $appliedStudentFile->id }}</div>
                                </td>
                                <td class="text-center">
                                    <div class="badge badge-pill badge-warning">{{ $appliedStudentFile->applied_at }}</div>
                                </td>
                                
                              
                                <td class="text-center capitalize">
                                    <span class="float-left padding-5px stdImg">
                                    @if($appliedStudentFile->studentImage)
                                        <img class="rounded-circle" src="{{asset($appliedStudentFile->studentImage->path.'/'.$appliedStudentFile->studentImage->name)}}" width="40"  >
                                    @else
                                        <img class="rounded-circle" src="{{asset('images/site/user-img.png')}}" width="40" alt="your image" />

                                    @endif
                                    </span>
                                    <a href="#" class="">{{ $appliedStudentFile->firstName }}&nbsp;{{$appliedStudentFile->lastName}}</a>
                                    @if($appliedStudentFile->nationality)
                                    <div class="widget-subheading text-center"><small>Nationality: </small><i><img class="" src="{{asset($appliedStudentFile->countryAddress['path'].'/'.$appliedStudentFile->countryAddress['image_name'])}}" width="20"  ></i></div>
                                    @endif
                                    <div class="widget-subheading text-left"><small> {{ $appliedStudentFile->agent['name'] }}</small></div>
                                </td>
                                <td class="text-center">
                                    <div class="badge badge-pill badge-warning">{{ $appliedStudentFile->student_unique_id }}</div>
                                </td>
                                  <td class="text-center">
                                    <div >{{ $appliedStudentFile->agent['name'] }}
                                        <p>{{ $appliedStudentFile->agent['company_name'] }}</p>
                                        <p>{{ $appliedStudentFile->agent['email'] }}</p>
                                        <p>{{ $appliedStudentFile->agent['mobileno'] }}</p>
                                    </div>
                                </td>
                                <td class="text-center" style="text-transform: lowercase;">{{ $appliedStudentFile->email }}</td>
                                <td class="text-center">
                                    @if($appliedStudentFile->country['path'])
                                    {{$appliedStudentFile->appliedStudentFiles->count()}} X <img class="" src="{{asset($appliedStudentFile->country['path'].'/'.$appliedStudentFile->country['image_name'])}}" width="25"  >
                                    @else
                                    {{$appliedStudentFile->appliedStudentFiles->count()}} X Flag
                                    @endif
                                </td>
                                <td class="text-center">
                                    <span class="text-success">{{ $appliedStudentFile->appliedStudentFilesByAdmin->count() }}</span> ~
                                    <span class="text-danger"> {{ ((int)$appliedStudentFile->appliedStudentFiles->count() - (int)$appliedStudentFile->appliedStudentFilesByAdmin->count()) }} </span>
                                </td>
                                <td class=" capitalize"><a href="javascript:void;"><strong>Completed :</strong> {{$appliedStudentFile->previousQualifications['name']}}</a>
                                <div class="widget-subheading">
                                        <a href="javascript:void;"><strong>Grade10 :</strong>
                                            @if($appliedStudentFile->grade10)
                                                @if($appliedStudentFile->grade10->totals)
                                                    @if($appliedStudentFile->grade10->boards)
                                                    {{$appliedStudentFile->grade10->totals['name']}} ({{$appliedStudentFile->grade10->boards['name']}})
                                                    @endif
                                                @endif
                                            @endif
                                        </a>
                                    </div>
                                    <div class="widget-subheading">
                                        <a href="javascript:void;"><strong>Grade12 :</strong>
                                            @if($appliedStudentFile->grade12)
                                                @if($appliedStudentFile->grade12->totals)
                                                @if($appliedStudentFile->grade12->boards)
                                                {{$appliedStudentFile->grade12->totals['name']}} ({{$appliedStudentFile->grade12->boards['name']}})
                                                @endif
                                                @endif
                                            @endif
                                        </a>
                                    </div>
                                </td>
                                
                                <td class="text-center">
                                    @if( $appliedStudentFile->pendeciesStudentFiles->count() > 0)
                                    <div class="badge badge-pill badge-danger">{{ $appliedStudentFile->pendeciesStudentFiles->count() }} </div>
                                    @else
                                    <div class="badge badge-pill badge-success">{{ $appliedStudentFile->pendeciesStudentFiles->count() }} </div>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <form method="POST" action="{{route('student.comment')}}"> 
                                    @csrf 
                                        <input type="text" name="comment" placeholder="comment" style="width: 250px;" class="form-control" value="{{$appliedStudentFile['comment']}}">
                                        <input type="hidden" name="studentId"  class="form-control" value="{{$appliedStudentFile->id}}">
                                        <button class="btn btn-success">Save</button>
                                    </form>
                                </td>
                               
                                 <td class="text-center">
                                    @if($appliedStudentFile['IsShortlisting'] == 'yes')
                                        Short list by team
                                    @endif
                                </td>
                              
                                <td class="text-center">
                                    <a href="{{route('studentfiles.show',base64_encode($appliedStudentFile->id))}}" class=" btn btn-sm btn-info ">View</a>
                                    <a href="{{route('student.program.add',base64_encode($appliedStudentFile->id))}}" class=" btn btn-sm btn-info ">Add Programs</a>
                                    <div class=""><a href="{{route('admin.student.chat',base64_encode($appliedStudentFile['id']))}}" class="btn btn-success">Student Chat <span style="    position: absolute;
                            background: #e1000a;
                            padding: 10px;
                            border-radius: 50%;
                            margin-top: 10px;
                                font-weight: 800;
                            top: -23px;">
                            @if($appliedStudentFile->studentNotifications)
                                        {{$appliedStudentFile->studentNotifications->count()}}
                                    @endif
                                    </span></a>
                                    </div>
                                </td>
                        </tr>
                        
                                @endif
                                @else
                                 <tr>
                                 <td class="text-center">
                                    <div class="badge badge-pill badge-warning">{{ $appliedStudentFile->id }}</div>
                                </td>
                                <td class="text-center">
                                    <div class="badge badge-pill badge-warning">{{ $appliedStudentFile->applied_at }}</div>
                                </td>
                                
                              
                                <td class="text-center capitalize">
                                    <span class="float-left padding-5px stdImg">
                                    @if($appliedStudentFile->studentImage)
                                        <img class="rounded-circle" src="{{asset($appliedStudentFile->studentImage->path.'/'.$appliedStudentFile->studentImage->name)}}" width="40"  >
                                    @else
                                        <img class="rounded-circle" src="{{asset('images/site/user-img.png')}}" width="40" alt="your image" />

                                    @endif
                                    </span>
                                    <a href="#" class="">{{ $appliedStudentFile->firstName }}&nbsp;{{$appliedStudentFile->lastName}}</a>
                                    @if($appliedStudentFile->nationality)
                                    <div class="widget-subheading text-center"><small>Nationality: </small><i><img class="" src="{{asset($appliedStudentFile->countryAddress['path'].'/'.$appliedStudentFile->countryAddress['image_name'])}}" width="20"  ></i></div>
                                    @endif
                                    <div class="widget-subheading text-left"><small> {{ $appliedStudentFile->agent['name'] }}</small></div>
                                </td>
                                <td class="text-center">
                                    <div class="badge badge-pill badge-warning">{{ $appliedStudentFile->student_unique_id }}</div>
                                </td>
                                  <td class="text-center">
                                    <div >{{ $appliedStudentFile->agent['name'] }}
                                        <p>{{ $appliedStudentFile->agent['company_name'] }}</p>
                                        <p>{{ $appliedStudentFile->agent['email'] }}</p>
                                        <p>{{ $appliedStudentFile->agent['mobileno'] }}</p>
                                    </div>
                                </td>
                                <td class="text-center" style="text-transform: lowercase;">{{ $appliedStudentFile->email }}</td>
                                <td class="text-center">
                                    @if($appliedStudentFile->country['path'])
                                    {{$appliedStudentFile->appliedStudentFiles->count()}} X <img class="" src="{{asset($appliedStudentFile->country['path'].'/'.$appliedStudentFile->country['image_name'])}}" width="25"  >
                                    @else
                                    {{$appliedStudentFile->appliedStudentFiles->count()}} X Flag
                                    @endif
                                </td>
                                <td class="text-center">
                                    <span class="text-success">{{ $appliedStudentFile->appliedStudentFilesByAdmin->count() }}</span> ~
                                    <span class="text-danger"> {{ ((int)$appliedStudentFile->appliedStudentFiles->count() - (int)$appliedStudentFile->appliedStudentFilesByAdmin->count()) }} </span>
                                </td>
                                <td class=" capitalize"><a href="javascript:void;"><strong>Completed :</strong> {{$appliedStudentFile->previousQualifications['name']}}</a>
                                <div class="widget-subheading">
                                        <a href="javascript:void;"><strong>Grade10 :</strong>
                                            @if($appliedStudentFile->grade10)
                                                @if($appliedStudentFile->grade10->totals)
                                                    @if($appliedStudentFile->grade10->boards)
                                                    {{$appliedStudentFile->grade10->totals['name']}} ({{$appliedStudentFile->grade10->boards['name']}})
                                                    @endif
                                                @endif
                                            @endif
                                        </a>
                                    </div>
                                    <div class="widget-subheading">
                                        <a href="javascript:void;"><strong>Grade12 :</strong>
                                            @if($appliedStudentFile->grade12)
                                                @if($appliedStudentFile->grade12->totals)
                                                @if($appliedStudentFile->grade12->boards)
                                                {{$appliedStudentFile->grade12->totals['name']}} ({{$appliedStudentFile->grade12->boards['name']}})
                                                @endif
                                                @endif
                                            @endif
                                        </a>
                                    </div>
                                </td>
                                
                                <td class="text-center">
                                    @if( $appliedStudentFile->pendeciesStudentFiles->count() > 0)
                                    <div class="badge badge-pill badge-danger">{{ $appliedStudentFile->pendeciesStudentFiles->count() }} </div>
                                    @else
                                    <div class="badge badge-pill badge-success">{{ $appliedStudentFile->pendeciesStudentFiles->count() }} </div>
                                    @endif
                                </td>
                                <td class="text-center">
                                    <form method="POST" action="{{route('student.comment')}}"> 
                                    @csrf 
                                        <input type="text" name="comment" placeholder="comment" style="width: 250px;" class="form-control" value="{{$appliedStudentFile['comment']}}">
                                        <input type="hidden" name="studentId"  class="form-control" value="{{$appliedStudentFile->id}}">
                                        <button class="btn btn-success">Save</button>
                                    </form>
                                </td>
                                <td class="text-center">
                                    @if($appliedStudentFile['IsShortlisting'] == 'yes')
                                        Short list by team
                                    @endif
                                </td>

                              
                                <td class="text-center">
                                    <a href="{{route('studentfiles.show',base64_encode($appliedStudentFile->id))}}" class=" btn btn-sm btn-info ">View</a>
                                    <a href="{{route('student.program.add',base64_encode($appliedStudentFile->id))}}" class=" btn btn-sm btn-info ">Add Programs</a>
                                    <div class=""><a href="{{route('admin.student.chat',base64_encode($appliedStudentFile['id']))}}" class="btn btn-success">Student Chat <span style="    position: absolute;
                            background: #e1000a;
                            padding: 10px;
                            border-radius: 50%;
                            margin-top: 10px;
                                font-weight: 800;
                            top: -23px;">
                            @if($appliedStudentFile->studentNotifications)
                                        {{$appliedStudentFile->studentNotifications->count()}}
                                    @endif
                                    </span></a>
                                    </div>
                                </td>
                        </tr>
                                
                            @endif
                        @endif
                        @endforeach 
                    </tbody>
                    </table>


                  
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('addjavascript')
<script src="{{ asset('js/app.js') }}" ></script>

@endsection