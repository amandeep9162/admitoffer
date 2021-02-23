@extends('admin.layouts.admin') 
@section('content')
<div class="container">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit this City</div>
                <div class="card-body">
                @include('multiauth::message')
                    <form action="{{ route('admin.city.Update',$city['id']) }}" method="post">
                        @csrf @method('patch')
                        <div class="form-group row">
                            <label for="role" class="col-sm-2">Select Country<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <select class="mb-2 form-control" name="country_id" id="country_id" required>
                                    @foreach($countries as $country)
                                    <option value="{{$country['id']}}" {{ ($country['id'] == $city['country_id']) ? 'selected' : '' }} > {{$country['name']}}</option>
                                    
                                    @endforeach
                                </select>
                            </div>    
                        </div> 
                        <div class="form-group row">   
                            <label for="role" class="col-sm-2">Select state<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <select class="mb-2 form-control" name="state_id" id="state_id"  required>
                                    
                                    <!-- <option> Select state</option> -->
                                    @foreach($state as $stat)
                                    <option value="{{$stat['id']}}" {{ ($stat['id'] == $city['state_id']) ? 'selected' : '' }} > {{$stat['name']}}</option>
                                    
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="form-group row">    
                            <label for="role" class="col-sm-2">City Name<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" value="{{ $city['name'] }}" name="name" class="form-control" >
                            </div>
                        </div>
                        <button type="submit" class="btn btn-info btn-sm">Change</button>
                        <a href="{{route('admin.city.list')}}" class="btn btn-danger btn-sm float-right">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection