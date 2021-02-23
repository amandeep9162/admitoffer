@extends('admin.layouts.admin') 
@section('content')
<div class="container-fluid">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                Institute List &nbsp;
                    <span class="float-right">
                        <a href="{{route('university.create')}}" class="btn btn-sm btn-success">Add New Institute</a>
                    </span>&nbsp;
                  
                </div>
                <div class="card-body">
                    @include('multiauth::message')
                    <ul class="list-group">
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                        <Strong>Institutes</Strong>
                                <span><Strong>Pre Processors </Strong></span>
                                <div class="float-right mr-6-percentage">
                                    <Strong>Action</Strong>
                                </div>
                        </li>
                        @foreach ($universities as $universitie)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                        {{ $universitie->name }}
                            <span>{{ $universitie->preProcess['name'] }} </span>
                            <div class="float-right">
                                <!-- <a href="#" class="btn btn-sm btn-secondary mr-3" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $universitie->id }}').submit();">Delete</a>
                                <form id="delete-form-{{ $universitie->id }}" action="{{ route('university.destroy',[$universitie->id]) }}" method="POST" style="display: none;">
                                    @csrf @method('delete')
                                </form> -->

                                <a href="{{route('university.show',base64_encode($universitie->id))}}" class="btn btn-sm btn-info mr-3">Campus</a>
                                <a href="{{route('university.edit',base64_encode($universitie->id))}}" class="btn btn-sm btn-info mr-3">Edit</a>
                            </div>
                        </li>
                        @endforeach @if($universities->count()==0)
                        <p class="text-center">No Institute created Yet.</p>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection