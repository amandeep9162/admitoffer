@extends('admin.layouts.admin') 
@section('content')
<div class="container-fluid">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    Cities List &nbsp;
                    <span class="float-right">
                        <a href="{{route('admin.addCity')}}" class="btn btn-sm btn-success">Add New City</a>
                    </span>
                </div>
                <div class="card-body">
                    @include('multiauth::message')
                    <table  data-order='[[ 0, "desc" ]]' class="mb-0 table tableID">
                        <thead>
                            <tr>
                                <th>City</th> 
                                <th>Province</th> 
                               
                                <th>Action</th>
                            </tr>
                        </thead>
                        <tbody class="appendQualTest ">
                            @foreach ($cities as $city)
                        <tr>
                            <th scope="row">{{ $city->name }}</th>
                            <td class="capitalize">{{ $city->name }}</td>
                            <td class="capitalize">
                                <!-- <a href="#" class="btn btn-sm btn-secondary mr-3" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $city->id }}').submit();">Delete</a>
                                <form id="delete-form-{{ $city->id }}" action="{{ route('admin.city.delete',[$city->id]) }}" method="POST" style="display: none;">
                                    @csrf @method('delete')
                                </form> -->

                                <a href="{{route('admin.city.edit',base64_encode($city->id))}}" class="btn btn-sm btn-info mr-3">Edit</a>
                            </td>
                        </tr>
                        @endforeach @if($cities->count()==0)
                        <p class="text-center">No city created Yet.</p>
                        @endif
                    </ul>
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection