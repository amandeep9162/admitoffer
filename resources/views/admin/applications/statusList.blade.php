@extends('admin.layouts.admin') 
@section('content')
<div class="container-fluid">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Applications List &nbsp;
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
                            <th class="text-center">Applied at</th>
                            <th class="text-center">Agent name</th>
                            <th class="text-center">Agent company name</th>
                            <th class="text-center">Agent Mobile</th>
                            <th class="text-center">Student ID</th>
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
                        @foreach($applications as $application)
                        <tr>
                            <td class="text-center capitalize">
                                <div class="badge badge-pill badge-warning num_1">{{ $application['id'] }}</div>
                            </td>
                            
                            <td class="text-center capitalize">
                                <div class="stdDetail">
                                    @if($application->student)
                                <a href="{{route('student.show',base64_encode($application->student->id))}}" class="">
                                    {{ $application->student['firstName'] }} {{ $application->student['middleName'] }} {{ $application->student['lastName'] }}
                                </a>
                                    @endif
                              
                                </div>
                            </td>
                             <td class="text-center capitalize">
                                <div class="stdDetail">
                                   
                                
                                <div class="widget-subheading text-center">
                                    @if($application->student)
                                    {{ $application->student['dateOfBirth'] }}
                                    @endif
                                </div>
                                </div>
                            </td>
                            <td class="text-center capitalize">
                                <div class="stdDetail">
                                <div class="badge badge-pill badge-warning text-center">
                                    @if($application->student)
                                    {{ $application->student['applied_at'] }}</div>
                                    @endif
                                </div>
                            </td>
                            <td class="text-center capitalize">
                                <div class="stdDetail">
                                    @if($application->agent)
                                    {{$application->agent['name']}}
                                    @endif
                           
                                </div>
                            </td>
                            <td class="text-center capitalize">
                                <div class="stdDetail">
                                    @if($application->agent)
                                    {{$application->agent['company_name']}}
                                    @endif
                           
                                </div>
                            </td>
                            <td class="text-center capitalize">
                                <div class="stdDetail">
                                    @if($application->agent)
                                    {{$application->agent['mobileno']}}
                                    @endif
                           
                                </div>
                            </td>
                            <td class="text-center">
                                    AO: <div class="badge badge-pill badge-warning">@if($application->student)
                                        {{ $application->student->student_unique_id }}
                                    @endif</div>
                                    @if($application->offerLettr)   
                                    @if($application->offerLettr['college_student_id'])   
                                    <div class="widget-subheading text-center"><a href="javascript:;"><small>UNI ID: </small>
                                    {{$application->offerLettr['college_student_id'] }}
                                    
                                </a></div>
                                @endif    
                                @endif    
                            </td>
                            <td class="text-center">
                                    @if($application->course)
                                    {{$application->course->college['name']}}
                                
                                    @endif
                                
                            </td>
                             <td class="text-center">
                                    @if($application->course)
                                <div class="widget-subheading text-center">
                                    {{$application->course->college['name'] }}
                                </div>
                                    @endif
                                
                            </td>
                             <td class="text-center">{{ $application->course['name'] }}
                                
                                
                            </td>
                             <td class="text-center">
                                <div class="widget-subheading text-center">
                                @if($application->course)
                                        @if($application->course->course_levels)
                                            <strong>{{$application->course->course_levels['name'] }}</strong>
                                        @endif
                                    @endif
                                </div>
                                
                            </td>
                             <td class="capitalize text-center">
                        @if($application->course)
                        {{$application->course->intakes['name']}}
                        @endif
                        
                                </td>
                                <td class="text-center">
                                    @if($application)
                                    @if($application->applicationStatus['name'])
                                    <span class="text-success">{{$application->applicationStatus['name']}}</span>
                                    
                                    @endif
                                    @endif
                                </td>
                                <td class="text-center p_link">
                                    @if( $application->pendencies->count() > 0)
                                    <a href="{{route('student.viewApplicationPendencies',base64_encode($application['id']))}}"><span class="badge badge-pill badge-danger num_1"> {{ $application->pendencies->count() }}</span></a>&nbsp;
                                    @else
                                    <div class="badge badge-pill badge-success num_1">{{ $application->pendencies->count() }} </div>
                                @endif
                            </td>
                            <td class="text-center profile_btn">
                                @if($application->student)
                                @if($application->student['lock_status'] == 0)
                              <!--   <a href="#" class="btn btn-sm btn-danger  delete del_1" data_id="{{$application->student->id}}" data-toggle="tooltip" title="Delete"><i class="pe-7s-trash"></i></a>
                                <input type="hidden" class="deleteID" value="{{$application->student->id}}">
                                <form id="delete-form-{{ $application->id }}" class="form" action="{{ route('student.destroy',[$application->student->id]) }}" method="POST" style="display: none;">
                                    @csrf @method('delete')
                                </form>
                                <a href="{{route('student.edit',base64_encode($application->student->id))}}" class="btn btn-sm btn-info edit_1" data-toggle="tooltip" title="Edit"><i class="pe-7s-note"></i></a> -->
                                @else
                                <div class="badge badge-danger badge-pill"><i class="fa fa-lock"></i></div>
                                @endif
                                @endif
                               
                                <a href="{{route('application.show',base64_encode($application['id']))}}" class=" btn btn-sm btn-info view_1" data-toggle="tooltip" title="View"><i class="pe-7s-look"></i></a>
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

