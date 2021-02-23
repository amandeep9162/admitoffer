@extends('admin.layouts.admin') 
@section('content')
<div class="container-fluid">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                Subject List &nbsp;
                    <span class="float-right">
                        <a href="{{route('subjects.create')}}" class="btn btn-sm btn-success">Add New Subject</a>
                    </span>
                </div>
                <div class="card-body">
                    @include('multiauth::message')
                    <ul class="list-group">
                        @foreach ($subjects as $subject)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $subject->name }}
                            <div class="float-right">
                                <!-- <a href="#" class="btn btn-sm btn-secondary mr-3 deleteConfirm" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $subject->id }}').submit();">Delete</a>
                                <form id="delete-form-{{ $subject->id }}" action="{{ route('subjects.destroy',[$subject->id]) }}" method="POST" style="display: none;">
                                    @csrf @method('delete')
                                </form> -->

                                <a href="{{route('subjects.edit',base64_encode($subject->id))}}" class="btn btn-sm btn-info mr-3">Edit</a>
                            </div>
                        </li>
                        @endforeach @if($subjects->count()==0)
                        <p class="text-center">No Subject created Yet.</p>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection