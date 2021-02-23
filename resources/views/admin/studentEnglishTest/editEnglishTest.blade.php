@extends('admin.layouts.admin') 
@section('content')
<div class="container">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header ">Edit English Test</div>
                <div class="card-body">
                    @include('multiauth::message')
                   
                    <form method="POST" action="{{route('englishTest.update',$englishTest['id'])}}">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                        <label for="input-id" class="col-sm-2">Country<span class="text-danger">*</span></label>
                        <div class="col-sm-10">
                            <select  class="mb-2 form-control" name="country_id">
                                <option value="">select Country</option>
                                @foreach($countries as $countrie)
                                <option value="{{$countrie['id']}}" {{ ($countrie['id'] == $englishTest['country_id']) ? 'selected' : '' }}>{{$countrie['name']}}</option>
                                @endforeach
                            </select>
                            
                        </div>
                    </div>
                    <div class="form-group row">
                        <label for="input-id" class="col-sm-2">English Test Name<span class="text-danger">*</span></label>
                        <div class="col-sm-10">    
                             <input type="text" placeholder="name" name="name" class="mb-2 form-control" value="{{$englishTest['name']}}" required>
                            
                        </div>
                    </div>
                        <button type="submit" class="btn btn-info btn-sm">Update</button>
                        <a href="{{route('englishTest.index')}}" class="btn btn-sm btn-danger float-right">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection