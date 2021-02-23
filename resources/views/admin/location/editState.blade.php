@extends('admin.layouts.admin') 
@section('content')
<div class="container">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">Edit this State</div>
                <div class="card-body">
                @include('multiauth::message')
                    <form action="{{ route('admin.state.Update',$state['id']) }}" method="post">
                        @csrf @method('patch')
                        <div class="form-group row">
                        <label for="role" class="col-sm-2">Select Country<span class="text-danger">*</span></label>
                            <div class="col-sm-10">    
                                <select class="mb-2 form-control" name="country_id" required>
                                    <option> Select country</option>
                                    @foreach($countries as $country)
                                        <option value="{{$country['id']}}" {{ ($country['id'] == $state['country_id']) ? 'selected' : '' }} > {{$country['name']}}</option>

                                    @endforeach
                                </select>
                            </div>    
                        </div>    
                        <div class="form-group row">
                            <label for="role" class="col-sm-2">State Name<span class="text-danger">*</span></label>
                            <div class="col-sm-10">
                                <input type="text" value="{{ $state['name'] }}" name="name" class="form-control" >
                            </div>
                        </div>
                        <button type="submit" class="btn btn-info btn-sm">Change</button>
                        <a href="{{route('admin.state.list')}}" class="btn btn-danger btn-sm float-right">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection