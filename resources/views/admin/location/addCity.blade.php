@extends('admin.layouts.admin') 
@section('content')
<div class="container">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header ">Add New City</div>
                <div class="card-body">
                    @include('multiauth::message')
                    <form method="POST" action="{{route('admin.saveCity')}}">
                    @csrf
                        <div class="form-group row">
                            <label for="input-id" class="col-sm-2">Select Country<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <select class="mb-2 form-control" name="country_id" id="country_id" required>
                                    <option> Select country</option>
                                    @foreach($countries as $country)
                                        <option value="{{$country['id']}}"> {{$country['name']}}</option>

                                    @endforeach
                                </select>
                            </div>   
                        </div>   
                        <div class="form-group row">    
                            <label for="input-id" class="col-sm-2">Select State<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <select class="mb-2 form-control" name="state_id" id="state_id"  required>
                                    <option> Select state</option>
                                
                                </select>
                            </div>    
                        </div>    
                        <div class="form-group row">
                            <label for="input-id" class="col-sm-2">City Name<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" placeholder="name" name="name" class="mb-2 form-control" required>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-info btn-sm">Save</button>
                        <a href="{{route('admin.city.list')}}" class="btn btn-sm btn-danger float-right">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection