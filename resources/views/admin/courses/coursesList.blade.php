@extends('admin.layouts.admin') 
@section('content')
<div class="app-page-title" style="margin: -30px 0px 30px;">
    <div class="page-title-wrapper">
        <div class="page-title-heading">
            <div class="" style="margin: 0 30px 0 0;">
                
            </div>
            <div class="capitalize">{{$college['name']}}
                <div class="page-title-subheading capitalize">{{$college['description']}}.
                </div>
            </div>
        </div>
        
    </div>
</div>
<div class="container-fluid">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <div class="col-md-6">

                        Courses List &nbsp;
                        <span class="">
                            <a href="{{route('courses.create',base64_encode($collegeId))}}" class="btn btn-sm btn-success">Add New Course</a>
                        </span>
                        <span class="">
                            <a href="{{route('colleges.index')}}" class="btn btn-sm btn-danger ">Back</a>
                        </span>
                    </div>
                    <div class="col-md-6">
                   
                    </div>
                </div>
                <div class="card-body">
                    @include('multiauth::message')
                    <ul class="list-group">
                    <table class="mb-0 table tableID">
                        <thead>
                            <tr>
                                <th>ID</th>
                                <th>Course ID</th>
                                <th>Program Name</th> 
                                <th>Program Category</th> 
                                <th>Intake</th> 
                                <th>Duration Text</th> 
                                <th>IELTS</th> 
                                <th>Program Title</th> 
                                <th>Program Level</th> 
                                <th>Verifications</th> 
                                <th>Status</th> 
                                
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody data-order='[[1,"asc" ]]' class="appendQualTest ">
                            
                        @foreach ($courses as $course)
                            <tr >
                                <th scope="row">{{$course['id']}}</th>
                                <td >{{$course['course_unique_id']}}</td>
                                <td class="capitalize" width="30%" >{{ $course->name }}</td>
                                <td class="capitalize" >{{ $course->subjects['name'] }}</td>
                                <td class="capitalize" >{{ $course->intakes['name'] }}</td>
                                <td class="capitalize" >{{$course['durationText']}}</td>
                                <td class="capitalize" >{{$course->iletsScores['name']}}</td>
                             
                                <td class="capitalize" >
                                    @if($course->programTitle)
                                    {{ $course->programTitle['name'] }}
                                    @endif
                                </td>
                                <td class="capitalize" >{{$course->course_levels['name']}}</td>
                                <td class="capitalize" >
                                    @if($course['verify_by'])
                                        <span class="text-success">Verified</span>
                                    @else
                                        <span class="text-danger">Not Verified</span>
                                    @endif
                                </td>
                                <td class="capitalize" >
                                    @if($course['status'] == 0)
                                        <a class="btn btn-danger" href="{{route('course.activate',base64_encode($course['id']))}}">Deactivated</a>
                                    @else
                                        <a class="btn btn-info" href="{{route('course.deactivate',base64_encode($course['id']))}}">Activated</a>
                                    @endif
                                </td>
                                <td>
                                    <a href="#" class="btn btn-sm btn-danger mr-3" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $course->id }}').submit();">Delete</a>
                                    <form id="delete-form-{{ $course->id }}" action="{{ route('courses.destroy',[$course->id]) }}" method="POST" style="display: none;">
                                        @csrf @method('delete')
                                    </form>

                                    <a href="{{route('courses.edit',base64_encode($course->id))}}" class="btn btn-sm btn-info mr-3">Edit</a>
                
                                </td>
                                
                            </tr>
                        @endforeach @if($courses->count()==0)
                        <p class="text-center">No course created Yet.</p>
                        @endif
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection