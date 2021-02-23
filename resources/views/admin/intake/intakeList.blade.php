@extends('admin.layouts.admin') 
@section('content')
<div class="container-fluid">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                Intake &nbsp;
                    <span class="float-right">
                        <a href="{{route('intakes.create')}}" class="btn btn-sm btn-success">Add Intake / Start Date</a>
                    </span>
                </div>
                <div class="card-body">
                    @include('multiauth::message')
                    <ul class="list-group">
                        @foreach ($intakes as $intake)
                        <li class="list-group-item d-flex justify-content-between align-items-center">
                            {{ $intake->name }}
                            <div class="float-right">
                                <!-- <a href="#" class="btn btn-sm btn-secondary mr-3" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $intake->id }}').submit();">Delete</a>
                                <form id="delete-form-{{ $intake->id }}" action="{{ route('intakes.destroy',[$intake->id]) }}" method="POST" style="display: none;">
                                    @csrf @method('delete')
                                </form> -->

                                <a href="{{route('intakes.edit',base64_encode($intake->id))}}" class="btn btn-sm btn-info mr-3">Edit</a>
                            </div>
                        </li>
                        @endforeach 
                        @if($intakes->count()==0)
                        <p class="text-center">No intake created Yet.</p>
                        @endif
                    </ul>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection