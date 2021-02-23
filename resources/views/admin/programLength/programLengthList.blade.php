@extends('admin.layouts.admin') 
@section('content')
<div class="container-fluid">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                Program Length List &nbsp;
                    <span class="float-right">
                        <a href="{{route('programLength.create')}}" class="btn btn-sm btn-success">Add New Program Length</a>
                    </span>
                </div>
                <div class="card-body">
                    @include('multiauth::message')
                    <ul class="list-group">
                        @foreach ($programLengths as $programLength)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $programLength->name }}
                            <div class="float-right">
                                <!-- <a href="#" class="btn btn-sm btn-secondary mr-3" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $programLength->id }}').submit();">Delete</a>
                                <form id="delete-form-{{ $programLength->id }}" action="{{ route('programLength.destroy',[$programLength->id]) }}" method="POST" style="display: none;">
                                    @csrf @method('delete')
                                </form> -->

                                <a href="{{route('programLength.edit',base64_encode($programLength->id))}}" class="btn btn-sm btn-info mr-3">Edit</a>
                            </div>
                        </li>
                        @endforeach @if($programLengths->count()==0)
                        <p class="text-center">No Program Length created Yet.</p>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection