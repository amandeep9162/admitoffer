@extends('admin.layouts.admin') 
@section('content')
<div class="container-fluid">
    <div class="row ">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header ">Edit Ielts Score</div>
                <div class="card-body">
                    @include('multiauth::message')
                   
                    <form method="POST" action="{{route('iletsScore.update',$iletsScore['id'])}}">
                    @csrf
                    @method('PUT')
                    <div class="form-group row">
                            <label for="input-id" class="col-sm-2">Ielts Score<span class="text-danger">*</span></label>
                            <div class="col-sm-10">    
                            <input type="text" placeholder="Score" name="name" class="mb-2 form-control" value="{{$iletsScore['name']}}" required>
                            
                          </div>
                    </div>
                     <div class="form-group row">
                            <label for="english_test" class="col-md-2 ">English Test</label>

                            <div class="col-md-10">
                                <select name="english_test" id="english_test" class="form-control">
                                    <option selected disabled>Select Test</option>
                                    @foreach($englishTests as $englishTest)
                                        <option value="{{$englishTest['name']}}" {{ $iletsScore->english_test == $englishTest['name'] ? 'selected':'' }} >{{$englishTest['name']}}</option>
                                        @endforeach
                                        
                                </select>
                            </div>
                        </div>
                     <div class="form-group row">
                            <label for="country" class="col-md-2 ">Assign Country</label>

                            <div class="col-md-10">
                                <select name="country" id="country" class="form-control">
                                    <option selected disabled>Select Country</option>
                                    @foreach($countries as $country)
                                        <option value="{{$country['id']}}" {{ $iletsScore->country == $country['id'] ? 'selected':'' }}>{{$country['name']}}</option>
                                        @endforeach
                                        
                                </select>
                            </div>
                        </div>
                        <button type="submit" class="btn btn-info btn-sm">Update</button>
                        <a href="{{route('iletsScore.index')}}" class="btn btn-sm btn-danger float-right">Back</a>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection