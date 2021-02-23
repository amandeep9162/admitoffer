@extends('admin.layouts.admin') 
@section('content')
<div class="container-fluid">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                Previous Qualification List &nbsp;
                    <span class="float-right">
                        <a href="{{route('previousQualification.create')}}" class="btn btn-sm btn-success">Add Previous Qualification</a>
                    </span>
                </div>
                <div class="card-body">
                    @include('multiauth::message')
                    <ul class="list-group">
                        @foreach ($previousQualifications as $previousQualification)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $previousQualification->name }}
                            <div class="float-right">
                                <!-- <a href="#" class="btn btn-sm btn-secondary mr-3" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $previousQualification->id }}').submit();">Delete</a>
                                <form id="delete-form-{{ $previousQualification->id }}" action="{{ route('instituteTypes.destroy',[$previousQualification->id]) }}" method="POST" style="display: none;">
                                    @csrf @method('delete')
                                </form> -->

                                <a href="{{route('previousQualification.edit',base64_encode($previousQualification->id))}}" class="btn btn-sm btn-info mr-3">Edit</a>
                            </div>
                        </li>
                        @endforeach @if($previousQualifications->count()==0)
                        <p class="text-center">No Previous Qualifications created Yet.</p>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection