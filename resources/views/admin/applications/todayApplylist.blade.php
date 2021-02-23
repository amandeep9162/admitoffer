<?php
$studentUser =Auth::guard('student')->check();
?>

@extends(($studentUser === false) ? 'admin.layouts.admin' : 'applicant.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Today applications sent to university&nbsp;
                    <span class="float-right">
                        <!-- <a href="{{route('student.create')}}" class="btn btn-sm btn-success">Add New Student</a> -->
                    </span>
                    <span class="float-right">
                        <!-- <a href="{{route('student.index')}}" class="btn btn-sm btn-danger float-right">Back</a> -->
                    </span>
                </div>
                <div class="card-body">
                    @include('multiauth::message')
                    <table data-order='[[ 0, "desc" ]]' class="align-middle text-truncate mb-0 table cell-border table-hover tableID" >
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">DOB</th>
                            <th class="text-center">Applied_at</th>
                            <th class="text-center">Student ID</th>
                            <th class="text-center">Agent name</th>
                            <th class="text-center">Agent company name</th>
                            <th class="text-center">Agent mobile</th>
                            <th class="text-center">Institutes</th>
                            <th class="text-center">Campus</th>
                            <th class="text-center">Program</th>
                            <th class="text-center">Level</th>
                            <th class="text-center">Intake</th>
                            <th class="text-center">Status  </th>
                            <th class="text-center">Pendency </th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>


                        @foreach ($appliedStudentFiles as $Pendstudent)
                        <tr>
                            <td class="text-center capitalize">
                                <div class="badge badge-pill badge-warning num_1">{{ $Pendstudent['application_id'] }}</div>
                            </td>
                            <td class="text-center capitalize">
                                <div class="stdDetail">
                                	@if($Pendstudent->application->student)
                                <a href="{{route('student.show',base64_encode($Pendstudent->application->student->id))}}" class="">
                                	{{ $Pendstudent->application->student['firstName'] }} {{ $Pendstudent->application->student['middleName'] }} {{ $Pendstudent->application->student['lastName'] }}
                                </a>
                                	@endif
                            </td>
                            <td class="text-center capitalize">
                                <div class="stdDetail">
                                    
                                
                                <div class="widget-subheading text-center">
                                    @if($Pendstudent->application->student)
                                    {{ $Pendstudent->application->student['dateOfBirth'] }}</div>
                                    @endif
                                </div>
                            </td>
                            <td class="text-center capitalize">
                                <div class="stdDetail">
                                <div class="badge badge-pill badge-warning text-center">
                                    @if($Pendstudent->application->student)
                                    {{ $Pendstudent->application->student['applied_at'] }}</div>
                                    @endif
                                </div>
                            </td>
                             <td class="text-center">
                                AO: <div class="badge badge-pill badge-warning">
                                    @if($Pendstudent->application->student)
                                    {{ $Pendstudent->application->student->student_unique_id }}
                                    @endif
                                </div>
                                @if($Pendstudent->offerLettr)   
                                @if($Pendstudent->offerLettr['college_student_id'])   
                                <div class="widget-subheading text-center"><a href="javascript:;"><small>UNI ID: </small>
                                {{$Pendstudent->offerLettr['college_student_id'] }}
                                
                            </a></div>
                            @endif    
                            @endif    
                        </td>
                            <td class="text-center">
                               @if($Pendstudent->application->agent)
                               {{$Pendstudent->application->agent['name']}}
                              
                               @endif
                            </td>
                            <td class="text-center">
                               @if($Pendstudent->application->agent)
                                <div>
                                   {{$Pendstudent->application->agent['company_name']}}
                               </div>
                               @endif
                            </td>
                            <td class="text-center">
                               @if($Pendstudent->application->agent)
                                <div>
                                   {{$Pendstudent->application->agent['mobileno']}}
                               </div>
                               @endif
                            </td>
                       
                        <td class="text-center">
                            @if($Pendstudent->application->course)
                            {{$Pendstudent->application->course->college['name']}}
                            @endif
                            
                        </td>
                        <td class="text-center">
                            @if($Pendstudent->application->course)
                            <div class="widget-subheading text-center">
                            {{$Pendstudent->application->course->college['campus'] }}
                            @endif
                            </div>
                            
                        </td>
                    <td class="text-center">{{ $Pendstudent->application->course['name'] }}
                        
                    </td>
                    <td class="text-center">
                        <div class="widget-subheading text-center"> 
                        @if($Pendstudent->application->course)
                                @if($Pendstudent->application->course->course_levels)
                                    <strong>{{$Pendstudent->application->course->course_levels['name'] }}</strong>
                                @endif
                            @endif
                        </div>
                        
                    </td>
                    <td class="capitalize text-center">
                        @if($Pendstudent->application->course)
                        {{$Pendstudent->application->course->intakes['name']}}
                        @endif
                        
                                </td>
                                <td class="text-center">
                                    @if($Pendstudent)
                                    @if($Pendstudent->application->applicationStatus['name'])
                                    <span class="text-success">{{$Pendstudent->application->applicationStatus['name']}}</span>
                                    
                                    @endif
                                    @endif
                                </td>
                                <td class="text-center p_link">
                                    @if( $Pendstudent->application->pendencies)
                                    @if( $Pendstudent->application->pendencies->count() > 0)
                                    <a href="{{route('student.viewApplicationPendencies',base64_encode($Pendstudent['application_id']))}}"><span class="badge badge-pill badge-danger num_1"> {{ $Pendstudent->application->pendencies->count() }}</span></a>&nbsp;
                                    @else
                                    <div class="badge badge-pill badge-success num_1">{{ $Pendstudent->application->pendencies->count() }} </div>
                                @endif
                                @endif
                            </td>
                            <td class="text-center profile_btn">
                                @if($Pendstudent->application->student)
                                @if($Pendstudent->application->student['lock_status'] == 0)
                                <a href="#" class="btn btn-sm btn-danger  delete del_1" data_id="{{$Pendstudent->application->student->id}}" data-toggle="tooltip" title="Delete"><i class="pe-7s-trash"></i></a>
                                <input type="hidden" class="deleteID" value="{{$Pendstudent->application->student->id}}">
                                <form id="delete-form-{{ $Pendstudent->application_id }}" class="form" action="{{ route('student.destroy',[$Pendstudent->application->student->id]) }}" method="POST" style="display: none;">
                                    @csrf @method('delete')
                                </form>
                                <a href="{{route('student.edit',base64_encode($Pendstudent->application->student->id))}}" class="btn btn-sm btn-info edit_1" data-toggle="tooltip" title="Edit"><i class="pe-7s-note"></i></a>
                                @else
                                <div class="badge badge-danger badge-pill"><i class="fa fa-lock"></i></div>
                                @endif
                                @endif
                                @if($studentUser === true)
                                <a href="{{route('applicant.student.application.View',base64_encode($Pendstudent['application_id']))}}" class=" btn btn-sm btn-info view_1" data-toggle="tooltip" title="View"><i class="pe-7s-look"></i></a>
                                @else
                                <a href="{{route('application.show',base64_encode($Pendstudent['application_id']))}}" class=" btn btn-sm btn-info view_1" data-toggle="tooltip" title="View"><i class="pe-7s-look"></i></a>
                                @endif
                            </td>
                        </tr>
                        @endforeach 
                    </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
