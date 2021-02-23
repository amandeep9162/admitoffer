@extends('admin.layouts.admin') 
@section('content')
<div class="container-fluid">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                Province List &nbsp;
                    <span class="float-right">
                        <a href="{{route('admin.addState')}}" class="btn btn-sm btn-success">Add New Province</a>
                    </span>
                </div>
                <div class="card-body">
                    @include('multiauth::message')
                    <table  data-order='[[ 0, "desc" ]]' class="mb-0 table tableID">
                        <thead>
                            <tr>
                                <th>Province</th> 
                                <th>Country</th> 
                               
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="appendQualTest ">
                            @foreach ($states as $state)
                        <tr>
                            <th scope="row">
                            {{ $state->name }}</th>
                            <td class="capitalize">{{$state->country['name']}}</td>
                            <td class="capitalize">
                                <!-- <a href="#" class="btn btn-sm btn-secondary mr-3" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $state->id }}').submit();">Delete</a>
                                <form id="delete-form-{{ $state->id }}" action="{{ route('admin.state.delete',[$state->id]) }}" method="POST" style="display: none;">
                                    @csrf @method('delete')
                                </form> -->

                                <a href="{{route('admin.state.edit',base64_encode($state->id))}}" class="btn btn-sm btn-info mr-3">Edit</a>
                            </td>
                       
                        </tr>
                        @endforeach
                         @if($states->count()==0)
                        <p class="text-center">No state created Yet.</p>
                        @endif
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection