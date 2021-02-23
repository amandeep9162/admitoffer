@extends('admin.layouts.admin') 
@section('content')
<div class="container-fluid">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                Program Title List &nbsp;
                    <span class="float-right">
                        <a href="{{route('programTitle.create')}}" class="btn btn-sm btn-success">Add New Program Title</a>
                    </span>
                </div>
                <div class="card-body">
                    @include('multiauth::message')
                    <ul class="list-group">
                        @foreach ($programTitles as $programTitle)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $programTitle->name }}
                            <div class="float-right">
                                <!-- <a href="#" class="btn btn-sm btn-secondary mr-3" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $programTitle->id }}').submit();">Delete</a>
                                <form id="delete-form-{{ $programTitle->id }}" action="{{ route('programTitle.destroy',[$programTitle->id]) }}" method="POST" style="display: none;">
                                    @csrf @method('delete')
                                </form> -->

                                <a href="{{route('programTitle.edit',base64_encode($programTitle->id))}}" class="btn btn-sm btn-info mr-3">Edit</a>
                            </div>
                        </li>
                        @endforeach @if($programTitles->count()==0)
                        <p class="text-center">No Program Title created Yet.</p>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection