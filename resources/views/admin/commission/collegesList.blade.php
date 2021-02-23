@extends('admin.layouts.admin') 
@section('content')
<div class="container-fluid">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                <div class="col-md-6">
                Institute List &nbsp;
                    <span class="">
                        <a href="{{route('colleges.create')}}" class="btn btn-sm btn-success">Add New Institute</a>
                    </span>
                </div >
                    <div class="col-md-6">
                        <!-- <span class="float-right">
                            <form method="POST" action="{{route('courses.importCourse')}}" enctype="multipart/form-data">
                                @csrf
                                <label class="btn btn-warning" onchange="javascript:this.form.submit()">
                                    Import Institute/Course
                                    <input type="file" class="hide" name="select_file">
                                </label>
                            </form>
                        </span> -->
                    </div>
                </div>
                <div class="card-body">
                    @include('multiauth::message')
                    
                            <table  data-order='[[ 0, "desc" ]]' class="mb-0 table tableID">
                                    <thead>
                                        <tr>
                                            <th>ID</th>
                                            <th>Institute Name</th> 
                                            <th>No. Of Courses</th> 
                                            <th>Institute Type</th> 
                                            <th>Country</th> 
                                            <th>Status</th> 
                                           
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody class="appendQualTest ">
                                       
                                        @foreach ($colleges as $college)
                                        <tr >
                                            <th scope="row">#{{$college['id']}}</th>
                                            <td class="capitalize" width="40%" >{{ $college->name }}</td>
                                            <td class="capitalize"  >
                                            @if($college->numberOfCourse)    
                                            {{ $college->numberOfCourse->count()}}</td>
                                            @endif
                                            <td class="badge badge-warning badge-pill mt-10">{{ $college->InstituteType['name'] }}</td>
                                            <td class="capitalize">{{ $college->country['name'] }}</td>
                                            <td class="capitalize">
                                                @if($college['status'] == 0)
                                                <p class="text-success">Active</p>
                                                @else
                                                <p class="text-danger">Deactivate</p>
                                                @endif
                                            </td>
                    
                                            <td>
                                                    <!-- <a href="#" class="btn btn-sm btn-secondary mr-3" onclick="event.preventDefault(); document.getElementById('delete-form-{{ $college->id }}').submit();">Delete</a>
                                                    <form id="delete-form-{{ $college->id }}" action="{{ route('colleges.destroy',[$college->id]) }}" method="POST" style="display: none;">
                                                        @csrf @method('delete')
                                                    </form> -->
                    
                                                    <a href="{{route('colleges.edit',base64_encode($college->id))}}" class="btn btn-sm btn-info mr-3">Edit</a>
                                                    <a href="{{route('courses.index',base64_encode($college->id))}}" class="btn btn-sm btn-primary mr-3">Courses</a>
                                            </td>
                                            
                                        </tr>
                        @endforeach @if($colleges->count()==0)
                        <p class="text-center">No Institute created Yet.</p>
                        @endif
                    </tbody>
                </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection