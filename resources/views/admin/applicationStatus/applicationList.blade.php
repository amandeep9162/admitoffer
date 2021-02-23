@extends('admin.layouts.admin') 
@section('content')
<div class="container-fluid">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                Application Status List &nbsp;
                    <span class="float-right">
                        <a href="{{route('applicationStatus.create')}}" class="btn btn-sm btn-success">Add New Status</a>
                    </span>
                </div>
                <div class="card-body">
                    @include('multiauth::message')
                    <table  class="mb-0 table tableID">
                        <thead>
                            <tr>
                                <th>Status</th> 
                                <th>Country</th> 
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="appendQualTest ">
                            @foreach ($applicationStatuses as $applicationStatus)
                            <tr>
                                <th scope="row">{{ $applicationStatus->name }}</th>
                                <td>{{ $applicationStatus->countries['name'] }}</td>
                                <td class="float-right">
                                    <!-- <a href="#" class="btn btn-sm btn-secondary mr-3" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $applicationStatus->id }}').submit();">Delete</a>
                                    <form id="delete-form-{{ $applicationStatus->id }}" action="{{ route('instituteTypes.destroy',[$applicationStatus->id]) }}" method="POST" style="display: none;">
                                        @csrf @method('delete')
                                    </form> -->

                                    <a href="{{route('applicationStatus.edit',base64_encode($applicationStatus->id))}}" class="btn btn-sm btn-info mr-3">Edit</a>
                                </td>
                        </tr>
                        @endforeach @if($applicationStatuses->count()==0)
                        <p class="text-center">No Status created Yet.</p>
                        @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection