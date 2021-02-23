@extends('admin.layouts.admin') 
@section('content')
<div class="container-fluid">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                Questions List &nbsp;
                    <span class="float-right">
                        <a href="{{route('Questions.create')}}" class="btn btn-sm btn-success">Add New Question</a>
                    </span>&nbsp;
                    <span class="float-right">
                        <a href="{{route('studentQuestions.index')}}" class="btn btn-sm btn-success">Assign Question To Country</a>
                    </span>
                </div>
                <div class="card-body">
                    @include('multiauth::message')
                    <ul class="list-group">
                        @foreach ($studentQuestions as $studentQuestion)
                        
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $studentQuestion->question }}
                            <span> </span>
                            <div class="float-right">
                                <!-- <a href="#" class="btn btn-sm btn-secondary mr-3" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $studentQuestion->id }}').submit();">Delete</a>
                                <form id="delete-form-{{ $studentQuestion->id }}" action="{{ route('Questions.destroy',[$studentQuestion->id]) }}" method="POST" style="display: none;">
                                    @csrf @method('delete')
                                </form> -->

                                <a href="{{route('Questions.edit',base64_encode($studentQuestion->id))}}" class="btn btn-sm btn-info mr-3">Edit</a>
                            </div>
                        </li>
                        @endforeach @if($studentQuestions->count()==0)
                        <p class="text-center">No Question created Yet.</p>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection