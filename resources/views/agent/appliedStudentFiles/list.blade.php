@extends('agent.layouts.app')

@section('content')
<div class="container">
    
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Applied Students List &nbsp;
                    <span class="float-right">
                        <a href="{{route('files.create')}}" class="btn btn-sm btn-success">Apply For Abroad</a>
                    </span>
                    <span class="float-right">
                        <!-- <a href="{{route('files.index')}}" class="btn btn-sm btn-danger float-right">Back</a> -->
                    </span>
                </div>
                <div class="card-body">
                    @include('multiauth::message')
                    <ul class="list-group">
                    <li class="list-group-item d-flex justify-content-between align-items-center capitalize">
                            
                                <span class="badge "> Student Name</span>
                                <span class="badge "> Course</span>
                                <span class="badge "> Status</span>
                                <span class="badge "> Country</span>
                                <span class="badge "> Action</span>
                     
                        </li>
                        @foreach ($appliedStudentFiles as $appliedStudentFile)
                        <li class="list-group-item d-flex justify-content-between align-items-center capitalize">
                            {{ $appliedStudentFile->student->name }}
                            <span class="badge "> {{ $appliedStudentFile->course->name }}</span>
                                @if($appliedStudentFile['file_status'] == '0')
                                <span class="badge badge-warning badge-pill">
                                    Waiting
                                </span>
                                @endif
                                @if($appliedStudentFile['file_status'] == '1')
                                <span class="badge badge-success badge-pill">
                                 Accepted
                                </span>
                                @endif
                                @if($appliedStudentFile['file_status'] == '2')
                                <span class="badge badge-success badge-pill">
                                 Rejected
                                </span>
                                @endif
                                <span class="badge "> {{ $appliedStudentFile->country->name }}</span>
                            <div class="float-right">
                                <a href="#" class="btn btn-sm btn-secondary mr-3" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $appliedStudentFile->id }}').submit();">Delete</a>
                                <form id="delete-form-{{ $appliedStudentFile->id }}" action="{{ route('files.destroy',[$appliedStudentFile->id]) }}" method="POST" style="display: none;">
                                    @csrf @method('delete')
                                </form>

                                <a href="{{route('files.edit',base64_encode($appliedStudentFile->id))}}" class="btn btn-sm btn-info mr-3">Edit</a>
                                <div class=""><a href="{{route('agent.student.chat.show',base64_encode($appliedStudentFile['id']))}}" class="btn btn-success" >Student Chat</a></div>
                            </div>
                        </li>
                        @endforeach @if($appliedStudentFiles->count()==0)
                        <p class="text-center">No File Request Yet.</p>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
