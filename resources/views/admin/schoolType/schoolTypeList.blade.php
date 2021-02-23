@extends('admin.layouts.admin') 
@section('content')
<div class="container-fluid">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                School Type List &nbsp;
                    <span class="float-right">
                        <a href="{{route('schoolType.create')}}" class="btn btn-sm btn-success">Add New School Type</a>
                    </span>
                </div>
                <div class="card-body">
                    @include('multiauth::message')
                    <ul class="list-group">
                        @foreach ($schoolTypes as $schoolType)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $schoolType->name }}
                            <div class="float-right">
                                <!-- <a href="#" class="btn btn-sm btn-secondary mr-3" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $schoolType->id }}').submit();">Delete</a>
                                <form id="delete-form-{{ $schoolType->id }}" action="{{ route('schoolType.destroy',[$schoolType->id]) }}" method="POST" style="display: none;">
                                    @csrf @method('delete')
                                </form> -->

                                <a href="{{route('schoolType.edit',base64_encode($schoolType->id))}}" class="btn btn-sm btn-info mr-3">Edit</a>
                            </div>
                        </li>
                        @endforeach @if($schoolTypes->count()==0)
                        <p class="text-center">No School Type created Yet.</p>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection