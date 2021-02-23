@extends('agent.layouts.app')

@section('content')
<div class="container-fluid">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Students List &nbsp;
                    <span class="float-right">
                        <a href="{{route('student.create')}}" class="btn btn-sm btn-success btn-default-color">Add New Student</a>
                    </span>
                    <span class="float-right">
                        <!-- <a href="{{route('student.index')}}" class="btn btn-sm btn-danger float-right">Back</a> -->
                    </span>
                </div>
                <div class="card-body">
                    @include('multiauth::message')
                    <table data-order='[[ 0, "desc" ]]' class="align-middle text-truncate mb-0 table table-borderless table-hover tableID cell-border" >
                    <thead>
                        <tr>
                            <th class="text-center">#</th>
                            <th class="text-center">Name</th>
                            <th class="text-center">Student ID</th>
                            <th class="text-center">Email/Skype/Mobile</th>
                            <th class="text-center">Applications</th>
                            <th class="text-center">Qualification</th>
                            <th class="text-center">Pendency </th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
       
                    @foreach ($students as $student)
                        <tr>
                            <td class="text-center" >
                                <div class="badge badge-pill badge-warning num_1">{{ $student->id }}</div>
                            </td>
                            <td class="text-center capitalize">
                                <span class="float-left padding-5px stdImg">
                                @if($student->studentImage)
                                    <img class="rounded-circle" src="{{asset($student->studentImage->path.'/'.$student->studentImage->name)}}" width="40"  >
                                @else
                                    <img class="rounded-circle" src="{{asset('images/site/user-img.png')}}" width="40" alt="your image" />

                                @endif
                                </span>
                                <div class="stdDetail">
                                    <a href="{{route('student.show',base64_encode($student->id))}}" class="">{{ $student->firstName }}&nbsp;{{$student->lastName}}</a>
                                    @if($student->nationality)
                                    <div class="widget-subheading text-center"><small>Nationality: </small><i><img class="" src="{{asset($student->countryAddress['path'].'/'.$student->countryAddress['image_name'])}}" width="20"  ></i></div>
                                    <div class="widget-subheading text-center dob_1"><span><small>DOB: </small>{{ $student->dateOfBirth }}</span></div>
                                    @endif
                                </div>
                            </td>
                            <td class="text-center">
                            <span>&nbsp;AO: </span> <div class="badge badge-pill badge-warning"> {{ $student->student_unique_id }}</div>
                            </td>
                            <td class="text-center">
                            <div class="widget-subheading text-center sky_1"><span>{{ $student->email }}</div>
                            <div class="widget-subheading text-center sky_1"><span>Skype: </span>{{ $student->skypeId }}</div>
                            <div class="widget-subheading text-center sky_1"><span>{{ $student->mobileNo }}</span></div>
                            </td>
                            <td class="text-center">
                                @if($student->appliedStudentFiles->count() > 0)
                                    @if($student->country['path'])
                                    {{$student->appliedStudentFiles->count()}} X <img class="" src="{{asset($student->country['path'].'/'.$student->country['image_name'])}}" width="25"  >
                                    @else
                                    {{$student->appliedStudentFiles->count()}} X Flag
                                    @endif
                                @else
                                <span class="text-danger">Not Applied Yet</span>
                                @endif
                            </td>
                            <td class=" capitalize">
                                <div class="widget-subheading grd_1"><span><strong>Completed :</strong> {{$student->previousQualifications['name']}}</span></div>
                                <div class="widget-subheading grd_1">
                                    <span><strong>Grade10 :</strong>
                                        @if($student->grade10)
                                            @if($student->grade10->totals)
                                                @if($student->grade10->boards)
                                                {{$student->grade10->totals['name']}} ({{$student->grade10->boards['name']}})
                                                @endif
                                            @endif
                                        @endif
                                    </span>
                                </div>
                                <div class="widget-subheading grd_1">
                                    <span><strong>Grade12 :</strong>
                                        @if($student->grade12)
                                        
                                            @if($student->grade12->totals)
                                            {{$student->grade12->totals['name']}}
                                            @endif
                                            @if($student->grade12->boards)
                                             ({{$student->grade12->boards['name']}})
                                            @endif
                                        @endif
                                    </span>
                                </div>
                                @if($student->degree)
                                <div class="widget-subheading grd_1">
                                    <span><strong>Graduation :</strong>
                                            @if($student->degree->totals)
                                                @if($student->degree->boards)
                                                {{$student->degree->totals['name']}} ({{$student->degree->boards['name']}})
                                                @endif
                                            @endif
                                    </span>
                                </div>
                                @endif
                            </td>
                            <td class="text-center">
                                @if( $student->pendeciesStudentFiles->count() > 0)
                                <div class="badge badge-pill badge-danger num_1">{{ $student->pendeciesStudentFiles->count() }} </div>
                                @else
                                <div class="badge badge-pill badge-success num_1">{{ $student->pendeciesStudentFiles->count() }} </div>
                                @endif
                            </td>
                          
                            <td class="text-center profile_btn">
                                @if($student['lock_status'] == 0)
                                <a href="#" class="btn btn-sm btn-danger  delete del_1" data_id="{{$student->id}}" data-toggle="tooltip" title="Delete" ><i class="pe-7s-trash"></i></a>
                                <input type="hidden" class="deleteID" value="{{$student->id}}">
                                <form id="delete-form-{{ $student->id }}" class="form" action="{{ route('student.destroy',[$student->id]) }}" method="POST" style="display: none;">
                                    @csrf @method('delete')
                                </form>
                                <a href="{{route('student.edit',base64_encode($student->id))}}" class="btn btn-sm btn-info edit_1" data-toggle="tooltip" title="Edit"><i class="pe-7s-note"></i></a>
                                @else
                                <div class="badge badge-danger badge-pill locked_1">Applied <i class="fa fa-lock"></i></div>
                                @if($student['applingForCountry'] != '38')
                                <a href="{{route('student.program.addMore',base64_encode($student->id))}}" class="btn btn-sm btn-info edit_1" data-toggle="tooltip" title="Add more"><i class="pe-7s-plus"></i></a>
                                @endif
                                <!-- <form method="POST" action="{{route('verify.applyFor')}}" > 
                                @csrf
                                <input type="hidden" name="studentId" class="studentId" value="{{$student->id}}">

                                    <button class="btn btn-sm btn-info" data-toggle="tooltip" title="Add more"><i class="pe-7s-plus"></i></button>
                                </form> -->
                                @endif
                                <a href="{{route('student.show',base64_encode($student->id))}}" class=" btn btn-sm btn-info view_1" data-toggle="tooltip" title="View"><i class="pe-7s-look"></i></a>
                                <div class=""><a href="{{route('agent.student.chat.show',base64_encode($student['id']))}}" class="btn btn-success" >Student Chat</a></div>
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
