@extends('admin.layouts.admin') 
@section('content')
<div class="container-fluid">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                Institutes List &nbsp;
                    <span class="float-right">
                        <a href="{{route('instituteTypes.create')}}" class="btn btn-sm btn-success">Add New Institute</a>
                    </span>
                </div>
                <div class="card-body">
                    @include('multiauth::message')
                    <ul class="list-group">
                        @foreach ($instituteTypes as $instituteType)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $instituteType->name }}
                            <div class="float-right">
                                <!-- <a href="#" class="btn btn-sm btn-secondary mr-3" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $instituteType->id }}').submit();">Delete</a>
                                <form id="delete-form-{{ $instituteType->id }}" action="{{ route('instituteTypes.destroy',[$instituteType->id]) }}" method="POST" style="display: none;">
                                    @csrf @method('delete')
                                </form> -->

                                <a href="{{route('instituteTypes.edit',base64_encode($instituteType->id))}}" class="btn btn-sm btn-info mr-3">Edit</a>
                            </div>
                        </li>
                        @endforeach @if($instituteTypes->count()==0)
                        <p class="text-center">No Institute created Yet.</p>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection