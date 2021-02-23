@extends('admin.layouts.admin') 
@section('content')
<div class="container">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit Application Status</div>
                <div class="card-body">
                    @include('multiauth::message')
                   
                    <form method="POST" action="{{route('applicationStatus.update',$applicationStatus['id'])}}">
                    @csrf
                    @method('PUT')
                        <div class="form-group row">
                            <label for="input-id" class="col-sm-2">Application Status<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" placeholder="Status" name="name" class="mb-2 form-control" value="{{$applicationStatus['name']}}" required>
                                
                            </div>
                        </div>
                        <div class="form-group row">
                            <label for="country" class="col-md-2 ">Assign Country</label>

                            <div class="col-md-10">
                                <select name="country" id="country" class="form-control">
                                    <option selected disabled>Select Country</option>
                                        @foreach($countries as $country)
                                        <option value="{{$country['id']}}" {{ $applicationStatus->country == $country['id'] ? 'selected':'' }}>{{$country['name']}}</option>
                                        @endforeach
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-info btn-sm">Update</button>
                        <a href="{{route('applicationStatus.index')}}" class="btn btn-sm btn-danger float-right">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection