@extends('admin.layouts.admin') 
@section('content')
<div class="container-fluid">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                Qualifications List &nbsp;
                    <span class="float-right">
                        <a href="{{route('qualification.create')}}" class="btn btn-sm btn-success">Add New Qualification</a>
                    </span>
                </div>
                <div class="card-body">
                    @include('multiauth::message')
                    <ul class="list-group">
                        @foreach ($qualifications as $qualification)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $qualification->name }}
                            <div class="float-right">
                                <!-- <a href="#" class="btn btn-sm btn-secondary mr-3" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $qualification->id }}').submit();">Delete</a>
                                <form id="delete-form-{{ $qualification->id }}" action="{{ route('qualification.destroy',[$qualification->id]) }}" method="POST" style="display: none;">
                                    @csrf @method('delete')
                                </form> -->

                                <a href="{{route('qualification.edit',base64_encode($qualification->id))}}" class="btn btn-sm btn-info mr-3">Edit</a>
                            </div>
                        </li>
                        @endforeach @if($qualifications->count()==0)
                        <p class="text-center">No qualification created Yet.</p>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection