@extends('admin.layouts.admin') 
@section('content')
<div class="container-fluid">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header ">Add New University</div>
                <div class="card-body">
                    @include('multiauth::message')
                    <form method="POST" action="{{route('university.store')}}">
                    @csrf
                   
                    <div class="form-group row">
                        <label for="input-id" class="col-sm-2">Add New University  <span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                             <input type="text"  class="mb-2 form-control" name="name">
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-id" class="col-sm-2">University For Country<span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <select  class="mb-2 form-control" name="country_id" required>
                                <option value=''>Select Country</option>
                                @foreach($countries as $countrie)
                                <option value="{{$countrie['id']}}">{{$countrie['name']}}</option>
                                @endforeach
                            </select>
                            
                        </div>
                    </div>
                    <div class="form-group row">  
                        <label for="input-id" class="col-sm-2">Pre Process By<span class="text-danger">*</span> </label>
                        <div class="col-sm-10">
                            <select class="mb-2 form-control" name="preProcessBy"  required>
                                <option value=''> Select Pre Process</option>
                                @foreach($roles->admins as $role)
                                    <option value="{{$role['id']}}"> {{$role['name']}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>
                        <button type="submit" class="btn btn-info btn-sm">Save</button>
                        <a href="{{route('university.index')}}" class="btn btn-sm btn-danger float-right">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection